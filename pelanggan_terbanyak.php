<?php
include 'koneksi.php';

$query = "
    SELECT pelanggan.id_pelanggan, pelanggan.nama_pelanggan, SUM(penjualan.total_harga) AS total_belanja
    FROM penjualan
    JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
    GROUP BY pelanggan.id_pelanggan
    ORDER BY total_belanja DESC
    LIMIT 10
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelanggan Paling Banyak Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 50%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <h2>Pelanggan Si Paling Sultan</h2>
    <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Total Belanja</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td>Rp<?= number_format($data['total_belanja'], 0, ',', '.'); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
