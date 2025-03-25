<?php

include "koneksi.php";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($login) > 0) {
        $data = mysqli_fetch_assoc($login);
        $_SESSION['user'] = $data;
        echo "<script>alert('Selamat Datang $data[nama]'); location.href='index.php'</script>";
    } else {
        echo "<script>alert('Username atau Password Salah'); location.href='login.php'</script>";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Login</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background: linear-gradient(135deg, #8fddee, #0400ff);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

h4 {
    font-size: 15px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.login-container {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.login-header h1 {
    color: #333;
    font-size: 28px;
    margin-bottom: 10px;
}

.login-form input {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.login-form button {
    width: 100%;
    padding: 12px;
    background: #021bf8;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.3s ease;
}

.login-form button:hover {
    background:rgb(0, 162, 255);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Axsee.12 Kasir</h1>
            <p>Silakan login untuk melanjutkan</p>
        </div>
        <form class="login-form" action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" name="password" required>
            </div>
            <h4>Belum Mempunyai Akun? <a href="regis.php">Registrasi</a></h4>
            
            <button type="submit" name="login" class="btn btn-login text-white w-100"></a>Login</button>
        </form>
    </div>
</body>
</html>
