<!DOCTYPE html>
<html lang="en">
<?php
$firstScene = !empty($_GET['scene']) ? $_GET['scene'] : $firstSceneSlug;
$path = "https://cdn.jsdelivr.net/gh/alfatihart/vt-math@main/hd/";
$hd = !empty($_GET['hd']) ? $_GET['hd'] : false;
?>
<!-- WIFI LT1 SANDI 07051974 -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A virtual tour is a simulation of an existing location, usually composed of a sequence of videos or still images.">
    <meta name="author" content="RAA">
    <title>Maths Virtual Tour</title>
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" type="image/png">

    <!-- Load Pannellum JavaScript -->
    <script src="<?= base_url('assets/js/pannellum.js'); ?>"></script>
    <script src="<?= base_url('assets/js/libpannellum.js'); ?>"></script>
    <!-- Load Pannellum CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/pannellum.css'); ?>">

    <script rel="preconnect" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <?php include('stylesheets.php') ?>
</head>

<body>
    <div class="position-relative z-2">
        <div id="imageHD" class="position-absolute top-0 end-0">
            <button id="btnHD" class="bi-badge-hd" style="font-size: 3rem; color: cornflowerblue;" type="button" onclick="confirmHD()" aria-label="HD">
        </div>
    </div>
    <div id="panorama" style="width: 100vw; height: 100vh;">
        <nav class="navbar navbar-expand fixed-bottom custom-navbar shadow-sm p-0 pt-2 pb-2 pb-sm-0">
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
                        <div class="nav-link text-dark" onclick="toggle()">
                            <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Search</span>
                        </div>
                    <li class="nav-item text-center me-1 me-sm-3">
                        <button class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#exampleModalXl">
                            <i class="fa-regular fa-image fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Media</span>
                        </button>
                    </li>
                    <li class="nav-item text-center">
                        <div id="fullscreen" class="nav-link text-dark">
                            <i class="fa-solid fa-expand fa-2xl"></i>
                            <span class="small d-block mt-1 d-none d-sm-block">Maximize</span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php include('modals.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVYr3LxZOKtvdsczICy-K9CYZgLSoh51I&callback=initMap" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

    <?php include('scripts.php') ?>
</body>

</html>