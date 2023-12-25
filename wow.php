<script>
  if (window.innerWidth > window.innerHeight) {
    loadPanorama();
    document.getElementById('rotateDevicePopup').style.display = 'none';
  } else {
    console.log('Please rotate your device!');
    document.getElementById('rotateDevicePopup').style.display = 'block';
    document.getElementById('panorama').style.display = 'none';
    loadPanorama();
  }

  window.addEventListener('resize', function() {
    var width = window.innerWidth;
    var height = window.innerHeight;

    console.log('Width: ' + width);
    console.log('Height: ' + height);

    if (width < height) {
      console.log('Please rotate your device!');
      document.getElementById('rotateDevicePopup').style.display = 'block';
      document.getElementById('panorama').style.display = 'none';
    } else {
      document.getElementById('rotateDevicePopup').style.display = 'none';
      document.getElementById('panorama').style.display = 'block';
    }
  });

  function loadPanorama() {
    pannellum.viewer('panorama', {
      "default": {
        "firstScene": "k-welcome-bridge",
        "author": "Restu Adi Akbar",
        "autoLoad": true,
        "hotSpotDebug": true,
        "sceneFadeDuration": 1000,
        "autoRotate": 0,
        "autoRotateInactivityDelay": 5000,
      },
      "scenes": {
        "testing": {
          "title": "Hanya untuk test",
          "hfov": 90,
          "pitch": 5,
          "yaw": 50,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/default.jpg",
          "compass": false,
          "northOffset": 90,
          "hotSpots": []
        },
        "rektorat": {
          "title": "Gedung Rektorat",
          "hfov": 110,
          "pitch": 0,
          "yaw": 0,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/rektorat_17.jpg",
          "compass": false,
          "northOffset": 0,
          "hotSpots": [{
            "pitch": 0,
            "yaw": 0,
            "type": "scene",
            "text": "testttttttttttttttttt",
            "sceneId": "15",
            "URL": ""
          }, ]
        },
        "k-welcome-bridge": {
          "title": "Welcome Bridge",
          "hfov": 110,
          "pitch": 0,
          "yaw": -180,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/welcome-bridge.jpg",
          "compass": false,
          "northOffset": -90,
          "hotSpots": [{
              "pitch": 1,
              "yaw": 64,
              "type": "info",
              "text": "Gedung Rektorat Unhas",
              "sceneId": "",
              "URL": "https://unhas.ac.id/petakampus/virtualtour/index.php?scene=rektorat#rektorat"
            },
            {
              "pitch": 0,
              "yaw": -67,
              "type": "info",
              "text": "Pergi ke perpus pusat",
              "sceneId": "",
              "URL": "https://unhas.ac.id/petakampus/virtualtour/index.php?scene=perpuspusat#perpuspusat"
            },
            {
              "pitch": -3,
              "yaw": -180,
              "type": "scene",
              "text": "Masuk ke dalam",
              "sceneId": "19",
              "URL": ""
            },
          ]
        },
        "k-teaching-staff": {
          "title": "Teaching Staff",
          "hfov": 110,
          "pitch": 0,
          "yaw": 180,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/teaching-staff.jpg",
          "compass": false,
          "northOffset": 180,
          "hotSpots": [{
            "pitch": -5,
            "yaw": -178,
            "type": "scene",
            "text": "Masuk Ruang Dosen",
            "sceneId": "20",
            "URL": ""
          }, ]
        },
        "r-t-staff-room1": {
          "title": "Teaching Staff Room A",
          "hfov": 110,
          "pitch": 0,
          "yaw": 4,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/t-staff-room1.jpg",
          "compass": false,
          "northOffset": 0,
          "hotSpots": []
        },
        "r-t-staff-room2": {
          "title": "Teaching Staff Room A",
          "hfov": 110,
          "pitch": 0,
          "yaw": -117,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/t-staff-room2.jpg",
          "compass": false,
          "northOffset": 90,
          "hotSpots": []
        },
        "k-teaching-staff2": {
          "title": "Teaching Staff A",
          "hfov": 110,
          "pitch": -1,
          "yaw": -3,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/teaching-staff2.jpg",
          "compass": false,
          "northOffset": 0,
          "hotSpots": []
        },
        "r-ballroom": {
          "title": "Ballroom",
          "hfov": 110,
          "pitch": -2,
          "yaw": -175,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/ballroom.jpg",
          "compass": false,
          "northOffset": 92,
          "hotSpots": []
        },
        "r-visit-scientist-room": {
          "title": "Visiting Scientist Room",
          "hfov": 110,
          "pitch": -3,
          "yaw": -176,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/visit-scientist-room.jpg",
          "compass": false,
          "northOffset": -85,
          "hotSpots": []
        },
        "r-pkm-room": {
          "title": "Ruang Konsultasi Mahasiswa",
          "hfov": 110,
          "pitch": 0,
          "yaw": 175,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/pkm-room.jpg",
          "compass": false,
          "northOffset": -2,
          "hotSpots": []
        },
        "k-visit-scientist": {
          "title": "Visiting Scientist",
          "hfov": 110,
          "pitch": 2,
          "yaw": -3,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/visit-scientist.jpg",
          "compass": false,
          "northOffset": -3,
          "hotSpots": [{
              "pitch": 0,
              "yaw": 0,
              "type": "scene",
              "text": "Masuk ke ruangan Visiting Scientist",
              "sceneId": "24",
              "URL": ""
            },
            {
              "pitch": -2,
              "yaw": 55,
              "type": "scene",
              "text": "Masuk ke dalam Ballroom",
              "sceneId": "23",
              "URL": ""
            },
            {
              "pitch": -2,
              "yaw": 103,
              "type": "scene",
              "text": "Masuk ke dalam PKM",
              "sceneId": "25",
              "URL": ""
            },
            {
              "pitch": 0,
              "yaw": -64,
              "type": "scene",
              "text": "Masuk ke Ruang dosen",
              "sceneId": "29",
              "URL": ""
            },
          ]
        },
        "k-kantor-dep-mat": {
          "title": "Departemen Matematika",
          "hfov": 110,
          "pitch": 1,
          "yaw": 179,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/kantor-dep-mat.jpg",
          "compass": false,
          "northOffset": -87,
          "hotSpots": [{
              "pitch": -1,
              "yaw": -112,
              "type": "scene",
              "text": "Pergi ke kantin",
              "sceneId": "15",
              "URL": ""
            },
            {
              "pitch": 0,
              "yaw": -175,
              "type": "scene",
              "text": "Pelayanan Administrasi",
              "sceneId": "30",
              "URL": ""
            },
            {
              "pitch": 0,
              "yaw": -21,
              "type": "scene",
              "text": "Masuk ke teaching staff",
              "sceneId": "28",
              "URL": ""
            },
            {
              "pitch": -2,
              "yaw": 97,
              "type": "info",
              "text": "Ke toilet",
              "sceneId": "",
              "URL": ""
            },
            {
              "pitch": 0,
              "yaw": 0,
              "type": "scene",
              "text": "Rektorat",
              "sceneId": "17",
              "URL": ""
            },
          ]
        },
        "r-t-staff-room3": {
          "title": "Teaching Staff Room B",
          "hfov": 110,
          "pitch": -3,
          "yaw": 41,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/t-staff-room3.jpg",
          "compass": false,
          "northOffset": -104,
          "hotSpots": []
        },
        "r-t-staff-room4": {
          "title": "Teaching Staff Room B",
          "hfov": 110,
          "pitch": 0,
          "yaw": 127,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/t-staff-room4.jpg",
          "compass": false,
          "northOffset": -100,
          "hotSpots": []
        },
        "r-staf-admin": {
          "title": "Pelayanan Administrasi",
          "hfov": 110,
          "pitch": 1,
          "yaw": -2,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/staf-admin.jpg",
          "compass": false,
          "northOffset": -2,
          "hotSpots": []
        },
        "r-ruang-rapat": {
          "title": "Ruang Rapat",
          "hfov": 110,
          "pitch": 0,
          "yaw": -100,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/ruang-rapat.jpg",
          "compass": false,
          "northOffset": -7,
          "hotSpots": [{
              "pitch": -5,
              "yaw": 83,
              "type": "scene",
              "text": "Pelayanan Administrasi",
              "sceneId": "30",
              "URL": ""
            },
            {
              "pitch": -3,
              "yaw": 173,
              "type": "scene",
              "text": "Masuk ke ruang meeting",
              "sceneId": "32",
              "URL": ""
            },
          ]
        },
        "r-ruang-meeting": {
          "title": "Ruangan Meeting",
          "hfov": 110,
          "pitch": 0,
          "yaw": 11,
          "type": "equirectangular",
          "panorama": "http://localhost:8080/uploads/ruang-meeting.jpg",
          "compass": false,
          "northOffset": -90,
          "hotSpots": []
        },
        "koridor": {
          "title": "Data sampel",
          "hfov": 110,
          "pitch": 0,
          "yaw": -92,
          "type": "equirectangular",
          "panorama": "/uploads/for-test_2.jpg",
          "hotSpots": [{
              "pitch": -1.7,
              "yaw": 89,
              "type": "scene",
              "text": "Welcome Door",
              "sceneId": "welcomedoor"
            },
            {
              "pitch": -5,
              "yaw": -71.5,
              "type": "scene",
              "text": "Koridor",
              "sceneId": "koridor"
            }
          ]
        },
        "": {}
      }
    });
    console.log('Panorama loaded!');
  }
</script>