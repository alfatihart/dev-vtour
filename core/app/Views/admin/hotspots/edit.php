<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<!-- Load Pannellum JavaScript -->
<script src="<?= base_url('assets/js/pannellum.js'); ?>"></script>
<script src="<?= base_url('assets/js/libpannellum.js'); ?>"></script>
<!-- Load Pannellum CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/pannellum.css'); ?>">

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file-text"></i></div>
                        <?= $title; ?>
                    </h1>
                </div>
                <!-- <div class="col-12 col-xl-auto mb-3">Optional page header content</div> -->
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <nav class="rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('hotspots'); ?>">Hotspots</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Edit Hotspot Form</div>
        <div class="card-body">
            <form action="<?= base_url('hotspots/update/' . $hotspot['id']); ?>" method="post" class="row g-3">
                <?= csrf_field(); ?>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="main-scene">Main Scene</label>
                        <select name="main_scene" class="form-control form-control-solid form-select" id="main-scene" required>
                            <option value="" disabled hidden>Choose main scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                $selected = ($value['id'] == $hotspot['main_scene']) ? 'selected' : '';
                                echo '<option value="' . $value['id'] . '" data-image-name="' . $value['image'] . '" ' . $selected . '>(' . strtoupper(substr($value['slug'], 0, 1)) . ') ' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="type">Type</label>
                            <select name="type" class="form-control form-control-solid form-select" id="type" required>
                                <option value="scene" <?= $hotspot['type'] == 'scene' ? 'selected' : '';; ?>>Scene</option>
                                <option value="info" <?= $hotspot['type'] == 'info' ? 'selected' : '';; ?>>Info</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="style">Hotspot Style</label>
                            <select name="style" class="form-control form-control-solid form-select" id="style" required>
                                <option value="step-hotspot" <?= $hotspot['style'] == 'scene' ? 'selected' : '';; ?>>Step</option>
                                <option value="room-hotspot" <?= $hotspot['style'] == 'scene' ? 'selected' : '';; ?>>Room</option>
                                <option value="info-hotspot" <?= $hotspot['style'] == 'info' ? 'selected' : '';; ?>>Info</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="text">Text</label>
                        <input type="text" name="text" value="<?= (old('text')) ? old('text') : $hotspot['text']; ?>" class="form-control form-control-solid" id="text" placeholder="Text for hotspots" required>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="pitch">Pitch</label>
                            <input type="number" name="pitch" value="<?= (old('pitch')) ? old('pitch') : $hotspot['pitch']; ?>" class="form-control form-control-solid" id="pitch" placeholder="0">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="yaw">Yaw</label>
                            <input type="number" name="yaw" value="<?= (old('yaw')) ? old('yaw') : $hotspot['yaw']; ?>" class="form-control form-control-solid" id="yaw" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group mb-3" id="t-scene">
                        <label class="form-label" for="target-scene">Target Scene</label>
                        <select name="target_scene" class="form-control form-control-solid form-select" id="target-scene" required>
                            <option value="" disabled hidden>Choose main scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                $selected = ($value['id'] == $hotspot['target_scene']) ? 'selected' : '';
                                echo '<option value="' . $value['id'] . '" data-image-name="' . $value['image'] . '" ' . $selected . '>(' . strtoupper(substr($value['slug'], 0, 1)) . ') ' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3" id="t-url">
                        <label class="form-label" for="text">Target URL</label>
                        <input type="text" value="<?= (old('url')) ? old('url') : $hotspot['url']; ?>" name="url" class="form-control form-control-solid" id="target-url" placeholder="http://domain.com/whatever">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <span class="form-label">Preview</span>
                        <img id="previewImage" class="img-thumbnail img-fluid" src="<?= base_url('assets/img/no-image.png'); ?>" alt="Preview">
                    </div>
                    <div id="debug" class="form-group mb-3"></div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var typeSelect = document.getElementById('type');
        var targetScene = document.getElementById('t-scene');
        var targetUrl = document.getElementById('t-url');
        var tScn = document.getElementById('target-scene');

        function checkType() {
            var type = typeSelect.value;
            if (type == 'scene') {
                targetUrl.style.display = 'none';
                targetScene.style.display = 'block';
                targetUrl.value = "";
                tScn.required = true;
            } else if (type == 'info') {
                targetScene.style.display = 'none';
                targetUrl.style.display = 'block';
                targetScene.value = "";
                tScn.required = false;
            }
        }

        // Check the type when the page is loaded
        checkType();

        // Check the type when the select field changes
        typeSelect.addEventListener('change', checkType);
    });

    // // Get image name from the selected option
    // document.getElementById('main-scene').addEventListener('change', function(e) {
    //     var imageName = e.target.options[e.target.selectedIndex].dataset.imageName;
    //     var previewImage = document.getElementById('previewImage');

    //     console.log(imageName);
    //     // previewImage.src = '/uploads/' + imageName;
    // });

    // Load the panorama when the select field changes
    document.addEventListener('DOMContentLoaded', function() {
        var panoramaHTML = '<div id="previewImage" style="display: flex; justify-content: center; align-items: center; overflow: auto;"><div id="panoramaContainer" style="position: relative; width: 650px;"><div id="panorama" style="min-width: 480; min-height: 350px;"></div><div id="marker" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30px; height: 30px; line-height: 30px; text-align: center; color: red; border: 2px solid red; border-radius: 50%;">+</div></div></div>';
        var previewImage = document.getElementById('previewImage');
        previewImage.outerHTML = panoramaHTML;
        var mainScene = document.getElementById('main-scene')

        function loadImage() {
            var selectedOption = mainScene.options[mainScene.selectedIndex];
            var imageUrl = '<?= base_url('uploads/'); ?>' + selectedOption.dataset.imageName;
            console.log(imageUrl);

            var viewer = pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": imageUrl,
                "autoLoad": true,
                "compass": false
            });
            setInterval(function() {
                var pitch = viewer.getPitch();
                var yaw = viewer.getYaw();
                console.log('Pitch: ' + pitch + ', Yaw: ' + yaw);
                document.getElementById('debug').innerHTML = 'Pitch: ' + Math.round(pitch) + ', Yaw/North: ' + Math.round(yaw);
            }, 1000);
        }

        // Load the panorama when the page is loaded
        loadImage();
        mainScene.addEventListener('change', loadImage);
    });
</script>
<?php $this->endSection(); ?>