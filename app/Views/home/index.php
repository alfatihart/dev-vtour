<!DOCTYPE html>
<html>
<?php if (!empty($_GET['scene'])) {
    $firstScene = $_GET['scene'];
} else {
    $firstScene = $firstSceneSlug;
} ?>

<!-- WIFI LT1 SANDI 07051974 -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Virtual Tour</title>
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">
    <!-- Load Pannellum JavaScript -->
    <script src="<?= base_url('assets/js/pannellum.js'); ?>"></script>
    <script src="<?= base_url('assets/js/libpannellum.js'); ?>"></script>
    <!-- Load Pannellum CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/pannellum.css'); ?>">
    <!-- <link rel="stylesheet" href="<= base_url('assets/css/css-panorama.css'); ?>"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVYr3LxZOKtvdsczICy-K9CYZgLSoh51I&callback=initMap" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script> -->
    <style>
        .custom-navbar {
            max-width: max-content;
            margin: 0 auto;
            margin-bottom: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.3);
            /* Background transparan */
            backdrop-filter: blur(10px);
            /* Efek blur */
        }

        .nav-link:hover {
            color: var(--bs-danger) !important;
        }


        /* custom search popup */
        div#panorama.active {
            filter: blur(20px);
            pointer-events: none;
            user-select: none;
        }

        #popupSearch {
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            visibility: hidden;
            opacity: 0;
            transition: 0.5s;
        }

        #popupSearch.active {
            top: 40%;
            visibility: visible;
            opacity: 1;
            transition: 0.5s;
        }

        .search-box {
            padding: 0;
            font-family: 'Poppins', sans-serif;
            width: 600px;
            background: #fff;
            /* margin: 200px auto 0; */
            border-radius: 5px;

            /* position: absolute; */
            /* padding-top: 40px; */
            /* Adjust this value as needed */
        }

        .row-search {
            display: flex;
            align-items: center;
            padding: 10px 20px;
        }

        input {
            flex: 1;
            height: 50px;
            background: transparent;
            border: 0;
            outline: 0;
            font-size: 18px;
            color: #333;

        }

        button {
            background: transparent;
            border: 0;
            outline: 0;

        }

        button .fa-solid {
            width: 25px;
            color: #555;
            font-size: 22px;
            cursor: pointer;
        }

        ::placeholder {
            color: #555;
        }

        .close-btn {
            width: 30px;
            height: 30px;
            line-height: 0.75;
            background-color: #dc3545;
            /* Sesuaikan warna sesuai kebutuhan */
            border: none;
            cursor: pointer;
            top: 10px;
            /* adjust as needed */
            right: 10px;
            /* adjust as needed */
        }


        .result-box {
            max-height: 300px;
            overflow-y: scroll;
        }

        .result-box ul {
            border-top: 1px solid #999;
            padding: 15px 10px;
        }

        .result-box ul li {
            list-style: none;
            border-radius: 3px;
            padding: 15px 10px;
            cursor: pointer;
        }

        .result-box ul li:hover {
            background: #e9f3ff;
        }

        .text-border {
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }

        /* Media query for mobile devices */
        @media (max-width: 650px) {
            .search-box {
                width: 80vw;
            }
        }


        /* custom hotspot */
        .step-hotspot {
            height: 110px;
            width: 110px;
            background-color: yellow;
            background: url('/assets/img/arrow.gif');
            background-size: 110px 110px;
        }

        .room-hotspot {
            height: 80px;
            width: 80px;
            background-color: yellow;
            background: url('/assets/img/door.gif');
            background-size: 80px 80px;
            transition: transform 0.3s ease;
        }

        .info-hotspot {
            height: 70px;
            width: 70px;
            background-color: yellow;
            background: url('/assets/img/info.gif');
            background-size: 70px 70px;
            transition: transform 0.3s ease;
        }

        div.custom-tooltip span {
            visibility: hidden;
            position: absolute;
            border-radius: 3px;
            background-color: #fff;
            color: #000;
            text-align: center;
            max-width: 200px;
            padding: 5px 10px;
            margin-left: -220px;
            cursor: default;
        }

        div.custom-tooltip:hover span {
            visibility: visible;
        }

        div.custom-tooltip:hover span:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-width: 10px;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
            bottom: -20px;
            left: -10px;
            margin: 0 50%;
        }

        #map {
            height: 70vh;
            width: 100%;
        }

        .map-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Ratio 16:9 */
            height: 0;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div id="panorama" style="width: 100vw; height: 100vh;">
        <nav class="navbar navbar-expand fixed-bottom custom-navbar shadow-sm p-0 pt-2">
            <div class="container-fluid d-flex justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item text-center me-1 me-sm-3">
                        <button class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#aboutModal">
                            <i class="fa-regular fa-circle-question fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">About</span>
                        </button>
                    </li>
                    <li class="nav-item text-center me-1 me-sm-3">
                        <button class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#mapsModal">
                            <i class="fa-regular fa-map fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Maps</span>
                        </button>
                    </li>
                    <li class="nav-item text-center me-1 me-sm-3">
                        <a class="nav-link text-dark" onclick="toggle()">
                            <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Search</span>
                        </a>
                    <li class="nav-item text-center me-1 me-sm-3">
                        <button class="nav-link text-dark" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalXl">
                            <i class="fa-regular fa-image fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Media</span>
                        </button>
                    </li>
                    <li class="nav-item text-center">
                        <a id="fullscreen" class="nav-link text-dark">
                            <i class="fa-solid fa-expand fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Maximize</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- popup search -->
    <div id="popupSearch">
        <div class="search-box">
            <div class="row-search">
                <input type="text" id="input-box" placeholder="Search location.." autocomplete="off">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="result-box">
            </div>
        </div>
        <button class="close-btn rounded-circle" onclick="toggle()" type="button">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <!-- Modal Media -->
    <div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scenes List</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        <?php foreach ($scenes as $scene) : ?>
                            <div class="col">
                                <a href="/?scene=<?= $scene['slug']; ?>" class="card text-bg-dark shadow">
                                    <img src="/scenes/thumbnail?image=<?= $scene['image']; ?>" class="card-img" alt="<?= $scene['slug']; ?>">
                                    <div class="card-img-overlay">
                                        <h6 class="card-title text-border"><?= $scene['title']; ?></h6>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <!-- Modal Maps -->
    <div class="modal fade" id="mapsModal" tabindex="-1" aria-labelledby="mapsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Maps pin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <!-- Modal About -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-10">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between">
                        <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" href="#info" data-bs-toggle="tab" role="tab" aria-controls="info" aria-selected="true">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="location-tab" href="#location" data-bs-toggle="tab" role="tab" aria-controls="location" aria-selected="false">Location</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="credit-tab" href="#credit" data-bs-toggle="tab" role="tab" aria-controls="credit" aria-selected="false">Credit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                        </ul>
                        <button type="button" class="nav-item btn-close align-self-start" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="cardTabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <h5 class="card-title">Departemen Matematika Unhas</h5>
                                <p class="card-text">Departemen Matematika didirikan pada 17 Agustus 1963 bersamaan dengan pendirian Fakultas Ilmu Pengetahuan Alam, Universitas Hasanuddin. Selama beberapa tahun pertama, tidak ada siswa yang terdaftar di Program Studi (SP) ini hingga 1974, di mana beberapa siswa diterima di tingkat diploma. <br><br> Sejak tahun 1997 dosen pada Program Studi Matematika mulai dikelompokkan ke dalam Program Studi Matematika dan Program Studi Statistika berdasarkan spesifikasi dan bidang keahlian masing-masing dosen. Kemudian pada tahun 2014 dikelompokkan lagi menjadi tiga program studi, yaitu Program Studi Matematika, Statistika, dan Ilmu Komputer. Namun pada tahun 2019, Departemen Matematika terdiri menjadi Prodi Matematika dan Prodi Ilmu Komputer karena terbentuknya Departemen Statistika.
                                    <br><br>
                                    <b>Program Studi di bawah Departemen Matematika</b>
                                <ul>
                                    <li>Program Studi Matematika</li>
                                    <li>Program Studi Magister (S2) Matematika</li>
                                    <li>Program Studi Doktor (S3) Matematika</li>
                                    <li>Program Studi Sistem Informasi</li>
                                    <li>Program Studi Ilmu Aktuaria</li>
                                </ul>
                                Website: <a href="https://sci.unhas.ac.id/d-matematika/">https://sci.unhas.ac.id/d-matematika/</a>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                <h5 class="card-title">Departemen Matematika Unhas</h5>
                                <p class="card-text">Jl. Perintis Kemerdekaan Km.10 Tamalanrea, Makassar, Sulawesi Selatan, Indonesia</p>
                                <div class="map-container">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248.3637919329691!2d119.48710653886334!3d-5.13256404677625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd59e5a286af%3A0xd355449be7cbd3a5!2sDepartemen%20Matematika!5e0!3m2!1sid!2sid!4v1702634025850!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="credit-tab">
                                <h5 class="card-title text-center fw-bold">Maths Virtual Tour</h5>
                                <p class="card-text">
                                <div class="text-center">
                                    360 Panorama Production <br>
                                    <b><?= $setting['author']; ?></b><br><br>
                                    360 Virtual Tour Production <br>
                                    <b><?= $setting['author']; ?></b><br>
                                    <img src="/assets/img/logo-unhas.png" class="rounded mt-5" style="max-height: 100px;" alt="Logo Unhas">
                                    <br>
                                    Departemen Matematika <br>
                                    Fakultas Matematika dan Ilmu Pengetahuan Alam <br>
                                    Universitas Hasanuddin
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-md-flex justify-content-md-end"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup -->
    <div id="rotateDevicePopup" style="position: fixed; z-index: 999998; left: 0px; top: 0px; margin: 0px; padding: 0px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.99);">
        <div style="box-sizing:border-box; padding:0 10vmin; display:table; height:100%; width:100vw;">
            <div style="vertical-align:middle; text-align:center; display:table-cell;">
                <!-- <img style="width: 22vmin; transform: none;" src="/assets/img/rotate-device.png"> -->
                <div style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:3.6vmin; line-height:4.3vmin; margin:5vmin 0; text-align:center;">Please, rotate your device</div>
            </div>
        </div>
    </div>

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
                            "panorama": "<?= base_url('uploads/' . $scene['image']); ?>",
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
                                "createTooltipFunc": hotspot,
                                "createTooltipArgs": "Koridor",
                                "sceneId": "r-ballroom"
                            }
                        ]
                    },
                    "": {}
                }
            });

            function hotspot(hotSpotDiv, args) {
                hotSpotDiv.classList.add('custom-tooltip');
                var span = document.createElement('span');
                span.innerHTML = args;
                hotSpotDiv.appendChild(span);
                span.style.width = span.scrollWidth - 20 + 'px';
                span.style.marginLeft = -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + 'px';
                span.style.marginTop = -span.scrollHeight - 12 + 'px';
            }
            console.log('Panorama loaded!');
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
                return `<li class="nav-item" onclick=selectInput(this)><a class="nav-link" href="/?scene=${key}">${availableKeywords[key]}<a></li>`;
            }).join('');

            resultBox.innerHTML = `<ul>${content}</ul>`;
        }

        function selectInput(list) {
            inputBox.value = list.innerHTML.includes('<a>') ? list.innerText : list.innerHTML;
            resultBox.innerHTML = '';
        }
    </script>
    <script>
        var map;
        var markers = [];

        function initMap() {
            var locations = [
                <?php foreach ($maps as $map) : ?> {
                        lat: <?= $map['latitude']; ?>,
                        lng: <?= $map['longitude']; ?>,
                        name: '<?= $map['name']; ?>',
                        url: '/?scene=<?= $map['scene_slug']; ?>'
                    },
                <?php endforeach; ?>
                // {
                //     lat: -5.132440089023397,
                //     lng: 119.48786389693545,
                //     name: 'Teaching Staff',
                //     url: '/?scene=k-teaching-staff'
                // },
                // {
                //     lat: -5.132440089023397,
                //     lng: 119.48759079875605,
                //     name: 'Visiting Scientist',
                //     url: '/?scene=k-visit-scientist'
                // },
                // {
                //     lat: -5.132440089023397,
                //     lng: 119.48738963309442,
                //     name: 'Administrative',
                //     url: '/?scene=k-kantor-dep-mat'
                // },
                // {
                //     lat: -5.132673467503202,
                //     lng: 119.48738963309442,
                //     name: 'Kaprodi',
                //     url: '/?scene=testing'
                // },
                // {
                //     lat: -5.132673467503202,
                //     lng: 119.48706910910113,
                //     name: 'Ruang Dosen',
                //     url: '/?scene=testing'
                // },
                // {
                //     lat: -5.132673467503202,
                //     lng: 119.48683575690316,
                //     name: 'Laboratorium',
                //     url: '/?scene=testing'
                // },
                // {
                //     lat: -5.132673467503202,
                //     lng: 119.48659368755703,
                //     name: 'Ruang Belajar',
                //     url: '/?scene=testing'
                // },
                // Tambahkan lebih banyak lokasi jika diperlukan
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
                    mapTypeIds: ['roadmap', 'night_mode'] //toggle ganti mode
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

            // Tambahkan tema untuk mode malam (Night Mode)
            // var nightModeStyle = new google.maps.StyledMapType(
            //     [{
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#242f3e'
            //             }]
            //         },
            //         {
            //             elementType: 'labels.text.stroke',
            //             stylers: [{
            //                 color: '#242f3e'
            //             }]
            //         },
            //         {
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#746855'
            //             }]
            //         },
            //         {
            //             featureType: 'administrative.locality',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#d59563'
            //             }]
            //         },
            //         {
            //             featureType: 'poi',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#d59563'
            //             }]
            //         },
            //         {
            //             featureType: 'poi.park',
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#263c3f'
            //             }]
            //         },
            //         {
            //             featureType: 'poi.park',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#6b9a76'
            //             }]
            //         },
            //         {
            //             featureType: 'road',
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#38414e'
            //             }]
            //         },
            //         {
            //             featureType: 'road',
            //             elementType: 'geometry.stroke',
            //             stylers: [{
            //                 color: '#212a37'
            //             }]
            //         },
            //         {
            //             featureType: 'road',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#9ca5b3'
            //             }]
            //         },
            //         {
            //             featureType: 'road.highway',
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#746855'
            //             }]
            //         },
            //         {
            //             featureType: 'road.highway',
            //             elementType: 'geometry.stroke',
            //             stylers: [{
            //                 color: '#1f2835'
            //             }]
            //         },
            //         {
            //             featureType: 'road.highway',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#f3d19c'
            //             }]
            //         },
            //         {
            //             featureType: 'transit',
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#2f3948'
            //             }]
            //         },
            //         {
            //             featureType: 'transit.station',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#d59563'
            //             }]
            //         },
            //         {
            //             featureType: 'water',
            //             elementType: 'geometry',
            //             stylers: [{
            //                 color: '#17263c'
            //             }]
            //         },
            //         {
            //             featureType: 'water',
            //             elementType: 'labels.text.fill',
            //             stylers: [{
            //                 color: '#515c6d'
            //             }]
            //         },
            //         {
            //             featureType: 'water',
            //             elementType: 'labels.text.stroke',
            //             stylers: [{
            //                 color: '#17263c'
            //             }]
            //         }
            //     ], {
            //         name: 'Night Mode'
            //     }
            // );

            // map.mapTypes.set('night_mode', nightModeStyle);
            map.setMapTypeId('roadmap');
        }

        // Fungsi untuk menyembunyikan semua marker
        // function hideAllMarkers() {
        //     markers.forEach(function (marker) {
        //         marker.setMap(null);
        //     });
        // }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>