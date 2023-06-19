<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("janji_medis");

// Search functionality
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchFilter = [
        '$or' => [
            ['nik' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['nama_pasien' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['kategori_layanan' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['tanggal' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['jadwal' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['riwayat_medis' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['no_telepon' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['memiliki_asuransi' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['keterangan_tambahan' => ['$regex' => $searchQuery, '$options' => 'i']],
        ],
    ];
    $janji_medis = $collection->find($searchFilter);
} else {
    // Fetch all janji medis data from the collection
    $janji_medis = $collection->find();
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
        <a href="admindashboard.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard Admin</a>
                <a href="adminlistobat.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Obat</a>
                <a href="adminlistdatapasien.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List User</a>
                <a href="adminlistdatamedis.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Medis</a>
                <a href="adminpembelian.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Pembelian Obat</a>
                <a href="report.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Report</a>
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
        <div class="container-fluid">
            <h3>Rekap Medis</h3>
            <form action="" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Pasien</th>
                        <th>Kategori Layanan Medis</th>
                        <th>Tanggal</th>
                        <th>Jadwal</th>
                        <th>Riwayat Medis</th>
                        <th>No Telepon</th>
                        <th>Memiliki Asuransi</th>
                        <th>Keterangan Tambahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($janji_medis as $janji) : ?>
                        <tr>
                            <td><?php echo $janji['nik']; ?></td>
                            <td><?php echo $janji['nama_pasien']; ?></td>
                            <td><?php echo $janji['kategori_layanan']; ?></td>
                            <td><?php echo $janji['tanggal']; ?></td>
                            <td><?php echo $janji['jadwal']; ?></td>
                            <td><?php echo $janji['riwayat_medis']; ?></td>
                            <td><?php echo $janji['no_telepon']; ?></td>
                            <td><?php echo $janji['memiliki_asuransi']; ?></td>
                            <td><?php echo $janji['keterangan_tambahan']; ?></td>
                            <td>
                                <a href="editrekapmedis.php?id=<?php echo $janji['_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="deleterekapmedis.php?id=<?php echo $janji['_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
