<?php

$pkr = $_POST['pkr'] ?? strip_tags($_GET['id']);

if (str_contains($pkr, 'JSN')) {
    $url        = "https://noc.jsn.net.id/gateway/api/partner?pkr=" . $pkr;
    $client     = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $partner = json_decode($response, true);

    // var_dump(null != $partner);

    $base_urls = "https://jsn.net.id/mitra/";
    $key = null != $partner ? $partner['hkey'] : "";
    $urls = $base_urls . $key;

?>
    <script>
        setTimeout(function() {
            window.location.href = '<?php echo $urls; ?>';
        }, 500);
    </script>
<?php
} else {
    $url        = "https://noc.jsn.net.id/gateway/api/partner?hkey=" . $pkr;
    $client     = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $partner = json_decode($response, true);

?>



    <!doctype html>
    <html lang="en">

    <head>

        <meta charset="utf-8">

        <?php if ($pkr) : ?>

            <?php if (!empty($partner)) : ?>
                <title>Dokumen Valid | PT. Jaringanku Sarana Nusantara</title>
            <?php else : ?>
                <title>Dokumen Tidak Valid | PT. Jaringanku Sarana Nusantara</title>
            <?php endif; ?>

        <?php else : ?>
            <title>Halaman Validity Checker Mitra JSN</title>
        <?php endif; ?>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Perjanjian Kerjasama PT. jaringanku Sarana Nusantara" name="description">
        <meta content="Jorel" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="https://noc.jsn.net.id/gateway/images/favicon.ico">
        <!-- Bootstrap Css -->
        <link href="https://jsn.net.id/mitra/libs/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="https://jsn.net.id/mitra/libs/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="https://jsn.net.id/mitra/libs/app.min.css" id="app-style" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <style>
        .stamp {
            position: absolute;
            display: block;
            width: 100%;
            z-index: 1;
            opacity: .1;
            font-size: 100px;
            font-weight: bold;
            text-align: center;
            line-height: normal;
            /* border: 2px solid #000; */
            /* color: green; */
            padding: 0 30px;
            /* transform: rotate(-25deg); */
            /* left: 40vw; */
            top: 20vh;
            margin: 15px auto;
        }

        .stamp span {
            border: 2px solid #000;
            padding: 0 10px;
            border-radius: 10px;
            transform: rotate(-20deg);
        }

        span.aktif {
            color: green;
            border-color: green;
        }

        span.nonaktif {
            color: red;
            border-color: red;
        }

        @media only screen and (max-width: 690px) {
            .stamp span {
                font-size: 60px;
            }
        }

        .preloader {
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            display: none;
            height: 100vh;
            width: 100%;
            background-color: #fff;
        }

        .preloader.show {
            display: block;
        }

        @keyframes loader {

            0%,
            10%,
            100% {
                width: 80px;
                height: 80px;
            }

            65% {
                width: 150px;
                height: 150px;
            }
        }

        @keyframes loaderBlock {

            0%,
            30% {
                transform: rotate(0);
            }

            55% {
                background-color: #F37272;
            }

            100% {
                transform: rotate(90deg);

            }
        }

        @keyframes loaderBlockInverse {

            0%,
            20% {
                transform: rotate(0);
            }

            55% {
                background-color: #F37272;
            }

            100% {
                transform: rotate(-90deg);
            }
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
            transform: translate(-50%, -50%) rotate(45deg) translate3d(0, 0, 0);
            animation: loader 1.2s infinite ease-in-out;

            span {
                position: absolute;
                display: block;
                width: 40px;
                height: 40px;
                background-color: #EE4040;
                animation: loaderBlock 1.2s infinite ease-in-out both;

                &:nth-child(1) {
                    top: 0;
                    left: 0;
                }

                &:nth-child(2) {
                    top: 0;
                    right: 0;
                    animation: loaderBlockInverse 1.2s infinite ease-in-out both;
                }

                &:nth-child(3) {
                    bottom: 0;
                    left: 0;
                    animation: loaderBlockInverse 1.2s infinite ease-in-out both;
                }

                &:nth-child(4) {
                    bottom: 0;
                    right: 0;
                }
            }
        }
    </style>

    <body data-sidebar="dark">


        <div class="preloader">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="layout-wrapper">
            <div>
                <div class="">
                    <?php if ($pkr) : ?>
                        <?php if (!empty($partner)) : ?>

                            <section class="my-5">

                                <div class="stamp">
                                    <span class="<?= $partner['status'] == 'Y' ? 'aktif' : 'nonaktif' ?>">
                                        <?= $partner['status'] == 'Y' ? "VALID AKTIF" : 'NON AKTIF' ?>
                                    </span>
                                </div>

                                <div class="">
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <div class="home-wrapper mt-5">
                                                <?php if ($partner['status'] == 'Y') : ?>
                                                    <div class="col alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Valid!</strong> Dokumen ini valid dan terdaftar di dalam database <strong>PT. Jaringanku Sarana Nusantara!</strong>.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>Peringatan!</strong> Dokumen ini terdaftar di dalam database tapi status kemitraan <strong>Tidak Aktif</strong>.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php endif; ?>


                                                <div class="card mb-3">
                                                    <!-- <img src="https://www.jsn.net.id/mitra/img/valid.png" class="card-img-top" alt="valid"> -->
                                                    <div class="card-body">

                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="col">Nama Usaha</th>
                                                                    <td><?= $partner['nama_usaha']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">No. PKR</th>
                                                                    <td><?= $partner['pkr']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">Nama Pemilik</th>
                                                                    <td><?= $partner['nama_mitra']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">NIB</th>
                                                                    <td><?= $partner['nib']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Cabang Induk</th>
                                                                    <td>JSN <?= $partner['region']['kota']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Daerah Pelayanan</th>
                                                                    <td><?= $partner['cities']['name']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Bergabung Sejak</th>
                                                                    <td><?= date('d M Y', strtotime($partner['bergabung'])); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Status Kemitraan</th>
                                                                    <td>
                                                                        <?= ($partner['status'] == 'Y' ? " Aktif sampai " . date('d M Y', strtotime($partner['kontrak'] . '+' . $partner['masa_kontrak'] . 'year')) : "<span class='alert alert-danger'>Nonaktif</span>"); ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php else : ?>
                            <section class="my-5">
                                <div class="">
                                    <div class="row justify-content-center">
                                        <div class="col-10 text-center">
                                            <div class="home-wrapper mt-5">
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>Peringatan!</strong> Dokumen <strong>Tidak ditemukan di database <strong>PT. Jaringanku Sarana Nusantara</strong></strong>.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>

                                                <div class="maintenance-img">
                                                    <img src="https://www.jsn.net.id/mitra/img/alert.png" width="30%" alt="" class="img-fluid mx-auto d-block">
                                                </div>
                                                <h3 class="mt-4">Dokumen Tidak Valid</h3>
                                                <p>Dokumen ini Tidak ditemukan atau tidak lagi terdaftar di <b>PT. Jaringanku Sarana Nusantara</b></p>

                                                <p>Apa yang perlu dilakukan?</p>

                                                <div class="row">
                                                    <div class="text-center col-md-4">
                                                        <div class="card mt-4 maintenance-box">
                                                            <div class="card-body">
                                                                <i class="mdi mdi-file-document-multiple h2"></i>
                                                                <h6 class="text-uppercase mt-3">Dokumen Tidak Resmi?</h6>
                                                                <p class="text-muted mt-3"><b>Dokumen</b> ini tidak membuktikan Perjanjian Kerjasama (PKR) antara partner dengan <b>PT. Jaringanku Sarana Nusantara</b>.<br>
                                                                    Kami tidak bertanggung jawab atas segala aktifitas atau ke-legalitas-an usaha yang dijalankan.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center col-md-4">
                                                        <div class="card mt-4 maintenance-box">
                                                            <div class="card-body">
                                                                <i class="mdi mdi-image-broken-variant h2"></i>
                                                                <h6 class="text-uppercase mt-3">
                                                                    Dokumen rusak?</h6>
                                                                <p class="text-muted mt-3">Pemegang dokumen kerjasama resmi terdaftar di database <b>PT. Jaringanku Sarana Nusantara</b> jika terjadi kerusakan pada dokumen segera hubungi kami untuk melakukan pembaruan sesuai <b>Syarat & Ketentuan </b>yang berlaku.<br>
                                                                    <a href="mailto:support@jsn.net.id" class="text-decoration-underline">support@jsn.net.id</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center col-md-4">
                                                        <div class="card mt-4 maintenance-box">
                                                            <div class="card-body">
                                                                <i class="mdi mdi-handcuffs h2"></i>
                                                                <h6 class="text-uppercase mt-3">
                                                                    Penyalahgunaan/Pemalsuan</h6>
                                                                <p class="text-muted mt-3">Pemalsuan dan penyalahygunaan Dokumen Kerjasama dengan tujuan apapun dan berakibat merugikan <b>PT. Jaringanku Sarana Nusantara</b> akan ditindaklanjuti sesuai proses Hukum yang berlaku. <br>
                                                                    <a href="mailto:support@jsn.net.id" class="text-decoration-underline">Laporkan penyalahgunaan</a></b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>

                    <?php else : ?> <!-- Jika tidak ada PKR -->

                        <section class="my-5">
                            <div class="">
                                <div class="row justify-content-center">
                                    <div class="col-10 text-center">
                                        <div class="mt-5">
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>Semua mitra</strong> yang bekerjasama dengan JSN memiliki ijin resmi dalam menjalankan usahanya.
                                                Tanpa ijin resmi yang dikeluarkan dan ditandatangani, JSN tidak ada Hubungan dan Tanggung jawab apapun dalam hal legalitas dan Hukum..
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>

                                            <div class="maintenance-img">
                                                <img src="/mitra/img/validation.png" width="30%" alt="" class="img-fluid mx-auto d-block">
                                            </div>


                                            <h3 class="mt-4">Cek Validitas Perjanjian Kerjasama (PKR) JSN</h3>
                                            <p>Masukan Nomor/Serial Perjanjian Kerjasama (PKR) pada dokumen resmi yang dikeluarkan oleh JSN.</p>

                                            <form method="post">
                                                <div class="row m-5 justify-content-center">
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input name="pkr" type="text" class="form-control form-control-lg" placeholder="Masukan Nomor PKR" required>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row mt-3">
                                                    <!-- <div class="col-sm-2"> -->
                                                    <div class="button-items">
                                                        <button type="submit" class="btn-lg btn-primary waves-effect waves-light">Cek Now</button>
                                                        <button type="button" class="btn-lg btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                                            <i class="mdi mdi mdi-qrcode-scan"></i>
                                                        </button>
                                                    </div>
                                                    <!-- </div> -->
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    <?php endif; ?>

                </div>
                <footer class="footer" style="left:0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script> PT. Jaringanku Sarana Nusantara <span class="d-none d-sm-inline-block"> - Allrights reserved.</span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://jsn.net.id/mitra/libs/jquery.min.js"></script>
        <script src="https://jsn.net.id/mitra/libs/bootstrap.bundle.min.js"></script>



        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Scan QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="reader"></div>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js"></script>
        <script>
            // When scan is successful fucntion will produce data
            function onScanSuccess(qrCodeMessage) {
                document.querySelector('.preloader').classList.add('show');
                setTimeout(function() {
                    // document.querySelector('.preloader').classList.remove('show');
                    window.location.href = qrCodeMessage;
                }, 500);
            }

            // When scan is unsuccessful fucntion will produce error message
            function onScanError(errorMessage) {
                // Handle Scan Error
            }

            // Setting up Qr Scanner properties
            var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
                fps: 10,
                qrbox: 250
            });

            // in
            html5QrCodeScanner.render(onScanSuccess, onScanError);
        </script>

    </body>

    </html>
<?php } ?>