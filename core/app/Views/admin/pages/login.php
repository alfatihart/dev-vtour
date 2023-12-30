<?php $this->extend('layouts/auth'); ?>

<?php $this->section('content'); ?>
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic login form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <!-- Login form-->
                    <form action="<?= route_to('admin.login.handler'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input name="username" class="form-control" id="inputUsername" type="text" placeholder="Enter username" value="<?= set_value('username'); ?>" />
                        </div>
                        <!-- Form Group (password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPassword">Password</label>
                            <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Enter password" value="<?= set_value('password'); ?>" />
                        </div>
                        <!-- Form Group (remember password checkbox)-->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
                            </div>
                        </div>
                        <!-- Form Group (login box)-->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="<?= base_url('forgot-pw'); ?>">Forgot Password?</a>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <?php if ($usersCount == 0) : ?>
                    <div class="card-footer text-center">
                        <div class="small"><a href="<?= route_to('admin.register.form'); ?>">Need an account? Sign up!</a></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
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