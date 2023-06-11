<?php
session_start();

include "dbconnect.php";
$collection = $database->selectCollection("user");

if (isset($_GET['idu'])) {
    $objectId = new MongoDB\BSON\ObjectID($_GET['idu']);
    $data = $collection->findOne(['_id' => $objectId]);
}

if (isset($_POST['submit'])) {
    $objectId = new MongoDB\BSON\ObjectID($_GET['idu']);
    $collection->updateOne(
        ['_id' => $objectId],
        ['$set' => [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'nama_pasien' => $_POST['nama_pasien'],
            'no_telp' => $_POST['no_telp'],
            'umur' => $_POST['umur'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'penyakit_bawaan' => $_POST['penyakit_bawaan'],
            'status' => $_POST['status'],
        ]]
    );
    $_SESSION['success'] = "Data Obat berhasil diubah";
    header("Location: adminlistdatapasien.php");
    exit();
}

$tampil = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <meta name="author" content="" />
    <title>HaiMedic Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
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
                <a href="adminlistdatapasien.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List User</a>
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
                    <label for="idu">ID USER</label>
                    <input type="number" name="idu" value="<?php echo $data['idu']; ?>" class="form-control col-md-9" placeholder="Masukkan id obat" disabled>
                </div>

                <div class="form-group">
                    <label for="username">USERNAME</label>
                    <input type="text" name="username" value="<?php echo $data['username']; ?>" class="form-control col-md-9" placeholder="Masukan Username">
                </div>

                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="text" name="password" value="<?php echo $data['password']; ?>" class="form-control col-md-9" placeholder="Masukkan Password">
                </div>

                <div class="form-group">
                    <label for="nama_pasien">NAMA USER</label>
                    <input type="text" name="nama_pasien" value="<?php echo $data['nama_pasien']; ?>" class="form-control col-md-9" placeholder="Masukkan Nama Pasien">
                </div>

                <div class="form-group">
                    <label for="no_telp">NO TELP</label>
                    <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="form-control col-md-9" placeholder="Masukkan No Telp">
                </div>

                <div class="form-group">
                    <label for="umur">UMUR</label>
                    <input type="text" name="umur" value="<?php echo $data['umur']; ?>" class="form-control col-md-9" placeholder="Masukkan Umur">
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">JENIS KELAMIN</label>
                    <select name="jenis_kelamin" class="form-control col-md-9">
                        <option value="Laki-laki" <?php if ($data && $data['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if ($data && $data['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">USER STATUS</label>
                    <select name="status" class="form-control col-md-9">
                        <option value="admin" <?php if ($data && $data['status'] == 'admin') echo 'selected'; ?>>admin</option>
                        <option value="member" <?php if ($data && $data['status'] == 'member') echo 'selected'; ?>>member</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                <a href="adminlistobat.php" class="btn btn-primary">Kembali</a>
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
