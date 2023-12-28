<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<!-- Load Pannellum JavaScript -->
<script src="<?= base_url('assets/js/pannellum.js'); ?>"></script>
<script src="<?= base_url('assets/js/libpannellum.js'); ?>"></script>
<!-- Load Pannellum CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/pannellum.css'); ?>">

<!-- CSS for Select2 -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> -->

<style>
    /* .select2-container {
        display: block;
        width: 100%;
        padding: 0.875rem 1.125rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #69707a;
        background-color: #eef2f8;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        border-color: #eef2f8;
    }

    .select2-dropdown {

    }

    */
</style>


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
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">New Hotspot Form</div>
        <div class="card-body">
            <form action="<?= base_url('hotspots/store'); ?>" method="post" class="row g-3">
                <?= csrf_field(); ?>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="main-scene">Main Scene</label>
                        <select name="main_scene" class="form-control form-control-solid form-select" id="main-scene" required>
                            <option value="" disabled selected hidden>Choose main scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                echo '<option value="' . $value['id'] . '"data-image-name="' . $value['image'] . '">(' . strtoupper(substr($value['slug'], 0, 1)) . ') ' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="type">Type</label>
                            <select name="type" class="form-control form-control-solid form-select" id="type" required>
                                <option value="scene" selected>Scene</option>
                                <option value="info">Info</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="style">Hotspot Style</label>
                            <select name="style" class="form-control form-control-solid form-select" id="style" required>
                                <option value="step-hotspot" selected>Step</option>
                                <option value="room-hotspot">Room</option>
                                <option value="info-hotspot">Info</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="text">Text</label>
                        <input type="text" name="text" class="form-control form-control-solid" id="text" placeholder="Text for hotspots" required>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="pitch">Pitch</label>
                            <input type="number" name="pitch" value="0" class="form-control form-control-solid" id="pitch" placeholder="0">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="yaw">Yaw</label>
                            <input type="number" name="yaw" value="0" class="form-control form-control-solid" id="yaw" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group mb-3" id="t-scene">
                        <label class="form-label" for="target-scene">Target Scene</label>
                        <select name="target_scene" class="form-control form-control-solid form-select" id="target-scene" required>
                            <option disabled selected hidden>Choose target scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                echo '<option value="' . $value['id'] . '">(' . strtoupper(substr($value['slug'], 0, 1)) . ') ' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3" id="t-url">
                        <label class="form-label" for="text">Target URL</label>
                        <input type="text" name="url" class="form-control form-control-solid" id="target-url" placeholder="http://domain.com/whatever">
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

<!-- Load jQuery and Select2 libraries -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<!-- Initialize Select2 on your select element -->
<script>
    // jQuery(document).ready(function($) {
    //     $('#main-scene').select2({
    //         theme: 'bootstrap-5',
    //         containerCssClass: 'form-control form-control-solid',
    //         dropdownCssClass: 'form-select'
    //     });
    //     $('#target-scene').select2({
    //         theme: 'bootstrap'
    //     });
    // });
</script>
<script>
    // Show/hide target scene or target url field
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
                targetUrl.value = null; // change this
                tScn.required = true;
            } else if (type == 'info') {
                targetScene.style.display = 'none';
                targetUrl.style.display = 'block';
                targetScene.value = null; // and this
                tScn.required = false;
            }
        }

        // Check the type when the page is loaded
        checkType();

        // Check the type when the select field changes
        typeSelect.addEventListener('change', checkType);
    });

    // Get image name from the selected option
    document.getElementById('main-scene').addEventListener('change', function(e) {
        var imageName = e.target.options[e.target.selectedIndex].dataset.imageName;
        var previewImage = document.getElementById('previewImage');

        console.log(imageName);
        // previewImage.src = '/uploads/' + imageName;
    });

    // Load the panorama when the select field changes
    document.getElementById('main-scene').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var imageUrl = '<?= base_url('uploads/'); ?>' + selectedOption.dataset.imageName;

        var panoramaHTML = '<div id="previewImage" style="display: flex; justify-content: center; align-items: center; overflow: auto;"><div id="panoramaContainer" style="position: relative; width: 650px;"><div id="panorama" style="min-width: 480; min-height: 350px;"></div><div id="marker" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30px; height: 30px; line-height: 30px; text-align: center; color: red; border: 2px solid red; border-radius: 50%;">+</div></div></div>';

        var previewImage = document.getElementById('previewImage');
        previewImage.outerHTML = panoramaHTML;

        var viewer = pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": imageUrl,
            "autoLoad": true,
            "hotSpotDebug": false
        });

        setInterval(function() {
            var pitch = viewer.getPitch();
            var yaw = viewer.getYaw();
            console.log('Pitch: ' + pitch + ', Yaw: ' + yaw);
            document.getElementById('debug').innerHTML = 'Pitch: ' + Math.round(pitch) + ', Yaw/North: ' + Math.round(yaw);
        }, 1000);
    });



    // document.getElementById('main-scene').addEventListener('change', function(e) {
    //     // var fileUrl = URL.createObjectURL(e.target.files[0]);

    //     var panoramaHTML = '<div id="previewImage" style="display: flex; justify-content: center; align-items: center; overflow: auto;"><div id="panoramaContainer" style="position: relative; width: 650px;"><div id="panorama" style="min-width: 480; min-height: 350px;"></div><div id="marker" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30px; height: 30px; line-height: 30px; text-align: center; color: red; border: 2px solid red; border-radius: 50%;">+</div></div></div>';

    //     // Replace the img tag with the new div
    //     var previewImage = document.getElementById('previewImage');
    //     previewImage.outerHTML = panoramaHTML;

    //     // Load the panorama
    //     var viewer = pannellum.viewer('panorama', {
    //         "type": "equirectangular",
    //         "panorama": fileUrl,
    //         "autoLoad": true,
    //         "hotSpotDebug": false
    //     });

    //     // Log the pitch and yaw every second
    //     setInterval(function() {
    //         var pitch = viewer.getPitch();
    //         var yaw = viewer.getYaw();
    //         console.log('Pitch: ' + pitch + ', Yaw: ' + yaw);
    //         document.getElementById('debug').innerHTML = 'Pitch: ' + Math.round(pitch) + ', Yaw/North: ' + Math.round(yaw);
    //     }, 1000);
    // });
</script>
<?php $this->endSection(); ?>