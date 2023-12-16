<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
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
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/scenes">Scenes</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">New Scene Form</div>
        <div class="card-body">
            <form action="/scenes/store" method="post" enctype="multipart/form-data" class="row g-3">
                <?= csrf_field(); ?>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="inputSceneId" class="form-label">Scene ID (slug)</label>
                        <input type="text" name="slug" class="form-control form-control-solid <?= validation_show_error('title') ? 'is-invalid' : '' ?>" id="inputSceneId" value="<?= old('slug') ?>" placeholder="office-room">
                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('slug') ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control form-control-solid <?= validation_show_error('title') ? 'is-invalid' : '' ?>" id="inputTitle" value="<?= old('title') ?>" placeholder="The Office Room">
                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('title') ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputHfov" class="form-label">Hfov</label>
                        <input type="number" name="hfov" value="110" class="form-control form-control-solid" id="inputHfov" placeholder="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPitch" class="form-label">Pitch</label>
                        <input type="number" name="pitch" value="0" class="form-control form-control-solid" id="inputPitch" placeholder="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputYaw" class="form-label">Yaw</label>
                        <input type="number" name="yaw" value="0" class="form-control form-control-solid" id="inputYaw" placeholder="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputNorthOffset" class="form-label">North Offset</label>
                        <input type="number" name="north_offset" value="0" class="form-control form-control-solid" id="inputNorthOffset" placeholder="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="inputImage" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control form-control-solid <?= validation_show_error('image') ? 'is-invalid' : '' ?>" id="inputImage" placeholder="Panorama" accept="image/jpeg">
                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('image') ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <span class="form-label">Preview</span>
                        <img class="img-thumbnail img-fluid" src="/assets/img/no-image.png" id="uploadImage" alt="Upload Image">
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
    document.getElementById('inputImage').addEventListener('change', function(e) {
        var fileUrl = URL.createObjectURL(e.target.files[0]);

        var panoramaHTML = '<div id="uploadImage" style="display: flex; justify-content: center; align-items: center; overflow: auto;"><div id="panoramaContainer" style="position: relative; width: 650px;"><div id="panorama" style="min-width: 480; min-height: 350px;"></div><div id="marker" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30px; height: 30px; line-height: 30px; text-align: center; color: red; border: 2px solid red; border-radius: 50%;">+</div></div></div>';

        // Replace the img tag with the new div
        var uploadImage = document.getElementById('uploadImage');
        uploadImage.outerHTML = panoramaHTML;

        // Load the panorama
        var viewer = pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": fileUrl,
            "autoLoad": true,
            "hotSpotDebug": false
        });

        // Log the pitch and yaw every second
        setInterval(function() {
            var pitch = viewer.getPitch();
            var yaw = viewer.getYaw();
            console.log('Pitch: ' + pitch + ', Yaw: ' + yaw);
            document.getElementById('debug').innerHTML = 'Pitch: ' + Math.round(pitch) + ', Yaw/North: ' + Math.round(yaw);
        }, 1000);
    });
</script>
<?= $this->endSection(); ?>