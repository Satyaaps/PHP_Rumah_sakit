<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>HaiMedic Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">HaiMedic</div>
            <div class="list-group list-group-flush">
            <a href="admindashboard.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard Admin</a>
                <a href="adminlistobat.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Obat</a>
                <a href="adminlistdatapasien.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Pasien</a>
                <a href="adminlistdatamedis.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Medis</a>
                <a href="adminpembelian.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Pembelian Obat</a>
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
                <form action="" method="POST" class="form-item">
                    <div class="form-group">
                        <label for="ido"> ID OBAT </label>
                        <input type="text" name="ido" class="form-control col-md-9" placeholder="Masukkan id obat">
                    </div>

                    <div class="form-group">
                        <label for="nama_obat"> NAMA OBAT </label>
                        <input type="text" name="nama_obat" class="form-control col-md-9" placeholder="Masukkan nama obat">
                    </div>

                    <div class="form-group">
                        <label for="stok"> STOK </label>
                        <input type="number" name="stok" class="form-control col-md-9" placeholder="Masukkan jumlah stok">
                    </div>

                    <div class="form-group">
                        <label for="harga_jual"> HARGA JUAL </label>
                        <input type="number" name="harga_jual" class="form-control col-md-9" placeholder="Masukkan harga jual">
                    </div>

                    <div class="form-group">
                        <label for="harga_beli"> HARGA BELI </label>
                        <input type="number" name="harga_beli" class="form-control col-md-9" placeholder="Masukkan harga beli">
                    </div>

                    <div class="form-group">
                        <label for="jenis_obat">JENIS OBAT</label>
                        <select name="jenis_obat" class="form-control col-md-9">
                            <option value="Tablet" <?php if (isset($data['jenis_obat']) && $data['jenis_obat'] == 'Tablet') echo 'selected'; ?>>Tablet</option>
                            <option value="Kapsul" <?php if (isset($data['jenis_obat']) && $data['jenis_obat'] == 'Kapsul') echo 'selected'; ?>>Kapsul</option>
                            <option value="Sirup" <?php if (isset($data['jenis_obat']) && $data['jenis_obat'] == 'Sirup') echo 'selected'; ?>>Sirup</option>
                        </select>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary" name="simpan">SIMPAN</button>
                    <button type="reset" class="btn btn-danger">BATAL</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
require "dbconnect.php";
$collection = $database->selectCollection("obat");
$tblmhs = $collection->find();
if (isset($_POST['simpan'])) {
    $insertOneResult = $collection->insertOne([
        'ido' => $_POST['ido'],
        'nama_obat' => $_POST['nama_obat'],
        'stok' => $_POST['stok'],
        'harga_jual' => $_POST['harga_jual'],
        'harga_beli' => $_POST['harga_beli'],
        'jenis_obat' => $_POST['jenis_obat'],
    ]);

    echo "<div align='center'><h5> Silahkan Tunggu, Data Sedang Disimpan....</h5></div>";
    echo "<meta http-equiv='refresh' content='1;url=http://localhost/apaja/dist/adminlistobat.php'>";
}
?>
