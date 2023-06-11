<?php
session_start();

include "dbconnect.php";
$collection = $database->selectCollection("pasien");

// Menghubungkan ke server MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];
    $nama_pasien = $_POST['nama_pasien'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $penyakit_bawaan = $_POST['penyakit_bawaan'];

    // Menyimpan data ke koleksi
    $data = [
        'nik' => $nik,
        'nama_pasien' => $nama_pasien,
        'no_telp' => $no_telp,
        'jenis_kelamin' => $jenis_kelamin,
        'umur' => $umur,
        'alamat' => $alamat,
        'penyakit_bawaan' => $penyakit_bawaan
    ];
    $result = $collection->insertOne($data);

    if ($result->getInsertedCount() > 0) {
        // Mengarahkan pengguna ke halaman showregister.php setelah berhasil menyimpan data
        header("Location: showregister.php");
        exit();
    } else {
        echo "Gagal menyimpan data.";
    }
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
            <div class="col-sm-4">
                <h3>Form Registrasi Pasien</h3>
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" name="no_telp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="" disabled selected>Pilih Opsi</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-laki">Laki-laki</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="text" name="umur" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Penyakit Bawaan</label>
                        <input type="text" name="penyakit_bawaan" class="form-control" placeholder="Tidak Ada/ Ada, Hemofilia *contoh*">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info btn-block">Submit</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
