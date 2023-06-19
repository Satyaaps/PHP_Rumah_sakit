<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("pembelian_obat");

// Search functionality
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchFilter = [
        '$or' => [
            ['nama_pembeli' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['nama_obat' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['jumlah_obat' => ['$regex' => $searchQuery, '$options' => 'i']],
            ['tanggal_pembelian' => ['$regex' => $searchQuery, '$options' => 'i']],
        ],
    ];
    $pembelian_obat = $collection->find($searchFilter);
} else {
    // Fetch all pembelian obat data from the collection
    $pembelian_obat = $collection->find();
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
            <a href="admindashboard.php" class="list-group-item list-group-item-action list-group-item-light p-3">Dashboard Admin</a>
            <a href="adminlistobat.php" class="list-group-item list-group-item-action list-group-item-light p-3">List Obat</a>
            <a href="adminlistdatapasien.php" class="list-group-item list-group-item-action list-group-item-light p-3">List User</a>
            <a href="adminlistdatamedis.php" class="list-group-item list-group-item-action list-group-item-light p-3">List Medis</a>
            <a href="adminpembelian.php" class="list-group-item list-group-item-action list-group-item-light p-3">List Pembelian Obat</a>
            <a href="report.php" class="list-group-item list-group-item-action list-group-item-light p-3">Report</a>
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <!-- Search form -->
                        <form class="d-flex" action="adminpembelian.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container-fluid">
            <h1 class="mt-4">List Pembelian Obat</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Pembeli</th>                                
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Tanggal Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembelian_obat as $obat) : ?>
                                <tr>
                                    <td><?php echo $obat['nama_pembeli']; ?></td>
                                    <td><?php echo $obat['nama_obat']; ?></td>
                                    <td><?php echo $obat['jumlah_obat']; ?></td>
                                    <td><?php echo $obat['tanggal_pembelian']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
