<?php
include "koneksi.php";

if(isset($_POST['submit'])) {  // Tambahkan name="submit" pada button
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];


    $insert = mysqli_query($koneksi, "INSERT INTO user (nama, username, password) 
                                    VALUES ('$nama','$username','$password')");

    if($insert) {
        echo "<script>alert('Register Berhasil'); location.href='login.php'</script>";
    } else {
        echo "<script>alert('Register Gagal'); window.location='regis.php'</script>";
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
    background: linear-gradient(135deg,rgb(0, 208, 255),rgb(0, 249, 37));
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
    background:rgb(0, 122, 43);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.3s ease;
}

.login-form button:hover {
    background:rgb(0, 67, 252);
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
            <p>Silakan daftar untuk melanjutkan</p>
        </div>
        <form class="login-form" action="regis.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama" required>
            </div>
            <div class="form-group">
                <label for="email">Username</label>
                <input type="username" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <h4>Sudah Mempunyai Akun? <a href="login.php">LogIn</a></h4>
            <button type="submit" name="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
