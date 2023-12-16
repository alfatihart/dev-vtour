pannellum.viewer('panorama', {
    "default": {
        "firstScene": "welcomedoor", //mestinya mulai dari welcomedoor
        "author": "Restu Adi Akbar",
        "autoLoad": true,
        "hotSpotDebug": true,
        "sceneFadeDuration": 1000,
        "autoRotate": 0,
        "autoRotateInactivityDelay": 1000000
    },
    "scenes": {
        "welcomedoor": {
            "title": "Welcome Door",
            "hfov": 110,
            "pitch": -1.22,
            "yaw": -179.9,
            "type": "equirectangular",
            "panorama": "./images/01_pintu_masuk_dep_matematika.jpg",
            "compass": true,
            "northOffset": -90,
            "hotSpots": [
                {
                    "pitch": -1.22,
                    "yaw": -174,
                    "type": "scene",
                    "text": "Teaching Staff",
                    "sceneId": "teaching"
                }
            ]
        },
        "teaching": {
            "title": "Teaching Staff",
            "hfov": 110,
            "pitch": -2.5,
            "yaw": 102,
            "type": "equirectangular",
            "panorama": "./images/02_pintu_teaching_staff_A.jpg",
            "hotSpots": [
                {
                    "pitch": -1.5,
                    "yaw": 273,
                    "type": "scene",
                    "text": "Welcome Door",
                    "sceneId": "welcomedoor"
                },
                {
                    "pitch": -5,
                    "yaw": 179,
                    "type": "scene",
                    "text": "Teaching Staff Room",
                    "sceneId": "staffroom1"
                },
                {
                    "pitch": -5,
                    "yaw": 93,
                    "type": "scene",
                    "text": "Koridor",
                    "sceneId": "koridor"
                }
            ]
        },
        "staffroom1": {
            "title": "Teaching Staff",
            "hfov": 110,
            "pitch": -3.7,
            "yaw": 2.6,
            "type": "equirectangular",
            "panorama": "./images/03_ruangan_teaching_staff_A.jpg",
            "hotSpots": [
                {
                    "pitch": -3,
                    "yaw": -102,
                    "type": "scene",
                    "text": "Koridor",
                    "sceneId": "teaching"
                },
                {
                    "pitch": -4,
                    "yaw": 2.8,
                    "type": "scene",
                    "text": "Teaching Staff Room",
                    "sceneId": "staffroom2"
                }
            ]
        },
        "staffroom2": {
            "title": "Teaching Staff",
            "hfov": 110,
            "pitch": 0.45,
            "yaw": -142,
            "type": "equirectangular",
            "panorama": "./images/04_ruangan_teaching_staff_B.jpg",
            "hotSpots": [
                {
                    "pitch": -5,
                    "yaw": -179,
                    "type": "scene",
                    "text": "Teaching Staff",
                    "sceneId": "staffroom1"
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
        "koridor": {
            "title": "Teaching Staff",
            "hfov": 110,
            "pitch": 0,
            "yaw": -92,
            "type": "equirectangular",
            "panorama": "./images/05_pintu_teaching_staff_B.jpg",
            "hotSpots": [
                {
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