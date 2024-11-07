<?php
$pkr         = strip_tags($_GET['id']);

if (str_contains($pkr, 'JSN')) {
    $url        = "https://noc.jsn.net.id/gateway/api/partner?pkr=" . $pkr;
    $client     = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $partner = json_decode($response, true);
    $urls = "https://jsn.net.id/mitra/" . $partner['hkey'];
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
        <?php if (!empty($partner)) : ?>
            <title>Dokumen Valid | PT. Jaringanku Sarana Nusantara</title>
        <?php else : ?>
            <title>Dokumen Tidak Valid | PT. Jaringanku Sarana Nusantara</title>
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

    <body data-sidebar="dark">
        <div id="layout-wrapper">
            <div>
                <div class="">
                    <?php if (!empty($partner)) : ?>

                        <section class="my-5">
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
                                                <div class="col alert alert-warning alert-dismissible fade show" role="alert">
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
                                                                <td><?= $partner['region']['kota']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Daerah Pelayanan</th>
                                                                <td><?= $partner['kabupaten']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Bergabung Sejak</th>
                                                                <td><?= date('d M Y', strtotime($partner['bergabung'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Status Kepartneran</th>
                                                                <td><?= ($partner['status'] == 'Y' ? " Aktif sampai " . date('d M Y', strtotime($partner['kontrak'] . '+' . $partner['masa_kontrak'] . 'year')) : " Nonaktif"); ?></td>
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
    </body>

    </html>
<?php } ?>