<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("janji_medis");

// Check if ID parameter is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Find the document by ID
    $janji = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    // Check if document exists
    if ($janji) {
        // Check if form is submitted
        if (isset($_POST['submit'])) {
            $nik = $_POST['nik'];
            $nama_pasien = $_POST['nama_pasien'];
            $kategori_layanan = $_POST['kategori_layanan'];
            $tanggal = date('m/d/y', strtotime($_POST['tanggal']));
            $jadwal = $_POST['jadwal'];
            $riwayat_medis = $_POST['riwayat_medis'];
            $no_telepon = $_POST['no_telepon'];
            $memiliki_asuransi = $_POST['asuransi'];
            $keterangan_tambahan = $_POST['keterangan_tambahan'];

            // Update the document
            $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($id)],
                ['$set' => [
                    'nik' => $nik,
                    'nama_pasien' => $nama_pasien,
                    'kategori_layanan' => $kategori_layanan,
                    'tanggal' => $tanggal,
                    'jadwal' => $jadwal,
                    'riwayat_medis' => $riwayat_medis,
                    'no_telepon' => $no_telepon,
                    'memiliki_asuransi' => $memiliki_asuransi,
                    'keterangan_tambahan' => $keterangan_tambahan
                ]]
            );

            $_SESSION['success'] = "Data Janji Medis berhasil diubah";
            header('Location: rekapmedis.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Data Janji Medis tidak ditemukan";
        header('Location: rekapmedis.php');
        exit();
    }
} else {
    $_SESSION['error'] = "ID tidak ditemukan";
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
            <a href="janjitemu.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Janji Temu</a>
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
                <h3>Edit Janji Medis</h3>
                <form method="POST" action="">
                <div class="form-group">
                     <label for="nik">NIK</label>
                     <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $janji['nik']; ?>" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?php echo $janji['nama_pasien']; ?>" required>
                    </div>

                    <div class="form-group">
                         <label for="kategori_layanan">Kategori Layanan Medis</label>
                        <select class="form-control" id="kategori_layanan" name="kategori_layanan" required>
                              <option value="Poli Umum" <?php if ($janji['kategori_layanan'] === 'Poli Umum') echo 'selected'; ?>>Poli Umum</option>
                             <option value="Poli Gigi" <?php if ($janji['kategori_layanan'] === 'Poli Gigi') echo 'selected'; ?>>Poli Gigi</option>
                             <option value="Poli Orthopedi" <?php if ($janji['kategori_layanan'] === 'Poli Orthopedi') echo 'selected'; ?>>Poli Orthopedi</option>
                    </select>
                    </div>


                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $janji['tanggal']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <select class="form-control" id="jadwal" name="jadwal" required>
                            <option value="08.00 - 10.00" <?php if ($janji['jadwal'] === '08.00 - 10.00') echo 'selected'; ?>>08.00 - 10.00</option>
                            <option value="10.00 - 12.00" <?php if ($janji['jadwal'] === '10.00 - 12.00') echo 'selected'; ?>>10.00 - 12.00</option>
                            <option value="13.00 - 15.00" <?php if ($janji['jadwal'] === '13.00 - 15.00') echo 'selected'; ?>>13.00 - 15.00</option>
                            <option value="15.00 - 17.00" <?php if ($janji['jadwal'] === '15.00 - 17.00') echo 'selected'; ?>>15.00 - 17.00</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="riwayat_medis">Riwayat Medis</label>
                        <input type="text" class="form-control" id="riwayat_medis" name="riwayat_medis" value="<?php echo $janji['riwayat_medis']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $janji['no_telepon']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="asuransi">Memiliki Asuransi</label>
                        <select class="form-control" id="asuransi" name="asuransi" required>
                              <option value="Ya" <?php if($janji['memiliki_asuransi'] === 'Ya') echo 'selected'; ?>>Ya</option>
                              <option value="Tidak" <?php if($janji['memiliki_asuransi'] === 'Tidak') echo 'selected'; ?>>Tidak</option>
                        </select>
                        </div>


                    <div class="form-group">
                        <label for="keterangan_tambahan">Keterangan Tambahan</label>
                        <input type="text" class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" value="<?php echo $janji['keterangan_tambahan']; ?>">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="rekapmedis.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
