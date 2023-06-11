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
                    <h1 class="mt-4">HaiMedic!</h1>
                    <p>HaiMedic adalah sebuah layanan rumah sakit berbasis website yang dirancang untuk memudahkan pasien dalam mengakses perawatan kesehatan. Dengan HaiMedic, pasien dapat dengan mudah membuat janji temu dengan dokter, mengatur janji medis untuk pemeriksaan kesehatan, serta melakukan pembelian obat secara online.</p>
                    <p>Melalui platform HaiMedic, pasien dapat mencari dokter yang sesuai dengan spesialisasi yang mereka butuhkan, melihat jadwal ketersediaan dokter, dan memesan janji temu secara langsung. Ini menghemat waktu dan usaha pasien dalam mencari jadwal yang cocok dan menghindari antrian yang panjang.</p>
                    <p>Selain itu, HaiMedic juga menyediakan fitur pembelian obat secara online. Pasien dapat melihat daftar obat yang tersedia, memilih obat yang dibutuhkan, dan memesan langsung melalui platform. Ini memudahkan pasien untuk mendapatkan obat yang mereka perlukan tanpa harus datang ke apotek fisik.</p>
                    <p>Dengan HaiMedic, pasien dapat mengakses layanan kesehatan secara efisien dan mudah. Dengan fitur-fitur yang ditawarkan, HaiMedic bertujuan untuk memberikan pengalaman yang lebih baik dalam hal membuat janji temu dengan dokter, pemeriksaan kesehatan, dan pembelian obat bagi para pasien.</p>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
    require "koneksi.php";
    $tblmhs = $collection->find();
        if(isset($_POST['simpan']))
        {
        $insertOneResult = $collection->insertOne([
            'npm' => $_POST['NPM'],
            'nama' => $_POST['NAMA'],
            'tempat_lahir' => $_POST['TEMPAT_LAHIR'],
            'tanggal_lahir' => $_POST['TANGGAL_LAHIR'],
            'alamat' => $_POST['ALAMAT'],
            'kodepos' => $_POST['KODE_POS'],
        ]);
        
            echo "<div align='center'><h5> Silahkan Tunggu, Data Sedang Disimpan....</h5></div>";
            echo "<meta http-equiv='refresh' content='1;url=http://localhost/cobaiseng/data_mahasiswa.php'>";
        }
    
?>
