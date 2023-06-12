<?php
session_start();

require 'dbconnect.php';
$collection = $database->selectCollection("janji_medis");

// Check if ID parameter is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Find the document by ID
    $janji = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    // Check if document exists
    if ($janji) {
        // Check if form is submitted
        if (isset($_POST['submit'])) {
            // Delete the document
            $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

            $_SESSION['success'] = "Data Janji Medis berhasil dihapus";
            header('Location: rekapmedis.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Data Janji Medis tidak ditemukan";
        header('Location: rekapmedis.php');
        exit();
    }
} else {
    $_SESSION['error'] = "ID tidak ditemukan";
    header('Location: rekapmedis.php');
    exit();
}
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
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <!-- ... -->
            <!-- Page content-->
            <div class="container-fluid">
                <h3>Hapus Janji Medis</h3>
                <div class="alert alert-warning" role="alert">
                    Apakah Anda yakin ingin menghapus data Janji Medis ini?
                </div>
                <form method="POST" action="">
                    <button type="submit" name="submit" class="btn btn-danger">Ya, Hapus</button>
                    <a href="rekapmedis.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
