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
                <form method="GET" action="">
    Cari Nama <input type="text" name="s">
    <input type="submit" value="cari">
</form>
<?php
    include 'dbconnect.php'; // Sertakan file dbconnect.php yang berisi koneksi ke MongoDB
    $collection = $database->selectCollection("obat");

    // Tampilkan data default hanya jika tidak ada pencarian
    if (!isset($_GET['s'])) {
        $result = $collection->find();

        echo '<form method="GET" action="">
                Cari Nama <input type="text" name="s">
                <input type="submit" value="cari">
            </form>';

        echo '<table class="table table-bordered">
                <tr>
                    <th>NO</th>
                    <th>ID OBAT</th>
                    <th>NAMA OBAT</th>
                    <th>STOK</th>
                    <th>HARGA JUAL</th>
                    <th>HARGA BELI</th>
                    <th>JENIS OBAT</th>
                </tr>';

        $no = 1;

        foreach ($result as $data) {
            echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data['ido'] . '</td>
                    <td>' . $data['nama_obat'] . '</td>
                    <td>' . $data['stok'] . '</td>
                    <td>' . $data['harga_jual'] . '</td>
                    <td>' . $data['harga_beli'] . '</td>
                    <td>' . $data['jenis_obat'] . '</td>
                  </tr>';
        }

        echo '</table>';
    }

    // Cek apakah ada pencarian
    if(isset($_GET['s'])) {
        $search = $_GET['s'];

        $query = ['nama_obat' => ['$regex' => $search, '$options' => 'i']];
        $result = $collection->find($query);

        echo '<h3>Hasil Pencarian untuk: ' . $search . '</h3>';

        echo '<table class="table table-bordered">
                <tr>
                    <th>NO</th>
                    <th>ID OBAT</th>
                    <th>NAMA OBAT</th>
                    <th>STOK</th>
                    <th>HARGA JUAL</th>
                    <th>HARGA BELI</th>
                    <th>JENIS OBAT</th>
                </tr>';

        $no = 1;

        foreach ($result as $data) {
            echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data['ido'] . '</td>
                    <td>' . $data['nama_obat'] . '</td>
                    <td>' . $data['stok'] . '</td>
                    <td>' . $data['harga_jual'] . '</td>
                    <td>' . $data['harga_beli'] . '</td>
                    <td>' . $data['jenis_obat'] . '</td>
                  </tr>';
        }

        echo '</table>';
    }
?>




            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
