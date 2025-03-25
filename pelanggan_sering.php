<?php
include 'koneksi.php';

$query = "
    SELECT pelanggan.id_pelanggan, pelanggan.nama_pelanggan, COUNT(penjualan.id_penjualan) AS total_transaksi
    FROM penjualan
    JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
    GROUP BY pelanggan.id_pelanggan
    ORDER BY total_transaksi DESC
    LIMIT 10
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelanggan Sering Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 50%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <h2>Pelanggan Si Paling Setia</h2>
    <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Jumlah Transaksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td><?= $data['total_transaksi']; ?> kali</td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
