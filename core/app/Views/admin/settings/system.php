<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="settings"></i></div>
                        <?= $title; ?>
                    </h1>
                    <div class="page-header-subtitle">This page is for setting up the pannellum system on the application home page.</div>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <button id="editButton" class="btn btn-sm btn-light text-primary">
                        <i class="me-1" data-feather="edit"></i>
                        Edit Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="card">
        <div class="card-header">Change Panorama Behavior</div>
        <div class="card-body">
            <form id="myForm" action="<?= base_url('system/update/' . $settings['id']); ?>" method="post" class="row g-3">
                <?= csrf_field(); ?>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="first-scene">First Scene</label>
                        <select name="first_scene" class="form-control form-control-solid form-select" id="first-scene" required>
                            <option value="" disabled hidden>Choose forst scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                $selected = ($value['id'] == $settings['first_scene']) ? 'selected' : '';
                                echo '<option value="' . $value['id'] . '" data-image-name="' . $value['image'] . '" ' . $selected . '>' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="author">Author</label>
                        <input type="text" name="author" value="<?= $settings['author']; ?>" class="form-control form-control-solid" id="author" placeholder="Text for hotspots" required>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="auto-load">Auto Load</label>
                            <select name="auto_load" class="form-control form-control-solid form-select" id="auto-load" required>
                                <option value="1" <?= $settings['auto_load'] == 1 ? "selected" : ""; ?>>True</option>
                                <option value="0" <?= $settings['auto_load'] == 0 ? "selected" : ""; ?>>False</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="scene-fade">Scene Fade Duration</label>
                            <input type="number" name="scene_fade" value="<?= $settings['scene_fade']; ?>" class="form-control form-control-solid" id="scene-fade" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="compass">Compass</label>
                            <select name="compass" class="form-control form-control-solid form-select" id="compass" required>
                                <option value="1" <?= $settings['compass'] == 1 ? "selected" : ""; ?>>True</option>
                                <option value="0" <?= $settings['compass'] == 0 ? "selected" : ""; ?>>False</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="device-orientation">Device Orientation</label>
                            <select name="device_orientation" class="form-control form-control-solid form-select" id="device-orientation" required>
                                <option value="1" <?= $settings['device_orientation'] == 1 ? "selected" : ""; ?>>True</option>
                                <option value="0" <?= $settings['device_orientation'] == 0 ? "selected" : ""; ?>>False</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="auto-rotate">Auto Rotate Degree</label>
                            <input type="number" name="auto_rotate" value="<?= $settings['auto_rotate']; ?>" class="form-control form-control-solid" id="auto-rotate" placeholder="0" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="rotate-delay">Rotate Inactivity Delay</label>
                            <input type="number" name="rotate_delay" value="<?= $settings['rotate_delay']; ?>" class="form-control form-control-solid" id="rotate-delay" placeholder="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="show-controls">Show Controls</label>
                            <select name="show_controls" class="form-control form-control-solid form-select" id="show-controls" required>
                                <option value="1" <?= $settings['show_controls'] == 1 ? "selected" : ""; ?>>True</option>
                                <option value="0" <?= $settings['show_controls'] == 0 ? "selected" : ""; ?>>False</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-label" for="hotspot-debug">Hotspot Debug</label>
                            <select name="hotspot_debug" class="form-control form-control-solid form-select" id="hotspot-debug" required>
                                <option value="1" <?= $settings['hotspot_debug'] == 1 ? "selected" : ""; ?>>True</option>
                                <option value="0" <?= $settings['hotspot_debug'] == 0 ? "selected" : ""; ?>>False</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                    <button id="btnForm" onclick="window.location.reload();" type="reset" class="btn btn-outline-dark">Cancel</button>
                    <button id="btnForm" type="submit" class="btn btn-primary">Save it!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    document.querySelectorAll('#myForm input, #myForm select, #myForm button').forEach(element => element.disabled = true);

    <?php if (session()->getFlashdata('message')) : ?>
        Swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('message') ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    document.getElementById('editButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Warning!',
            text: 'You can edit the form now!',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        // Get all input elements within the form
        document.querySelectorAll('#myForm input, #myForm select, #myForm button').forEach(element => element.disabled = false);

        this.disabled = true;
    });

    document.getElementById('btnForm').addEventListener('click', function() {
        document.querySelector('#editButton').disabled = false;
    });
</script>
<?php $this->endSection(); ?>