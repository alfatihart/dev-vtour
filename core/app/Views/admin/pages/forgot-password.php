<?php $this->extend('layouts/auth'); ?>

<?php $this->section('content'); ?>
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic forgot password form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Password Recovery</h3>
                </div>
                <div class="card-body">
                    <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                    <!-- Forgot password form-->
                    <form>
                        <?= csrf_field(); ?>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                        </div>
                        <!-- Form Group (submit options)-->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="<?= route_to('admin.login.form'); ?>">Return to login</a>
                            <a class="btn btn-primary" href="<?= route_to('admin.login.form'); ?>">Reset Password</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="<?= route_to('admin.register.form'); ?>">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>