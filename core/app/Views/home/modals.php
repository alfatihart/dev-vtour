<!-- popup search -->
<div id="popupSearch">
    <div class="search-box">
        <div class="row-search">
            <input type="text" id="input-box" placeholder="Search location.." autocomplete="off">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="result-box">
        </div>
    </div>
    <button class="close-btn rounded-circle position-absolute top-0 start-100 translate-middle" onclick="toggle()" type="button">
        <i class="fa fa-times"></i>
    </button>
</div>
<!-- Modal Media -->
<div class="modal fade" id="exampleModalXl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scenes List</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    <?php foreach ($scenes as $scene) : ?>
                        <div class="col">
                            <a href="<?= base_url('/?scene=' . $scene['slug']); ?>" class="card text-bg-dark shadow">
                                <img src="<?= base_url('/scenes/thumbnail?image=' . $scene['image']); ?>" class="card-img" alt="<?= $scene['slug']; ?>">
                                <div class="card-img-overlay">
                                    <h6 class="card-title text-white text-border"><?= $scene['title']; ?></h6>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
<!-- Modal Maps -->
<div class="modal fade" id="mapsModal" tabindex="-1" aria-labelledby="mapsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Maps pin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
<!-- Modal About -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-10">
        <div class="modal-content">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="info-tab" href="#info" data-bs-toggle="tab" role="tab" aria-controls="info" aria-selected="true">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="location-tab" href="#location" data-bs-toggle="tab" role="tab" aria-controls="location" aria-selected="false">Location</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="credit-tab" href="#credit" data-bs-toggle="tab" role="tab" aria-controls="credit" aria-selected="false">Credit</a>
                        </li>
                    </ul>
                    <button type="button" class="nav-item btn-close align-self-start" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="cardTabContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab" style="max-height: 500px; overflow-y:auto;">
                            <h5 class="card-title">Departemen Matematika Unhas</h5>
                            <p class="card-text">Departemen Matematika didirikan pada 17 Agustus 1963 bersamaan dengan pendirian Fakultas Ilmu Pengetahuan Alam, Universitas Hasanuddin. Selama beberapa tahun pertama, tidak ada siswa yang terdaftar di Program Studi (SP) ini hingga 1974, di mana beberapa siswa diterima di tingkat diploma. <br><br> Sejak tahun 1997 dosen pada Program Studi Matematika mulai dikelompokkan ke dalam Program Studi Matematika dan Program Studi Statistika berdasarkan spesifikasi dan bidang keahlian masing-masing dosen. Kemudian pada tahun 2014 dikelompokkan lagi menjadi tiga program studi, yaitu Program Studi Matematika, Statistika, dan Ilmu Komputer. Namun pada tahun 2019, Departemen Matematika terdiri menjadi Prodi Matematika dan Prodi Ilmu Komputer karena terbentuknya Departemen Statistika.
                                <br><br>
                                <b>Program Studi di bawah Departemen Matematika</b>
                            <ul>
                                <li>Program Studi Matematika</li>
                                <li>Program Studi Magister (S2) Matematika</li>
                                <li>Program Studi Doktor (S3) Matematika</li>
                                <li>Program Studi Sistem Informasi</li>
                                <li>Program Studi Ilmu Aktuaria</li>
                            </ul>
                            Website: <a href="https://sci.unhas.ac.id/d-matematika/">https://sci.unhas.ac.id/d-matematika/</a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                            <h5 class="card-title">Departemen Matematika Unhas</h5>
                            <p class="card-text">Jl. Perintis Kemerdekaan Km.10 Tamalanrea, Makassar, Sulawesi Selatan, Indonesia</p>
                            <div class="map-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248.3637919329691!2d119.48710653886334!3d-5.13256404677625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd59e5a286af%3A0xd355449be7cbd3a5!2sDepartemen%20Matematika!5e0!3m2!1sid!2sid!4v1702634025850!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="credit-tab">
                            <h5 class="card-title text-center fw-bold">Maths Virtual Tour</h5>
                            <p class="card-text">
                            <div class="text-center">
                                360 Panorama Production <br>
                                <b><?= $setting['author']; ?></b><br><br>
                                360 Virtual Tour Production <br>
                                <b><?= $setting['author']; ?></b><br>
                                <img src="<?= base_url('/assets/img/logo-unhas.png'); ?>" class="rounded mt-5" style="max-height: 100px;" alt="Logo Unhas">
                                <br>
                                Departemen Matematika <br>
                                Fakultas Matematika dan Ilmu Pengetahuan Alam <br>
                                Universitas Hasanuddin
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-md-flex justify-content-md-end">
                    <a class="btn btn-light me-3" href="<?= base_url('login'); ?>">Login</a>
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Popup -->
<div id="rotateDevicePopup" style="display:none; position: fixed; z-index: 999998; left: 0px; top: 0px; margin: 0px; padding: 0px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.99);">
    <div style="box-sizing:border-box; padding:0 10vmin; display:table; height:100%; width:100vw;">
        <div style="vertical-align:middle; text-align:center; display:table-cell;">
            <!-- <img style="width: 22vmin; transform: none;" src="/assets/img/rotate-device.png"> -->
            <div style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:3.6vmin; line-height:4.3vmin; margin:5vmin 0; text-align:center;">Please, rotate your device</div>
        </div>
    </div>
</div>