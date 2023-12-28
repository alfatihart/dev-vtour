<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<header id="main-head" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="image"></i></div>
                        Scenes List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= base_url('scenes/create'); ?>">
                        <i class="me-1" data-feather="plus"></i>
                        Create New Scene
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
            <li class="breadcrumb-item active">Scenes</li>
        </ol>
    </nav>
    <!-- <php if (session()->getFlashdata('message')) {
        echo '<div class="alert alert-success" role="alert">' . session()->getFlashdata('message') . '</div>';
    } ?> -->
    <div class="card">
        <!-- <div class="card-header">Extended DataTables</div> -->
        <div class="card-body table-responsive">
            <table id="datatablesSimple" class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Scene ID</th>
                        <th>Title</th>
                        <th>Hotspots</th>
                        <th>Pitch</th>
                        <th>Yaw</th>
                        <th>Preview</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Scene ID</th>
                        <th>Title</th>
                        <th>Total<br>Hotspots</th>
                        <th>Pitch</th>
                        <th>Yaw</th>
                        <th>Preview</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1;
                    foreach ($scenes as $scene) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $scene['slug']; ?></td>
                            <td><?= $scene['title']; ?></td>
                            <td><?= $scene['hotspotCount']; ?></td>
                            <td><?= $scene['pitch']; ?></td>
                            <td><?= $scene['yaw']; ?></td>
                            <td>
                                <img src="<?= base_url('scenes/thumbnail?image=' . $scene['image']); ?>" width="100px" class="img-fluid" alt="Panorama Image">
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('scenes/' . $scene['slug']); ?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('scenes/edit/' . $scene['slug']); ?>" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i></a>
                                    <!-- Button trigger modal -->
                                    <div class="btn btn-sm btn-danger">
                                        <form id="deleteForm#<?= $scene['id']; ?>" action="<?= base_url('scenes/' . $scene['id']); ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div type="button" onclick="confirmDelete(<?= $scene['id']; ?>)">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </form>
                                    </div>
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
    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        Swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        Swal.fire({
            title: 'Failed!',
            text: '<?= session()->getFlashdata('fail') ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>
<?php $this->endSection(); ?>