<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
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
            <li class="breadcrumb-item"><a href="<?= base_url('scenes'); ?>">Scenes</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </nav>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <!-- <script src="https://kit.fontawesome.com/f65970523e.js" crossorigin="anonymous"></script> -->
    <style>
        .project-info-box {
            margin: 15px 0;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 5px;
        }

        .project-info-box p {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #d5dadb;
        }

        .project-info-box p:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        img {
            width: 100%;
            max-width: 100%;
            height: auto;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .rounded {
            border-radius: 5px !important;
        }

        .mr-5 {
            margin-right: 5px !important;
        }

        p {
            font-weight: 300;
            font-size: 1rem;
            color: #686c6d;
            letter-spacing: 0.03rem;
            margin-bottom: 10px;
        }

        b,
        strong {
            font-weight: 700 !important;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card  text-bg-primary">
                    <div class="card-header">Scene : <?= $scene['title']; ?></div>
                </div>
                <!-- <div class="project-info-box mt-0">
                    <h5>SCENE DETAILS</h5>
                    <p class="mb-0">In the context of a virtual tour, a "scene" typically refers to a single panoramic image or a point of view within the tour. Each scene provides a 360-degree view of a specific location. Users can navigate between different scenes to explore different areas of the tour.</p>
                </div> -->

                <div class="project-info-box shadow">
                    <p><b>Title:</b> <?= $scene['title']; ?></p>
                    <p><b>Scene ID:</b> <?= $scene['slug']; ?></p>
                    <p><b>Hfov:</b> <?= $scene['hfov']; ?></p>
                    <p><b>Pitch:</b> <?= $scene['pitch']; ?></p>
                    <p><b>Yaw:</b> <?= $scene['yaw']; ?></p>
                    <p><b>North Offset:</b> <?= $scene['north_offset']; ?></p>
                    <p class="mb-0 text-break"><b>Image:</b> <?= $scene['image']; ?></p>
                </div>
            </div>

            <div class="col-md-7">
                <img src="<?= base_url('uploads/' . $scene['image']); ?>" alt="Panorama Image" class="rounded">
                <div class="mt-4">
                    <span class="fw-bold mr-10 va-middle hide-mobile">Actions:</span>
                    <a href="<?= base_url('scenes/' . $scene['slug']); ?>" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye me-1"></i>Show</a>
                    <a href="<?= base_url('scenes/edit/' . $scene['slug']); ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit me-1"></i>Edit</a>
                    <!-- Button trigger modal -->
                    <form id="deleteForm#<?= $scene['id']; ?>" action="<?= base_url('scenes/' . $scene['id']); ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $scene['id']; ?>)">
                            <i class="fa fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm#' + id).submit();
            }
        });
    }
</script>
<?php $this->endSection(); ?>