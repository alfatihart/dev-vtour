<?php $this->extend('layouts/template'); ?>

<?php $this->section('content'); ?>
<header id="main-head" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        <?= $title; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link ms-0 <?= empty(session()->getFlashdata('activeTab')) ? 'active' : ''; ?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
            <a class="nav-link <?= session()->getFlashdata('activeTab') == 'nav-security' ? 'active' : ''; ?>" id="nav-security-tab" data-bs-toggle="tab" data-bs-target="#nav-security" type="button" role="tab" aria-controls="nav-security" aria-selected="false">Security</a>
        </div>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?= empty(session()->getFlashdata('activeTab')) ? 'show active' : ''; ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="<?= base_url('assets/img/illustrations/profiles/profile-1.png'); ?>" alt="" />
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form method="post" action="<?= route_to('admin.account.handler', $user['id']); ?>">
                                <?= csrf_field(); ?>
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                    <input name="username" class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?= $user['username']; ?>" required />
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                        <input name="first_name" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= $user['first_name']; ?>" required />
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                        <input name="last_name" class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= $user['last_name']; ?>" required />
                                    </div>
                                </div>

                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (email address)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                        <input name="email" class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?= $user['email']; ?>" required />
                                    </div>
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input name="phone_number" class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="<?= $user['phone_number']; ?>" />
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade <?= session()->getFlashdata('activeTab') == 'nav-security' ? 'show active' : ''; ?>" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab" tabindex="0">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Change password card-->
                    <div class="card mb-4">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form method="post" action="<?= route_to('admin.password.handler', $user['id']); ?>">
                                <?= csrf_field(); ?>
                                <!-- Form Group (current password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="currentPassword">Current Password</label>
                                    <input class="form-control <?= validation_show_error('currentPassword') ? 'is-invalid' : '' ?>"" name=" currentPassword" id="currentPassword" value="<?= old('currentPassword') ?>" type="password" placeholder="Enter current password" />
                                    <div class="invalid-feedback d-block">
                                        <?= validation_show_error('currentPassword') ?>
                                    </div>
                                </div>
                                <!-- Form Group (new password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="newPassword">New Password</label>
                                    <input name="newPassword" class="form-control <?= validation_show_error('newPassword') ? 'is-invalid' : '' ?>"" id=" newPassword" value="<?= old('newPassword') ?>" type="password" placeholder="Enter new password" />
                                    <div class="invalid-feedback d-block">
                                        <?= validation_show_error('newPassword') ?>
                                    </div>
                                </div>
                                <!-- Form Group (confirm password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                    <input class="form-control <?= validation_show_error('confirmPassword') ? 'is-invalid' : '' ?>"" name=" confirmPassword" id="confirmPassword" value="<?= old('confirmPassword') ?>" type="password" placeholder="Confirm new password" />
                                    <div class="invalid-feedback d-block">
                                        <?= validation_show_error('confirmPassword') ?>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>