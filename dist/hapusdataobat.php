<!DOCTYPE html>
<html>
   <head>
      <title>Hapus data Obat</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Hapus Data Obat</h1></CENTER>

         <?php
            include "dbconnect.php";
            $collection = $database->selectCollection("obat");

            if (isset($_GET['ido'])) {
                $kb = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['ido'])]);
            }
            if(isset($_POST['submit'])){
               
            include 'dbconnect.php';
            $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['ido'])]);
            $_SESSION['success'] = "Data Berhasil dihapus";
            header("Location: adminlistobat.php");
            }

        ?>

         <h3> Yang bernama <?php echo "$kb->nama_obat"; ?> dengan ID <?php echo "$kb->ido"; ?> ? </h3>
         <form method="POST">
            <div class="form-group">
               <input type="hidden" value="<?php echo "$kb->_id"; ?>" class="form-control" name="ido">
               <a href="adminlistobat.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
            </div>
         </form>
      </div>
   </body>
</html>
