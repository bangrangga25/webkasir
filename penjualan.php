<?php
include 'koneksi.php';
if (!isset($_SESSION['user'])) {
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
        margin-top: 15px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
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
</style>

</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="header">
                <h1>Pembelian</h1>
                <ol>Pembelian</ol>
                <a href="penjualan_tambah.php" class="btn btn-primary">+ Tambah Penjualan</a>
            </div>
            <hr>
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $query = mysqli_query($koneksi, "SELECT*FROM penjualan LEFT JOIN pelanggan on pelanggan.id_pelanggan = penjualan.id_pelanggan");
                while ($data =  mysqli_fetch_array($query)) {
                ?><tr>
                        <td><?php echo $data['tanggal_penjualan']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['total_harga']; ?></td>
                        <td>
                            <a href="penjualan_detail.php?id=<?php echo $data['id_penjualan']; ?>"
                                class="btn btn-secondary">Detail</a>
                            <a href="penjualan_hapus.php?id=<?php echo $data['id_penjualan']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>


        </div>
    </div>
</body>

</html>