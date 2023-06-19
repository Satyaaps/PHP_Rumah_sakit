<?php
session_start();

include "dbconnect.php";
$collection = $database->selectCollection("user");

if (isset($_GET['_id'])) {
    $objectId = new MongoDB\BSON\ObjectID($_GET['_id']);
    $data = $collection->findOne(['_id' => $objectId]);
}

if (isset($_POST['submit'])) {
    $objectId = new MongoDB\BSON\ObjectID($_GET['_id']);
    $collection->updateOne(
        ['_id' => $objectId],
        ['$set' => [
            'nama_pasien' => $_POST['nama_pasien'],
            'no_telp' => $_POST['no_telp'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'jenis_jelamin' => $_POST['jenis_kelamin'],
            'penyakit_bawaan' => $_POST['penyakit_bawaan'],
        ]]
    );
    $_SESSION['success'] = "Data User berhasil diubah";
    header("Location: dashboard.php");
    exit();
}
function calculateAge($dateOfBirth) {
    $dobDate = new DateTime($dateOfBirth);
    $today = new DateTime();
    $age = $dobDate->diff($today)->y;
    return $age;
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
            <form action="" method="POST" class="form-item">

            <label for="nama_pasien">Nama User</label>
            <input type="text" id="nama_pasien" name="nama_pasien" value="<?php echo $data['nama_pasien']; ?>" class="form-control col-md-9" placeholder="NAMA PASIEN">


                <div class="form-group">
                    <label for="no_telp">No.Telp</label>
                    <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="form-control col-md-9" placeholder="NO TELP">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>" class="form-control col-md-9" id="tanggal_lahir" onchange="calculateAge()" required>
                </div>
                <div class="form-group">
                    <label for="umur">Umur:</label>
                    <p id="umur"><?php echo calculateAge($data['tanggal_lahir']); ?> tahun</p>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control col-md-9">
                        <option value="Laki-laki" <?php if ($data && $data['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if ($data && $data['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="penyakit_bawaan">Penyakit Bawaan</label>
                    <input type="text" name="penyakit_bawaan" value="<?php echo $data['penyakit_bawaan']; ?>" class="form-control col-md-9" placeholder="TIDAK ADA">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>

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