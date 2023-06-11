
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
                    <a href="adminlistobat.php" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">List Obat</a>                    
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
            <h3>Tabel Data Obat</h3>  
            <br>
            <form method="GET" action="">
                Cari Nama <input type="text" name="s">
                <input type="submit" value="cari">
            <br>
            <br>
            </form>
                <div class="card-body">
                    <a href="index.php" class="btn btn-primary">Tambah Data</a>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <th>NO</th>
                            <th>ID OBAT</th>
                            <th>NAMA OBAT</th>
                            <th>STOK</th>
                            <th>HARGA JUAL</th>
                            <th>HARGA BELI</th>
                            <th>JENIS OBAT</th>
                        </tr>
                    <?php
                        include "dbconnect.php";
                        $collection = $database->selectCollection("obat");
                        $no = 1;
                        $NAMA = "";
                        if (isset($_GET['s']))
                        {
                            $NAMA = $_GET['s'];
                            // $tampil = mysqli_query($koneksi, "SELECT * FROM tblmhs WHERE NAMA LIKE '%$NAMA'");
                            // $tampil = mysqli_query($koneksi, "SELECT * FROM tblmhs WHERE NAMA LIKE '%$NAMA'");
                        }else
                        // $tampil = mysqli_query($koneksi, "SELECT * FROM tblmhs");
                        $tampil = $collection->find();
                        foreach ($tampil as $data) {
                        ?>
                        <tr>
                            <td><?php echo $no++;?> </td>
                            <td><?php echo $data ['ido']?></td>
                            <td><?php echo $data ['nama_obat']?></td>
                            <td><?php echo $data ['stok']?></td>
                            <td><?php echo $data ['harga_jual']?></td>
                            <td><?php echo $data ['harga_beli']?></td>
                            <td><?php echo $data ['jenis_obat']?></td>
                            <td>
                            <div class="btn-group">
                                <a href="editdataobat.php?ido=<?php echo $data['_id'];?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapusdataobat.php?ido=<?php echo $data['_id'];?>" class="btn btn-sm btn-danger">Hapus</a>
                            </div>

                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
