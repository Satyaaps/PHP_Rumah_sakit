<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
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
      font-size: 24px;
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
    <h2>HAI MEDIC</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <div class="btn-container">
        <input type="submit" value="Login">
        <input type="button" value="Register" onclick="location.href='register.php';">
      </div>
    </form>
  </div>
</body>
</html>
