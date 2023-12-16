<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="grid"></i></div>
                        <?= $title; ?>
                    </h1>
                    <div class="page-header-subtitle">A <u>virtual tour</u> is a simulation of an existing location, usually composed of a sequence of images or videos. It allows users to experience or explore a place as if they were physically present, even if they are accessing it remotely.</div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="row">
        <div class="col-xl-4 mb-4">
            <!-- Dashboard example card 1-->
            <a class="card lift h-100" href="./scenes">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <i class="feather-xl text-primary mb-3" data-feather="image"></i>
                            <h5 class="card-title"><b><?= $sceneCount; ?></b> Scenes</h5>
                            <div class="text-muted small">Users can navigate between different scenes to explore various parts of the virtual tour.</div>
                        </div>
                        <img src="assets/img/illustrations/browser-stats.svg" alt="..." style="width: 8rem" />
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 mb-4">
            <!-- Dashboard example card 2-->
            <a class="card lift h-100" href="./hotspots">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <i class="feather-xl text-secondary mb-3" data-feather="map-pin"></i>
                            <h5 class="card-title"><b><?= $hotspotCount; ?></b> Hotspots</h5>
                            <div class="text-muted small">Users can click or interact with these hotspots to access additional information, images, or links.</div>
                        </div>
                        <img src="assets/img/illustrations/processing.svg" alt="..." style="width: 8rem" />
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 mb-4">
            <!-- Dashboard example card 3-->
            <a class="card lift h-100" href="./maps">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="me-3">
                            <i class="feather-xl text-green mb-3" data-feather="map"></i>
                            <h5 class="card-title"><b><?= $mapCount; ?></b> Maps Pin</h5>
                            <div class="text-muted small">Refers to a digital marker or icon used on digital maps to indicate a specific location.</div>
                        </div>
                        <img src="assets/img/illustrations/windows.svg" alt="..." style="width: 8rem" />
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>