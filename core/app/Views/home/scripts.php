<!-- script panorama -->
<script>
    let panorama = document.getElementById('panorama');
    let rotateDevicePopup = document.getElementById('rotateDevicePopup');

    if (<?= $setting['device_orientation'] == 1 ? 'true' : 'false'; ?>) {
        console.log('Device orientation enabled!');
        if (window.innerWidth > window.innerHeight) {
            loadPanorama();
            rotateDevicePopup.style.display = 'none';
        } else {
            console.log('Please rotate your device!');
            rotateDevicePopup.style.display = 'block';
            panorama.style.display = 'none';
            loadPanorama();
        }

        window.addEventListener('resize', function() {
            var width = window.innerWidth;
            var height = window.innerHeight;

            console.log('Width: ' + width);
            console.log('Height: ' + height);

            if (width < height) {
                console.log('Please rotate your device!');
                rotateDevicePopup.style.display = 'block';
                panorama.style.display = 'none';
            } else {
                rotateDevicePopup.style.display = 'none';
                panorama.style.display = 'block';
            }
        });
    } else {
        console.log('Device orientation disabled!');
        loadPanorama();
        rotateDevicePopup.style.display = 'none';
    }

    function loadPanorama() {
        var viewportHeight = window.innerHeight;
        panorama.style.height = viewportHeight + 'px';
        console.log('Viewport height: ' + viewportHeight);
        viewer = pannellum.viewer('panorama', {
            "default": {
                // "firstScene": "koridor",
                "firstScene": "<?= $firstScene; ?>",
                "author": "<?= $setting['author']; ?>",
                "autoLoad": <?= $setting['auto_load'] == 1 ? 'true' : 'false'; ?>,
                "hotSpotDebug": <?= $setting['hotspot_debug'] == 1 ? 'true' : 'false'; ?>,
                "sceneFadeDuration": <?= $setting['scene_fade']; ?>,
                "autoRotate": <?= $setting['auto_rotate']; ?>,
                "autoRotateInactivityDelay": <?= $setting['rotate_delay']; ?>,
                "showControls": <?= $setting['show_controls'] == 1 ? 'true' : 'false'; ?>,
            },
            "scenes": {
                <?php foreach ($scenes as $scene) : ?> "<?= $scene['slug']; ?>": {
                        "title": "<?= $scene['title']; ?>",
                        "hfov": <?= $scene['hfov']; ?> - (1920 - window.innerWidth) * 0.035,
                        "pitch": <?= $scene['pitch']; ?>,
                        "yaw": <?= $scene['yaw']; ?>,
                        "type": "equirectangular",
                        "panorama": "<?= ($hd ? $path : base_url('uploads/')) . $scene['image'] ?>",
                        "compass": <?= $setting['compass'] == 1 ? 'true' : 'false'; ?>,
                        "northOffset": <?= $scene['north_offset']; ?>,
                        "hotSpots": [
                            <?php foreach ($scene['hotSpots'] as $hotspot) : ?>
                                <?php if ($hotspot['id'] === null) continue; ?> {
                                    "pitch": <?= $hotspot['pitch']; ?>,
                                    "yaw": <?= $hotspot['yaw']; ?>,
                                    "type": "<?= $hotspot['type']; ?>",
                                    "cssClass": "<?= $hotspot['style']; ?>",
                                    "text": "<?= $hotspot['text']; ?>",
                                    "sceneId": "<?= $hotspot['sceneId']; ?>",
                                    "URL": "<?= $hotspot['url']; ?>"
                                },
                            <?php endforeach; ?>
                        ]
                    },
                <?php endforeach; ?> "koridor": {
                    "title": "Data sampel",
                    "hfov": 110 - (1920 - window.innerWidth) * 0.035,
                    "pitch": 0,
                    "yaw": -180,
                    "type": "equirectangular",
                    "panorama": "/uploads/for-test_2.jpg",
                    // "panorama": "https://cdn.jsdelivr.net/gh/alfatihart/vt-math@main/hd/<= $scene['image']; ?>",
                    // "panorama": "<= base_url('uploads/' . $scene['image']); ?>",
                    // "panorama": "<= base_url('cache/' . $scene['image']) . '_250x125.jpg'; ?>",
                    // "panorama": "<= base_url('/scenes/render/' . $scene['image']); ?>",
                    "hotSpots": [{
                            "pitch": -20,
                            "yaw": -180,
                            "type": "scene",
                            "cssClass": "step-hotspot",
                            "text": "Rektorat",
                            "sceneId": "rektorat"
                        },
                        {
                            "pitch": 2,
                            "yaw": -180,
                            "type": "scene",
                            "cssClass": "room-hotspot",
                            // "createTooltipFunc": hotspot,
                            "createTooltipArgs": "Koridor",
                            "sceneId": "r-ballroom"
                        }
                    ]
                },
                "": {}
            }
        });

        console.log('Panorama loaded!');
        console.log('Current scene: ' + viewer.getScene());
        viewer.on('scenechange', function(sceneId) {
            console.log('New scene loaded: ' + sceneId);
        });
        document.getElementById('fullscreen').addEventListener('click', function(e) {
            viewer.toggleFullscreen();
        });
    }

    function toggle() {
        var panorama = document.getElementById('panorama');
        panorama.classList.toggle('active');
        var popupSearch = document.getElementById('popupSearch');
        popupSearch.classList.toggle('active');
    }
