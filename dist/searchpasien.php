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
        <br>
        <form method="GET" action="">
            <input type="text" name="s" placeholder="Cari Nama" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>">
            <input type="submit" value="Cari">
        </form>
        <br>
        <?php
        include 'dbconnect.php'; // Sertakan file dbconnect.php yang berisi koneksi ke MongoDB
        $collection = $database->selectCollection("user");

        // Tampilkan data default hanya jika tidak ada pencarian
        if (!isset($_GET['s'])) {
            $result = $collection->find();
        } else {
            $search = $_GET['s'];
            $query = ['nama_pasien' => ['$regex' => $search, '$options' => 'i']];
            $result = $collection->find($query);
        }

        echo '<table class="table table-bordered">
                <tr>
                    <th>NO</th>
                    <th>ID PASIEN</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>NAMA PASIEN</th>
                    <th>NO TELP</th>
                    <th>UMUR</th>
                    <th>JENIS KELAMIN</th>
                    <th>PENYAKIT BAWAAN</th>
                    <th>STATUS</th>
                </tr>';

        $no = 1;
        foreach ($result as $data) {
            echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data['idu'] . '</td>
                    <td>' . $data['username'] . '</td>
                    <td>' . $data['password'] . '</td>
                    <td>' . $data['nama_pasien'] . '</td>
                    <td>' . $data['no_telp'] . '</td>
                    <td>' . $data['umur'] . '</td>
                    <td>' . $data['jenis_kelamin'] . '</td>
                    <td>' . $data['penyakit_bawaan'] . '</td>
                    <td>' . $data['status'] . '</td>
                  </tr>';
        }

        echo '</table>';
        ?>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
