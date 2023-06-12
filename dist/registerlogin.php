<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <input type="text" name="id_user" placeholder="ID User" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="nama_pasien" placeholder="Nama Pasien" required>
      <input type="text" name="no_telp" placeholder="No Telp" required>
      <input type="number" name="umur" placeholder="Umur" required>
      <div class="select-container">
        <select name="jenis_kelamin" required>
          <option value="" disabled selected>Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <select name="status" required>
          <option value="" disabled selected>Pilih Status</option>
          <option value="admin">Admin</option>
          <option value="member">Member</option>
        </select>
      </div>
      <input type="text" name="penyakit_bawaan" placeholder="Penyakit Bawaan">
      <div class="btn-container">
        <input type="submit" value="Register">
      </div>
    </form>
  </div>
</body>
</html>
