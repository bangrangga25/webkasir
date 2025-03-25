<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: #2c3e50;
    color: white;
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 100;
}





.navbar-brand {
    font-size: 24px;
    font-weight: bold;
}

    .container {
        display: flex;
    }

    .sidebar {
        background: #2c3e50;
        color: white;
        width: 250px;
        height: 100vh;
        padding: 20px 0;
        position: fixed;
        left: 0;
        transition: 0.3s ease;
    }

    .sidebar.collapsed {
        left: -250px;
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
        margin-left: 250px;
        flex: 1;
        padding: 20px;
        background: rgb(236, 239, 241);
        min-height: 100vh;
        transition: 0.3s ease;
        margin-top: 60px;
    }

    .content.expanded {
        margin-left: 0;
    }
</style>
<div class="navbar">
    <div class="navbar-brand" onclick="toggleSidebar()" style="cursor: pointer;">
        Kasir Axsee.12
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="brand">
        <h2></h2>
    </div>
    <ul class="menu">
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>
            <a href="index.php">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'pelanggan.php') ? 'class="active"' : ''; ?>>
            <a href="pelanggan.php">
                <i class="fas fa-users"></i>
                Pelanggan
            </a>
        </li>
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'produk.php') ? 'class="active"' : ''; ?>>
            <a href="produk.php">
                <i class="fas fa-box"></i>
                Produk
            </a>
        </li>
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'penjualan.php') ? 'class="active"' : ''; ?>>
            
            <a href="penjualan.php">
                <i class="fas fa-shopping-cart"></i>
                Pembelian
            </a>
        </li>
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'riwayat.php') ? 'class="active"' : ''; ?>>
            <a href="riwayat.php">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Riwayat
            </a>
        </li>
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'user.php') ? 'class="active"' : ''; ?>>
            <a href="user.php">
                <i class="fa-solid fa-user"></i>
                User
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </li>
    </ul>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.querySelector('.content');
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');
}
</script>
