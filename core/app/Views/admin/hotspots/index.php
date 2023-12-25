<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<style>
    td p {
        max-width: 25ch;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin: 0;
        direction: rtl;
        text-align: end;
    }
</style>

<header id="main-head" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="map-pin"></i></div>
                        Hotspots List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= base_url('hotspots/create'); ?>">
                        <i class="me-1" data-feather="plus"></i>
                        Create New Hotspot
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <nav class="rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Hotspots</li>
        </ol>
    </nav>
    <div class="card">
        <!-- <div class="card-header">Extended DataTables</div> -->
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Main Scene</th>
                        <th>Pitch</th>
                        <th>Yaw</th>
                        <th>Target</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Main Scene</th>
                        <th>Type</th>
                        <th>Text</th>
                        <th>Target</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1;
                    foreach ($hotspots as $hotspot) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td>
                                <div class="text-wrap"><?= $hotspot['text']; ?></div>
                            </td>
                            <td>
                                <div class="w-75 badge <?= $hotspot['type'] == 'scene' ? 'bg-primary' : 'bg-orange'; ?> text-white rounded-pill fw-bold font-monospace"><?= $hotspot['type']; ?></div>
                                <div class="w-75 badge <?= $hotspot['style'] == 'step-hotspot' ? 'bg-danger' : ($hotspot['style'] == 'room-hotspot' ? 'bg-dark' : 'bg-success'); ?> text-white rounded-pill fw-bold font-monospace"><?= $hotspot['style']; ?></div>
                            </td>
                            <td><?= $hotspot['main_scene_slug']; ?></td>
                            <td><?= $hotspot['pitch']; ?></td>
                            <td><?= $hotspot['yaw']; ?></td>
                            <td>
                                <!-- <p class="text-wrap text-break m-0" style="max-width: 25ch;"> -->
                                <p><?= $hotspot['target_scene_slug'] != null ? $hotspot['target_scene_slug'] : $hotspot['url']; ?></p>
                            </td>
                            <td>
                                <div>
                                    <a href="" class="btn btn-sm btn-primary" role="button">
                                        <i class="fa fa-eye me-1"></i>Show</a>
                                    <a href="<?= base_url('hotspots/edit/' . $hotspot['id']); ?>" class="btn btn-sm btn-warning" role="button">
                                        <i class="fa fa-edit me-1"></i>Edit</a>
                                    <!-- Button trigger modal -->
                                    <form id="deleteForm#<?= $hotspot['id']; ?>" action="<?= base_url('hotspots/' . $hotspot['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $hotspot['id']; ?>)">
                                            <i class="fa fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                                <!-- <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa-regular fa-trash-can"></i></button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            customClass: {
                popup: 'my-swal'
            },
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
<script>
    <?php if (session()->getFlashdata('message')) : ?>
        Swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('message') ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>
<?php $this->endSection(); ?>