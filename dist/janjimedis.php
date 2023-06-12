<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("janji_medis");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai dari form
    $nik = $_POST['nik'];
    $nama_pasien = $_POST['nama_pasien'];
    $kategori_layanan = $_POST['kategori_layanan'];
    $tanggal = date('m/d/y', strtotime('now'));
    $jadwal = $_POST['jadwal'];
    $riwayat_medis = $_POST['riwayat_medis'];
    $no_telepon = $_POST['no_telepon'];
    $memiliki_asuransi = $_POST['asuransi'];
    $keterangan_tambahan = $_POST['keterangan_tambahan'];

    // Simpan data ke dalam koleksi janji_medis
    $collection->insertOne([
        'nik' => $nik,
        'nama_pasien' => $nama_pasien,
        'kategori_layanan' => $kategori_layanan,
        'tanggal' => $tanggal,
        'jadwal' => $jadwal,
        'riwayat_medis' => $riwayat_medis,
        'no_telepon' => $no_telepon,
        'memiliki_asuransi' => $memiliki_asuransi,
        'keterangan_tambahan' => $keterangan_tambahan
    ]);

    // Redirect ke halaman janjimedis.php
    header('Location: rekapmedis.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HaiMedic Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">HaiMedic</div>
        <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
                    <a href="janjimedis.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Janji Medis</a>
                    <a href="listobat.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Obat</a>                    
                    <a href="pembelian.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Pembelian Obat</a>
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item active"><a href="profile.php" class="nav-link" href="#!">Profile</a></li>
                        <li class="nav-item active"><a href="rekapmedis.php" class="nav-link" href="#!">Rekap Medis</a></li>
                        <li class="nav-item active"><a href="logout.php" class="nav-link" href="#!">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="col-sm-4">
                <h3>Form Janji Medis</h3>
                <form role="form" action="janjimedis.php" method="post">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kategori Layanan Medis</label>
                        <select name="kategori_layanan" class="form-control">
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Orthopedi">Poli Orthopedi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <select id="jadwal" name="jadwal" class="form-control">
                            <option value="" disabled selected>Pilih jadwal</option>
                            <option value="08.00 - 10.00">08.00 - 10.00</option>
                            <option value="10.00 - 12.00">10.00 - 12.00</option>
                            <option value="13.00 - 15.00">13.00 - 15.00</option>
                            <option value="15.00 - 17.00">15.00 - 17.00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Riwayat Medis</label>
                        <input type="text" name="riwayat_medis" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control">
                    </div>
                    <div class="form-group">
                     <label>Memiliki Asuransi</label><br>
                    <select class="form-control" name="asuransi">
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                    </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan Tambahan</label>
                        <textarea name="keterangan_tambahan" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>