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
                <h3>Tabel Data Pasien</h3>  
                <br>
                <div class="card-body">
                    <a href="register.php" class="btn btn-primary">Tambah Data</a>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>No.Telp</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Penyakit Bawaan</th>
                        </tr>
                        <?php
                        include "dbconnect.php";
                        $collection = $database->selectCollection("pasien");
                        $no = 1;
                        $NAMA = "";
                        if (isset($_GET['s'])) {
                            $NAMA = $_GET['s'];
                            // $tampil = mysqli_query($koneksi, "SELECT * FROM tblmhs WHERE NAMA LIKE '%$NAMA'");
                            // $tampil = mysqli_query($koneksi, "SELECT * FROM tblmhs WHERE NAMA LIKE '%$NAMA'");
                        } else {
                            $tampil = $collection->find();
                            foreach ($tampil as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo isset($data['nik']) ? $data['nik'] : ''; ?></td>
                                    <td><?php echo isset($data['nama_pasien']) ? $data['nama_pasien'] : ''; ?></td>
                                    <td><?php echo isset($data['no_telp']) ? $data['no_telp'] : ''; ?></td>
                                    <td><?php echo isset($data['jenis_kelamin']) ? $data['jenis_kelamin'] : ''; ?></td>
                                    <td><?php echo isset($data['umur']) ? $data['umur'] : ''; ?></td>
                                    <td><?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?></td>
                                    <td><?php echo isset($data['penyakit_bawaan']) ? $data['penyakit_bawaan'] : ''; ?></td>
                                    <td>
                                        <a href="editregister.php?ido=<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="hapusdataregister.php?ido=<?php echo isset($data['_id']) ? $data['_id'] : ''; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
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
