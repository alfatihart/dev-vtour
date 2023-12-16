<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= lang('Errors.pageNotFound') ?></title>
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-white">
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center mt-10">
                                <img class="img-fluid p-4" src="/assets/img/illustrations/404-error.svg" alt="" />
                                <p class="lead">This requested URL was not found on this server.<br>
                                    <code style="font-style: italic;">
                                        <?php if (ENVIRONMENT !== 'production') : ?>
                                            <?= nl2br(esc($message)) ?>
                                        <?php else : ?>
                                            <?= lang('Errors.sorryCannotFind') ?>
                                        <?php endif; ?>
                                    </code>
                                </p>
                                <a class="text-arrow-icon" href="/dashboard">
                                    <i class="ms-0 me-1" data-feather="arrow-left"></i>
                                    Return to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutError_footer">
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright &copy; <?= date("Y") ?> Virtual Tour</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
</body>

</html>