</script>

<!-- script search -->
<script>
    let availableKeywords = {
        <?php foreach ($scenes as $scene) : ?> "<?= $scene['slug']; ?>": "<?= $scene['title']; ?>",
        <?php endforeach ?>
    }

    const resultBox = document.querySelector('.result-box');
    const inputBox = document.getElementById('input-box');

    inputBox.onkeyup = function() {
        let result = [];
        let input = inputBox.value;
        if (input.length) {
            result = Object.keys(availableKeywords).filter(key => {
                return availableKeywords[key].toLowerCase().includes(input.toLowerCase());
            });
            console.log(result);
        }
        display(result);

        if (!result.length) {
            resultBox.innerHTML = '';
        }
    }

    function display(result) {
        const content = !result.length ? '' : result.map((key) => {
            return `<li class="nav-item" onclick=selectInput(this)><a class="nav-link" href="<?= base_url(); ?>/?scene=${key}">${availableKeywords[key]}<a></li>`;
        }).join('');

        resultBox.innerHTML = `<ul>${content}</ul>`;
    }

    function selectInput(list) {
        inputBox.value = list.innerHTML.includes('<a>') ? list.innerText : list.innerHTML;
        resultBox.innerHTML = '';
    }
</script>

<!-- script maps -->
<script>
    var map;
    var markers = [];

    function initMap() {
        var locations = [
            <?php foreach ($maps as $map) : ?> {
                    lat: <?= $map['latitude']; ?>,
                    lng: <?= $map['longitude']; ?>,
                    name: '<?= $map['name']; ?>',
                    url: '<?= base_url(); ?>?scene=<?= $map['scene_slug']; ?>'
                },
            <?php endforeach; ?>
        ];

        map = new google.maps.Map(document.getElementById('map'), {
            // center: { lat: locations[0].lat, lng: locations[0].lng }, -5.132521560350549, 119.48714544286307
            // -5.1325160375862415, 119.48711593942153
            center: {
                lat: -5.1325160375862415,
                lng: 119.48711593942153
            },
            zoom: 19, // Atur tingkat zoom awal
            maxZoom: 20, // Atur tingkat zoom maksimal
            minZoom: 17,
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap'] //toggle ganti mode
            }
        });

        // Tambahkan penanda pada peta untuk setiap lokasi
        locations.forEach(function(location) {
            var marker = new google.maps.Marker({
                position: {
                    lat: location.lat,
                    lng: location.lng
                },
                map: map,
                title: location.name
            });

            markers.push(marker);

            // Tambahkan info window jika diperlukan
            var infowindow = new google.maps.InfoWindow({
                content: '<b>' + location.name + '</b></br>' +
                    '<a  class="fcc-btn" href="' + location.url + '">Lihat</a>'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        });

        // Sembunyikan marker bawaan Google Maps
        map.set('styles', [{
            featureType: 'poi',
            stylers: [{
                visibility: 'off'
            }]
        }]);

        map.setMapTypeId('roadmap');
    }
</script>

<!-- script hd image -->
<script>
    let statusHD = <?= $hd ? 'true' : 'false' ?>;
    let btnHD = document.getElementById('btnHD');
    if (statusHD) {
        btnHD.className = 'bi-badge-hd-fill';
    } else {
        btnHD.className = 'bi-badge-hd';
    }
    console.log('HD image status: ' + statusHD);

    function confirmHD() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will change the quality of the panorama!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed && !statusHD) {
                btnHD.className = 'bi-badge-hd-fill';
                // Add the "hd" query to the current URL and reload the page
                let url = new URL(window.location.href);
                url.searchParams.set('hd', 'true');
                window.location.href = url.toString();
            } else if (result.isConfirmed && statusHD) {
                btnHD.className = 'bi-badge-hd';
                // Remove the "hd" query from the current URL and reload the page
                let url = new URL(window.location.href);
                url.searchParams.delete('hd');
                window.location.href = url.toString();
            }
        });
    }
</script>