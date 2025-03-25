<?php
    include 'koneksi.php';
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
    $username = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
   
    display: flex;
    min-height: 100vh;
}

.sidebar {
    background: #2c3e50;
    color: white;
    width: 250px;
    height: 100vh;
    padding: 20px 0;
}

.brand {
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #34495e;
    margin-bottom: 20px;
}

.brand h2 {
    color: #ecf0f1;
}

.menu {
    list-style: none;
}

.menu-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.menu li {
    padding: 15px 25px;
    transition: all 0.3s;
}

.menu li:hover {
    background: #34495e;
    cursor: pointer;
}

.menu li.active {
    background: #3498db;
}

.menu li a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.menu li i {
    margin-right: 15px;
    width: 20px;
}

.content {
    flex: 1;
    padding: 20px;
    background:rgb(236, 239, 241);
    
}

.header {
    background: white;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header h1 {
    color:rgb(0, 0, 0);
    font-size: 40px;
}



.card {
    width: 200px;
    border-radius: 8px;
    overflow: hidden;
    color: white;
    text-align: center;
    
}

.cards-container {
    display: flex;
    gap: 20px;
    padding: 20px 0;
}

.card-header {
    padding: 15px;
    font-size: 18px;
    
}

.card-footer {
    padding: 10px;
    background: rgba(0, 0, 0, 0.1);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-footer a {
    color: white;
    text-decoration: none;
    font-size: 14px;
}

.blue { background: #007bff; }
        .yellow { background: #ffc107; }
        .green { background: #28a745; }
        .red { background: #dc3545; }

/* Add these responsive styles to your existing CSS */

@media screen and (max-width: 1024px) {
    .cards-container {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .card {
        width: calc(50% - 20px);
        min-width: 200px;
    }
}

@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    
    .content {
        width: 100%;
    }
    
    .header h1 {
        font-size: 30px;
    }
}

@media screen and (max-width: 480px) {
    .card {
        width: 100%;
    }
    
    .cards-container {
        gap: 15px;
    }
    
    .header {
        padding: 15px;
    }
    
    .header h1 {
        font-size: 24px;
    }
    
    .menu li {
        padding: 10px 15px;
    }
    
    .brand {
        padding: 15px;
    }
}

/* Add this for better touch interaction on mobile */
@media (hover: none) {
    .menu li:hover {
        background: none;
    }
    
    .menu li:active {
        background: #34495e;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="header">
                <h1>Dashboard</h1>
                <h4>Selamat Datang di Sistem Kasir</h4>
            </div>
            
            <div class="cards-container">
                <div class="card blue">
                    <div class="card-header"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan")); ?> Total Pelanggan</div>
                    <div class="card-footer">
                        <a href="pelanggan.php">View Details</a>
                        <span>&#8250;</span>
                    </div>
                </div>
                <div class="card yellow">
                    <div class="card-header"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk")); ?> Total Produk</div>
                    <div class="card-footer">
                        <a href="produk.php">View Details</a>
                        <span>&#8250;</span>
                    </div>
                </div>
                <div class="card green">
                    <div class="card-header"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan")); ?> Total Penjualan</div>
                    <div class="card-footer">
                        <a href="penjualan.php">View Details</a>
                        <span>&#8250;</span>
                    </div>
                </div>
                <div class="card red">
                    <div class="card-header"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user")); ?> Total User</div>
                    <div class="card-footer">
                        <a href="user.php">View Details</a>
                        <span>&#8250;</span>
                    </div>
                </div>
                <div class="card blue">
                    <div class="card-header">Pelanggan Paling Sering <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan")); ?></div>
                    <div class="card-footer">
                        <a href="pelanggan_sering.php">View Detail</a>
                        <span>&#8250;</span>
                    </div>
                </div>
                <div class="card blue">
                    <div class="card-header">Pelanggan Belanja Terbanyak <?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelanggan")); ?></div>
                    <div class="card-footer">
                        <a href="pelanggan_terbanyak.php">View Detail</a>
                        <span>&#8250;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
