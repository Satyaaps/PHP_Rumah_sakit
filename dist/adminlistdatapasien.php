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
        <style>
        .scrollable-table-container {
            height: 400px;
            overflow-y: scroll;
        }
    </style>
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
                            <li class="nav-item active"><a href="report.php" class="nav-link" href="#!">Report</a></li>
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
            <h3>Tabel Data User</h3>  
            <br>
            </form>
                <div class="card-body">
                    <a href="searchpasien.php" class="btn btn-primary">Cari Data</a>
                    <a href="register.php" class="btn btn-primary">Tambah Data</a>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>NAMA USER</th>
                            <th>NO TELP</th>
                            <th>UMUR</th>
                            <th>JENIS KELAMIN</th>
                            <th>PENYAKIT BAWAAN</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    <?php
                        include "dbconnect.php";
                        $collection = $database->selectCollection("user");
// Set limit and calculate total pages
$limit = 3;
$totalDocuments = $collection->countDocuments();
$totalPage = ceil($totalDocuments / $limit);

// Get current page or set it to 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset
$offset = ($page - 1) * $limit;

// Retrieve data with appropriate limit and offset
$tampil = $collection->find([], ['limit' => $limit, 'skip' => $offset]);

$no = 1;
foreach ($tampil as $data) {
    $tanggalLahir = new DateTime($data['tanggal_lahir']);
    $sekarang = new DateTime();
    $umur = $sekarang->diff($tanggalLahir)->y;
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data['username'] ?></td>
        <td><?php echo $data['password'] ?></td>
        <td><?php echo $data['nama_pasien'] ?></td>
        <td><?php echo $data['no_telp'] ?></td>
        <td>
            <?php
            echo $tanggalLahir->format('d/m/Y'); // Menampilkan tanggal lahir
            echo "<br>";
            echo $umur . " tahun"; // Menampilkan umur
            ?>
        </td>
        <td><?php echo $data['jenis_kelamin'] ?></td>
        <td><?php echo $data['penyakit_bawaan'] ?></td>
        <td><?php echo $data['status'] ?></td>
        <td>
            <div class="btn-group" role="group">
                <!-- Edit button -->
                <a href="editdatapasien.php?_id=<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" class="btn btn-sm btn-warning">Edit</a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>">Hapus</button>
                </div>
                 <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal-<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapusdatapasien.php?_id=<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </td>
    </tr>
<?php } ?>
</table>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1) : ?>
        <a href="?page=<?php echo ($page - 1); ?>" class="btn btn-primary">Previous Page</a>
    <?php endif; ?>

    <?php
    $startPage = max(1, $page - 2);
    $endPage = min($startPage + 4, $totalPage);

    for ($i = $startPage; $i <= $endPage; $i++) 
        if ($i == $page) 
            echo '<a href="?page=' . $i . '" class="btn btn-primary active">' . $i . '</a>';
    ?>

    <?php if ($page < $totalPage) : ?>
        <a href="?page=<?php echo ($page + 1); ?>" class="btn btn-primary">Next Page</a>
    <?php endif; ?>
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