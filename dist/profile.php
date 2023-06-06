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
                                    <li class="nav-item active"><a class="nav-link" href="#!">Profile</a></li>
                                    <li class="nav-item active"><a class="nav-link" href="#!">Rekap Medis</a></li>
                                    <li class="nav-item active"><a class="nav-link" href="#!">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- Page content-->
                        <div class="container-fluid">
                            <div class="col-sm-4">
                                <h3>Profile</h3>
                                <form role="form" action="insert.php" method="post">
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="" name="judul_bk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input type="" name="judul_bk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="terbit_bk" class="form-control">
                                            <option value="" disabled selected>Pilih Opsi</option>
                                            <option value="kategori1">Perempuan</option>
                                            <option value="kategori2">Laki-laki</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Umur</label>
                                        <input type="" name="judul_bk" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="" name="judul_bk" class="form-control">
                                    </div>
                                    <label>Penyakit Bawaan</label>
                                        <input type="" name="judul_bk" class="form-control" placeholder="Tidak Ada/ Ada, Hemofilia contoh>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>					
                                </form>
                            </div>
                            <br>
                </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body><!---->
</html>
