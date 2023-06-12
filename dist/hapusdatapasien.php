<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HaiMedic</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f1f1f1;
    }
    
    .login-container {
      width: 400px; 
      padding: 40px; 
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 30px;
    }
    
    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px; 
      margin-bottom: 20px; 
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 16px;
      margin-left: -10px;
    }
    
    .login-container .btn-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .login-container input[type="submit"],
    .login-container input[type="button"] {
      width: 48%;
      padding: 12px; 
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px; 
    }
  </style>
   </head>

   <body>
      <div class="login-container">
         <br>
         <h2><strong>Hapus Data Pasien?</strong></h2>

         <?php
            include "dbconnect.php";
            $collection = $database->selectCollection("user");

            if (isset($_GET['idu'])) {
                $kb = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['idu'])]);
            }
            if(isset($_POST['submit'])){
               
            include 'dbconnect.php';
            $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['idu'])]);
            $_SESSION['success'] = "Data Berhasil dihapus";
            header("Location: adminlistdatapasien.php");
            }

        ?>
         <h3> Nama&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo "$kb->nama_pasien"; ?> <br> ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo "$kb->idu"; ?></h3>
         <br>
         <form method="POST">
            <div class="form-group">
               <input type="hidden" value="<?php echo "$kb->_id"; ?>" class="form-control" name="idu">
               <a href="adminlistdatapasien.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
            </div>
         </form>
      </div>
   </body>
</html>