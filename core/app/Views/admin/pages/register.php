<?php $this->extend('layouts/auth'); ?>

<?php $this->section('content'); ?>
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <!-- Basic registration form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Create Account</h3>
                </div>
                <div class="card-body">
                    <!-- Registration form-->
                    <form action="<?= base_url('reg'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="role" value="admin">
                        <!-- Form Row-->
                        <div class="row gx-3">
                            <div class="col-md-6">
                                <!-- Form Group (first name)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                    <input name="firstname" class="form-control" id="inputFirstName" type="text" placeholder="Enter first name" value="<?= set_value('firstname'); ?>" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'firstname') : ''; ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (last name)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                    <input name="lastname" class="form-control" id="inputLastName" type="text" placeholder="Enter last name" value="<?= set_value('lastname'); ?>" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'lastname') : ''; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-6">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Username</label>
                                    <input name="username" class="form-control" id="inputUsername" type="text" placeholder="Enter username" value="<?= set_value('username'); ?>" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : ''; ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                    <input name="email" class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="<?= set_value('email'); ?>" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : ''; ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Form Row    -->
                        <div class="row gx-3">
                            <div class="col-md-6">
                                <!-- Form Group (password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Enter password" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : ''; ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Form Group (confirm password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                    <input name="cpassword" class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm password" />
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : ''; ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="<?= base_url('login'); ?>">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>