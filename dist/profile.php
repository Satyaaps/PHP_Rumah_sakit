<?php
session_start();

include "dbconnect.php";
$collection = $database->selectCollection("pasien");

// Menghubungkan ke server MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan data pasien dari database berdasarkan NIK
$nik = $_SESSION['nik'];
$patient = $collection->findOne(['nik' => $nik]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HaiMedic Dashboard - Profile</title>
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
            <a href="admin.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
            <a href="adminlistjanjitemu.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Janji Temu</a>
            <a href="adminlistjanjimedis.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Janji Medis</a>
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
            <h3>Profil Pasien</h3>
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>NIK: </strong><?php echo $patient['nik']; ?></p>
                    <p><strong>Nama Pasien: </strong><?php echo $patient['nama_pasien']; ?></p>
                    <p><strong>No Telp: </strong><?php echo $patient['no_telp']; ?></p>
                    <p><strong>Jenis Kelamin: </strong><?php echo $patient['jenis_kelamin']; ?></p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Umur: </strong><?php echo $patient['umur']; ?></p>
                    <p><strong>Alamat: </strong><?php echo $patient['alamat']; ?></p>
                    <p><strong>Penyakit Bawaan: </strong><?php echo $patient['penyakit_bawaan']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
