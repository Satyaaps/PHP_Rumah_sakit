<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <meta name="author" content="" />
  <title>Register</title>
  <link rel="icon" type="image/x-icon" href="assets/medicikon.png" />
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
    
    .register-container {
      width: 400px; 
      padding: 40px; 
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      height: 400px;
      overflow-y: auto;
    }
    
    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
    }
    
    .register-container input[type="text"],
    .register-container input[type="password"],
    .register-container input[type="number"],
    .register-container select {
      width: 100%;
      padding: 12px; 
      margin-bottom: 20px; 
      border: 1px solid #ccc;
      border-radius: 3px;
      font-size: 16px;
      margin-left: -10px;
    }
    
    .register-container .select-container {
      display: flex;
      justify-content: space-between;
    }
    
    .register-container .select-container select {
      width: 48%;
    }
    
    .register-container .btn-container {
      display: flex;
      justify-content: flex-end;
    }
    
    .register-container input[type="submit"] {
      padding: 12px; 
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px; 
    }
    .register-container input[type="date"] {
    display: flex;
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-left: -10px;
    font-size: 16px;

    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" name="username" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <label for="nama_pasien">Nama Pasien:</label>
      <input type="text" name="nama_pasien" required>
      <label for="no_telp">No.Telepon:</label>
      <input type="text" name="no_telp" required>
      <label for="tanggal_lahir">Tanggal Lahir:</label>
      <input type="date" name="tanggal_lahir" required>
      <label for="tanggal_lahir">Pilih Jenis Kelamin:</label>
      <select name="jenis_kelamin" required>
          <option value="" disabled selected>Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
      </select>
      <label for="penyakit_bawaan">Penyakit Bawaan:</label>
      <input type="text" name="penyakit_bawaan" >
      <div class="btn-container">
        <input type="submit" value="Register">
      </div>
    </form>
  </div>
</body>
</html>

<?php
session_start();

include "dbconnect.php";
$collection = $database->selectCollection("user");

// Menghubungkan ke server MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_pasien = $_POST['nama_pasien'];
    $no_telp = $_POST['no_telp'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $penyakit_bawaan = $_POST['penyakit_bawaan'];
    
    // Mengatur status menjadi "member"
    $status = "member";

    // Menyimpan data ke koleksi
    $data = [
 
        'username' => $username,
        'password' => $password,
        'nama_pasien' => $nama_pasien,
        'no_telp' => $no_telp,
        'tanggal_lahir' => $tanggal_lahir,
        'jenis_kelamin' => $jenis_kelamin,
        'penyakit_bawaan' => $penyakit_bawaan,
        'status' => $status // Menambahkan status pengguna
    ];
    $result = $collection->insertOne($data);

    if ($result->getInsertedCount() > 0) {
        echo "Berhasil menyimpan data.";
        // Mengarahkan pengguna ke halaman profile.php setelah berhasil menyimpan data
        header("Location: login.php");
        exit();
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>