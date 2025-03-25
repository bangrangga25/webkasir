<?php
include 'koneksi.php';
// session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['user'];

// Query untuk mengambil data riwayat transaksi dengan detail produk
$query = "
    SELECT 
        p.id_penjualan, 
        p.tanggal_penjualan, 
        pelanggan.nama_pelanggan,
        SUM(dp.jumlah_produk * produk.harga) AS total_harga,
        GROUP_CONCAT(produk.nama_produk SEPARATOR ', ') AS daftar_produk,
        GROUP_CONCAT(dp.jumlah_produk SEPARATOR ', ') AS jumlah_produk,
        GROUP_CONCAT(produk.harga SEPARATOR ', ') AS harga_satuan
    FROM penjualan p
    JOIN pelanggan ON p.id_pelanggan = pelanggan.id_pelanggan
    JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
    JOIN produk ON dp.id_produk = produk.id_produk
    GROUP BY p.id_penjualan
    ORDER BY p.tanggal_penjualan DESC
";


$result = mysqli_query($koneksi, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            color: #2c3e50;
        }

        .table tr:hover {
            background-color: #f5f5f5;
            transition: background-color 0.3s ease;
        }

        .table td {
            font-size: 14px;
            color: #444;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }


        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            background: rgb(236, 239, 241);

        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header h1 {

            color: rgb(0, 0, 0);
            font-size: 40px;
        }

        .header ol {
            margin-bottom: 10px;
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

        .blue {
            background: #007bff;
        }

        .yellow {
            background: #ffc107;
        }

        .green {
            background: #28a745;
        }

        .red {
            background: #dc3545;
        }

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
                <h1>Riwayat Penjualan</h1>
                <ol>Riwayat Pembelian User</ol>
            </div>
            <hr>
            <table class="table table-bordered">
                <tr>
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
                </tr>

                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $data['id_penjualan']; ?></td>
    <td><?= date('d-m-Y', strtotime($data['tanggal_penjualan'])); ?></td>
    <td><?= $data['nama_pelanggan']; ?></td>
    <td><?= $data['daftar_produk']; ?></td>
    <td><?= $data['jumlah_produk']; ?></td>
    <td>Rp<?= $data['harga_satuan']; ?></td>
    <td>Rp<?= number_format($data['total_harga'], 0, ',', '.'); ?></td>
    <td>
        <a href="cetak_struk.php?id=<?= $data['id_penjualan']; ?>" class="btn btn-danger">Cetak Struk</a>
    </td>
</tr>
<?php } ?>

            </table>


        </div>
    </div>
</body>

</html>