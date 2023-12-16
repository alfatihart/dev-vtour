<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?> - Virtual Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" async />
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" async />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <style>
        #lightSwitch {
            transform: scale(1.8);
        }

        .custom-theme.bg-light {
            background-color: darkslategray !important;
            border-radius: 3px;
            color: gainsboro;
            text-decoration: underline;
        }

        .custom-theme.bg-dark {
            background-color: blanchedalmond !important;
            box-shadow: 10px 5px 5px rgba(246, 255, 219, 0.5);
            color: dimgray;
            text-decoration: overline;
        }

        .my-swal {
            position: fixed;
            top: 30%;
        }

        @media (max-width: 1500px) {
            .btn {
                margin-right: 5px;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle" aria-label="Toggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="./">Maths V-Tour</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <div class="m-auto d-none d-lg-block me-3 text-end"><b>Welcome to Mathematics Department Virtual Tour!</b></div>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">

            <!-- TESTING DARK MODE -->
            <li class="nav-item me-3">
                <div class="form-check form-switch ms-auto align-items-center">
                    <label class="form-check-label ms-3" for="lightSwitch">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16">
                            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                        </svg>
                    </label>
                    <input class="form-check-input mt-2" type="checkbox" id="lightSwitch" />
                </div>
            </li>

            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Profile" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" alt="Profile" src="<?= base_url('assets/img/illustrations/profiles/profile-1.png'); ?>" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" alt="Profile" src="<?= base_url('assets/img/illustrations/profiles/profile-1.png'); ?>" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= session()->get('fullname'); ?></div>
                            <div class="dropdown-user-details-email"><?= session()->get('email'); ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('account'); ?>">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="/logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Heading (Menus)-->
                        <div class="sidenav-menu-heading">Menus</div>
                        <!-- Sidenav Link (Dashboard)-->
                        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                            <div class="nav-link-icon"><i data-feather="grid"></i></div>
                            Dashboard
                        </a>
                        <!-- Sidenav Link (Scenes)-->
                        <a class="nav-link" href="<?= base_url('scenes'); ?>">
                            <div class="nav-link-icon"><i data-feather="image"></i></div>
                            Scenes
                        </a>
                        <!-- Sidenav Link (Hotspots)-->
                        <a class="nav-link" href="<?= base_url('hotspots'); ?>">
                            <div class="nav-link-icon"><i data-feather="map-pin"></i></div>
                            Hotspots
                        </a>
                        <!-- Sidenav Link (Maps)-->
                        <a class="nav-link" href="<?= base_url('maps'); ?>">
                            <div class="nav-link-icon"><i data-feather="map"></i></div>
                            Maps
                        </a>
                        <hr class="hr" />
                        <!-- Sidenav Accordion (Settings)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseApps" aria-expanded="false" aria-controls="collapseApps">
                            <div class="nav-link-icon"><i data-feather="settings"></i></div>
                            Settings
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseApps" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                                <a class="nav-link" href="<?= base_url('account'); ?>">Account</a>
                                <a class="nav-link" href="<?= base_url('system'); ?>">System</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?= session()->get('fullname'); ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <!-- Main content here -->
                <?= $this->renderSection('content'); ?>
            </main>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; <?= date("Y") ?> Maths Virtual Tour</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="https://github.com/alfatihart" target="_blank" class="link-secondary" rel="noopener">
                                Made with
                                <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                </svg>
                                by RAA
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/datatables/datatables-simple-demo.js'); ?>"></script>
    <script src="<?= base_url('assets/js/dark-mode-switch.js'); ?>"></script>
</body>

</html>