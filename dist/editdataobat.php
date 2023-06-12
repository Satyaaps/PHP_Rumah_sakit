<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("janji_medis");

// Ambil semua data janji medis dari koleksi
$janji_medis = $collection->find();

// Fungsi untuk mengubah data janji medis berdasarkan ID
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama_pasien = $_POST['nama_pasien'];
    $kategori_layanan = $_POST['kategori_layanan'];
    $tanggal = date('m/d/y', strtotime($_POST['tanggal']));
    $jadwal = $_POST['jadwal'];
    $riwayat_medis = $_POST['riwayat_medis'];
    $no_telepon = $_POST['no_telepon'];
    $memiliki_asuransi = $_POST['asuransi'];
    $keterangan_tambahan = $_POST['keterangan_tambahan'];

    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($id)],
        ['$set' => [
            'nik' => $nik,
            'nama_pasien' => $nama_pasien,
            'kategori_layanan' => $kategori_layanan,
            'tanggal' => $tanggal,
            'jadwal' => $jadwal,
            'riwayat_medis' => $riwayat_medis,
            'no_telepon' => $no_telepon,
            'memiliki_asuransi' => $memiliki_asuransi,
            'keterangan_tambahan' => $keterangan_tambahan
        ]]
    );

    // Redirect ke halaman rekapmedis.php setelah mengubah data
    header('Location: rekapmedis.php');
    exit();
}

$tampil = $collection->find();
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
            <!-- ... -->
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
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <!-- ... -->
            <!-- Page content-->
            <div class="container-fluid">
                <h3>Rekap Medis</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>Kategori Layanan Medis</th>
                            <th>Tanggal</th>
                            <th>Jadwal</th>
                            <th>Riwayat Medis</th>
                            <th>No Telepon</th>
                            <th>Memiliki Asuransi</th>
                            <th>Keterangan Tambahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($janji_medis as $janji) : ?>
                            <tr>
                                <td><?php echo $janji['nik']; ?></td>
                                <td><?php echo $janji['nama_pasien']; ?></td>
                                <td><?php echo $janji['kategori_layanan']; ?></td>
                                <td><?php echo date('m/d/y', strtotime($janji['tanggal'])); ?></td>
                                <td><?php echo $janji['jadwal']; ?></td>
                                <td><?php echo $janji['riwayat_medis']; ?></td>
                                <td><?php echo $janji['no_telepon']; ?></td>
                                <td><?php echo $janji['memiliki_asuransi']; ?></td>
                                <td><?php echo $janji['keterangan_tambahan']; ?></td>
                                <td>
                                    <!-- Button untuk memunculkan modal edit -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $janji['_id']; ?>">
                                        Edit
                                    </button>

                                    <!-- Modal edit -->
                                    <div class="modal fade" id="editModal<?php echo $janji['_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $janji['_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo $janji['_id']; ?>">Edit Janji Medis</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="rekapmedis.php">
                                                        <input type="hidden" name="id" value="<?php echo $janji['_id']; ?>">
                                                        <div class="form-group">
                                                            <label>NIK</label>
                                                            <input type="text" name="nik" class="form-control" value="<?php echo $janji['nik']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Pasien</label>
                                                            <input type="text" name="nama_pasien" class="form-control" value="<?php echo $janji['nama_pasien']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kategori Layanan Medis</label>
                                                            <select name="kategori_layanan" class="form-control">
                                                                <option value="Poli Umum" <?php echo ($janji['kategori_layanan'] == 'Poli Umum') ? 'selected' : ''; ?>>Poli Umum</option>
                                                                <option value="Poli Gigi" <?php echo ($janji['kategori_layanan'] == 'Poli Gigi') ? 'selected' : ''; ?>>Poli Gigi</option>
                                                                <option value="Poli Orthopedi" <?php echo ($janji['kategori_layanan'] == 'Poli Orthopedi') ? 'selected' : ''; ?>>Poli Orthopedi</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d', strtotime($janji['tanggal'])); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jadwal</label>
                                                            <input type="text" name="jadwal" class="form-control" value="<?php echo $janji['jadwal']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Riwayat Medis</label>
                                                            <textarea name="riwayat_medis" class="form-control"><?php echo $janji['riwayat_medis']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No Telepon</label>
                                                            <input type="text" name="no_telepon" class="form-control" value="<?php echo $janji['no_telepon']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Memiliki Asuransi</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="asuransi" value="Ya" <?php echo ($janji['memiliki_asuransi'] == 'Ya') ? 'checked' : ''; ?>>
                                                                <label class="form-check-label">Ya</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="asuransi" value="Tidak" <?php echo ($janji['memiliki_asuransi'] == 'Tidak') ? 'checked' : ''; ?>>
                                                                <label class="form-check-label">Tidak</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan Tambahan</label>
                                                            <textarea name="keterangan_tambahan" class="form-control"><?php echo $janji['keterangan_tambahan']; ?></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container-fluid">
            <form action="" method="POST" class="form-item">
                <div class="form-group">
                    <label for="ido">ID OBAT</label>
                    <input type="number" name="ido" value="<?php echo $data['ido']; ?>" class="form-control col-md-9" placeholder="Masukkan id obat" disabled>
                </div>

                <div class="form-group">
                    <label for="nama_obat">NAMA OBAT</label>
                    <input type="text" name="nama_obat" value="<?php echo $data['nama_obat']; ?>" class="form-control col-md-9" placeholder="Masukkan nama">
                </div>

                <div class="form-group">
                    <label for="stok">STOK</label>
                    <input type="text" name="stok" value="<?php echo $data['stok']; ?>" class="form-control col-md-9" placeholder="Masukkan stok">
                </div>

                <div class="form-group">
                    <label for="harga_jual">HARGA JUAL</label>
                    <input type="number" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" class="form-control col-md-9" placeholder="Masukkan harga jual">
                </div>

                <div class="form-group">
                    <label for="harga_beli">HARGA BELI</label>
                    <input type="number" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" class="form-control col-md-9" placeholder="Masukkan harga beli">
                </div>

                <div class="form-group">
                    <label for="jenis_obat">JENIS OBAT</label>
                    <select name="jenis_obat" class="form-control col-md-9">
                        <option value="Tablet" <?php if ($data && $data['jenis_obat'] == 'Tablet') echo 'selected'; ?>>Tablet</option>
                        <option value="Kapsul" <?php if ($data && $data['jenis_obat'] == 'Kapsul') echo 'selected'; ?>>Kapsul</option>
                        <option value="Sirup" <?php if ($data && $data['jenis_obat'] == 'Sirup') echo 'selected'; ?>>Sirup</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                <a href="adminlistobat.php" class="btn btn-primary">Kembali</a>
            </form>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <!-- ... -->
</body>
</html>
