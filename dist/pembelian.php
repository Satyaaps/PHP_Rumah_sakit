<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("pembelian_obat");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai dari form
    $nama_obat = $_POST['nama_obat'];
    $jumlah_obat = $_POST['jumlah_obat'];
    $tanggal_pembelian = date('m/d/y', strtotime('now'));
    $nama_pembeli = $_POST['nama_pembeli'];

    // Simpan data ke dalam koleksi pembelian_obat
    $collection->insertOne([
        'nama_obat' => $nama_obat,
        'jumlah_obat' => $jumlah_obat,
        'tanggal_pembelian' => $tanggal_pembelian,
        'nama_pembeli' => $nama_pembeli,
    ]);

    // Redirect ke halaman rekapmedis.php (atau halaman lain yang diinginkan)
    header('Location: pembelian.php');
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
                        <li class="nav-item active"><a href="logout.php" class="nav-link" href="#!">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container-fluid">
            <div class="col-sm-4">
                <h3>Form Pembelian Obat</h3>
                <form role="form" action="pembelian.php" method="post">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Obat</label>
                        <input type="number" name="jumlah_obat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pembeli</label>
                        <input type="text" name="nama_pembeli" class="form-control">
                    </div>
                    <br>
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
