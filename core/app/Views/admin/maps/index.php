<?php

use App\Models\MapModel;

$this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<header id="main-head" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="map"></i></div>
                        <?= $title; ?> List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="new">
                        <i class="me-1" data-feather="plus"></i>
                        Create New Maps Pin
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
            <li class="breadcrumb-item active">Maps Pin</li>
        </ol>
    </nav>
    <div class="card">
        <!-- <div class="card-header">Extended DataTables</div> -->
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Scene ID</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Scene ID</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $n = 1;
                    foreach ($maps as $map) : ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $map['name']; ?></td>
                            <td><?= $map['scene_slug']; ?></td>
                            <td><?= $map['latitude']; ?></td>
                            <td><?= $map['longitude']; ?></td>
                            <td>
                                <div>
                                    <!-- <a href="/maps/edit/<= $map['id']; ?>" class="btn btn-sm btn-warning" role="button"><i class="fa fa-edit me-1"></i>Edit</a> -->
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-whatever="<?= $map['id']; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-edit"></i></button>
                                    <!-- Button trigger modal -->
                                    <form id="deleteForm#<?= $map['id']; ?>" action="<?= base_url('maps/' . $map['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!-- <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<= $map['id']; ?>)">
                                            <i class="fa fa-trash me-1"></i>Delete
                                        </button> -->
                                        <button type="button" class="btn btn-datatable btn-icon btn-transparent-danger" onclick="confirmDelete(<?= $map['id']; ?>)"><i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Maps Modal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="maps-form" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="[in]-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control form-control-solid" id="pin-name" placeholder="Name of pin" required>
                    </div>
                    <div class="mb-3">
                        <label for="scene-id" class="col-form-label">Scene Id:</label>
                        <select name="scene_id" class="form-control form-control-solid form-select" id="scene-id" required>
                            <option value="" disabled selected hidden>Choose main scene</option>
                            <?php foreach ($scenes as $key => $value) {
                                echo '<option value="' . $value['id'] . '"data-image-name="' . $value['image'] . '">(' . strtoupper(substr($value['slug'], 0, 1)) . ') ' . $value['title'] . '</option>';
                            }; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="col-form-label">Latitude:</label>
                        <input type="number" step="0.000000000000001" name="latitude" class="form-control form-control-solid" id="latitude" placeholder="-5.132453768057395" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="col-form-label">Longitude:</label>
                        <input type="number" step="0.000000000000001" name="longitude" class="form-control form-control-solid" id="longitude" placeholder="119.48799919063822" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button id="save-btn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
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

    const exampleModal = document.getElementById('staticBackdrop')
    if (exampleModal) {
        const mapsForm = document.getElementById('maps-form')
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            const modalTitle = exampleModal.querySelector('.modal-title')
            if (recipient == 'new') {
                // New record
                modalTitle.textContent = 'Create New Maps Pin'
                mapsForm.setAttribute('action', '/maps/store')

                // Clear form fields
                $('#pin-name').val('');
                $('#scene-id').val('');
                $('#latitude').val('');
                $('#longitude').val('');

                return
            } else {
                // Edit record
                $.ajax({
                    url: "/maps/edit/" + recipient,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#pin-name').val(data.name);
                        $('#scene-id').val(data.scene_id);
                        $('#latitude').val(data.latitude);
                        $('#longitude').val(data.longitude);
                    }
                });

                modalTitle.textContent = `Edit ${recipient} Maps Pin`
                mapsForm.setAttribute('action', `/maps/update/${recipient}`)
            }
        })
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