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
                            <div class="col-sm-4">
                                <h3>Form Janji Temu</h3>
                                <form role="form" action="insert.php" method="post">
                                    <div class="form-group">
                                        <label>Nama Pasien</label>
                                        <input type="" name="judul_bk" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Kategori Layanan Medis</label>
                                        <select name="terbit_bk" class="form-control">
                                            <option value="" disabled selected>Pilih kategori</option>
                                            <option value="kategori1">Poli Umum</option>
                                            <option value="kategori2">Poli Gigi</option>
                                            <option value="kategori3">Poli Orthopedi</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="dokter">Dokter</label>
                                        <select id="dokter" name="dokter" class="form-control">
                                            <option value="" disabled selected>Pilih dokter</option>
                                            <option value="dr. John Doe">dr. John Doe</option>
                                            <option value="dr. Jane Smith">dr. Jane Smith</option>
                                            <option value="dr. Michael Lee">dr. Michael Lee</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <select id="jadwal" name="jadwal" class="form-control">
                                            <option value="" disabled selected>Pilih jadwal</option>
                                            <option value="08.00 - 10.00">08.00 - 10.00</option>
                                            <option value="10.00 - 12.00">10.00 - 12.00</option>
                                            <option value="13.00 - 15.00">13.00 - 15.00</option>
                                            <option value="15.00 - 17.00">15.00 - 17.00</option>
                                        </select>
                                        </div>
                                    <br>
                                    
                                    <div class="form-group">
                                        <label>Riwayat Medis</label>
                                        <input type="text" name="harga_bk" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>No Telfon</label>
                                        <input type="text" name="harga_bk" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="asuransi">Memiliki Asuransi?</label>
                                        <select id="asuransi" name="asuransi" class="form-control">
                                            <option value="" disabled selected>Pilih opsi</option>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Keterangan Tambahan</label>
                                        <input type="text" name="harga_bk" class="form-control">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="metodePembayaran">Metode Pembayaran</label>
                                        <select id="metodePembayaran" name="metodePembayaran" class="form-control">
                                            <option value="" disabled selected>Pilih metode pembayaran</option>
                                            <option value="cash">Tunai</option>
                                            <option value="transfer">Transfer Bank</option>
                                            <option value="kartuKredit">Kartu Kredit</option>
                                            <option value="eWallet">Dompet Digital</option>
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>					
                                </form>
                            </div>
                            <br>
                            <div class="col-sm-8">
                                <h3>Jadwal Temu Tersedia</h3>
                            </div>
                </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
