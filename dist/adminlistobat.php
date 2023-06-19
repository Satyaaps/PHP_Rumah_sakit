<?php
include "dbconnect.php";
$collection = $database->selectCollection("obat");
$no = 1;
$NAMA = "";
if (isset($_GET['search'])) {
    $NAMA = $_GET['search'];
} else {
    $tampil = $collection->find();
}
$searchQuery = [];
if (isset($_GET['search'])) {
    $searchQuery = [
        '$or' => [
            ['nama_obat' => ['$regex' => $_GET['search'], '$options' => 'i']],
            ['stok' => ['$regex' => $_GET['search'], '$options' => 'i']],
            ['harga_jual' => ['$regex' => $_GET['search'], '$options' => 'i']],
            ['harga_beli' => ['$regex' => $_GET['search'], '$options' => 'i']],
            ['jenis_obat' => ['$regex' => $_GET['search'], '$options' => 'i']],
        ],
    ];
}
$itemsPerPage = 5; // Jumlah item per halaman
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini
$offset = ($currentPage - 1) * $itemsPerPage; // Offset hasil query
$totalItems = $collection->countDocuments($searchQuery); // Total jumlah item
$totalPages = ceil($totalItems / $itemsPerPage); // Total halaman
$tampil = $collection->find($searchQuery, ['skip' => $offset, 'limit' => $itemsPerPage]);
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
                            <li class="nav-item active"><a href="profile.php" class="nav-link">Profile</a></li>
                            <li class="nav-item active"><a href="logout.php" class="nav-link">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <div class="col-sm-4">
                    <h3>Tabel Data Obat</h3>
                    <br>
                    <div class="card-body">
                        <a href="tambahdataobat.php" class="btn btn-primary">Tambah Data</a>
                        <br><br>
                        <form method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <th>NO</th>
                                <th>NAMA OBAT</th>
                                <th>STOK</th>
                                <th>HARGA JUAL</th>
                                <th>HARGA BELI</th>
                                <th>JENIS OBAT</th>
                                <th>AKSI</th>
                            </tr>
                            <?php
                            foreach ($tampil as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?> </td>
                                    <td><?php echo $data['nama_obat']; ?></td>
                                    <td><?php echo $data['stok']; ?></td>
                                    <td><?php echo $data['harga_jual']; ?></td>
                                    <td><?php echo $data['harga_beli']; ?></td>
                                    <td><?php echo $data['jenis_obat']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="editdataobat.php?_id=<?php echo $data['_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="hapusdataobat.php?_id=<?php echo $data['_id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            <a href="detaildataobat.php?_id=<?php echo $data['_id']; ?>" class="btn btn-sm btn-danger">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($totalPages > 1) {
                                    if ($currentPage > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?search=' . $NAMA . '&page=' . ($currentPage - 1) . '">Previous</a></li>';
                                    }
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo '<li class="page-item' . ($i == $currentPage ? ' active' : '') . '"><a class="page-link" href="?search=' . $NAMA . '&page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    if ($currentPage < $totalPages) {
                                        echo '<li class="page-item"><a class="page-link" href="?search=' . $NAMA . '&page=' . ($currentPage + 1) . '">Next</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </nav>
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
