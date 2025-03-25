<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID transaksi tidak ditemukan!";
    exit;
}

$id_penjualan = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$query = "
    SELECT 
        p.id_penjualan, 
        p.tanggal_penjualan, 
        p.total_harga, 
        pelanggan.nama_pelanggan,
        dp.jumlah_produk, 
        produk.nama_produk, 
        produk.harga 
    FROM penjualan p
    JOIN pelanggan ON p.id_pelanggan = pelanggan.id_pelanggan
    JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
    JOIN produk ON dp.id_produk = produk.id_produk
    WHERE p.id_penjualan = '$id_penjualan'
";

$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}

// Ambil satu data untuk header struk
$firstRow = mysqli_fetch_assoc($result);

// Reset hasil query agar bisa digunakan kembali
mysqli_data_seek($result, 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 20px;
            background: #f8f9fa;
        }
        .struk {
            width: 320px;
            margin: auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            background: white;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            color: #007bff;
            margin-bottom: 10px;
        }
        .store-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        p {
            margin: 5px 0;
            font-size: 14px;
            color: #444;
        }
        hr {
            border: none;
            border-top: 2px dashed #ddd;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px dashed #ddd;
            font-size: 14px;
        }
        table th {
            text-align: center;
            font-weight: bold;
            color: #333;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }
        .btn-print {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            width: 100%;
        }
        .btn-print:hover {
            background: #0056b3;
        }
        @media print {
            .btn-print {
                display: none;
            }
            body {
                background: white;
            }
        }
       



    </style>
</head>
<body>

<div class="struk">
    <div class="logo">Axsee.12</div>
    <div class="store-info">
        Jl. Kyai Mojo Katrungan-Krian, Bakalan, Katrungan, Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61262<br>
        Telp: (031) 8971207
    </div>
    <hr>
    <h2>Struk Pembelian</h2>
    <p><strong>No. Transaksi:</strong> <?= $firstRow['id_penjualan']; ?></p>
    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($firstRow['tanggal_penjualan'])); ?></p>
    <p><strong>Nama Pelanggan:</strong> <?= $firstRow['nama_pelanggan']; ?></p>
    <hr>

    <table>
    <tr>
        <th>Produk</th>
        <th>Jml</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    <?php 
    $total_harga = 0; // Reset total harga sebelum looping
    while ($data = mysqli_fetch_assoc($result)) { 
        $subtotal = $data['jumlah_produk'] * $data['harga'];
        $total_harga += $subtotal; // Tambahkan subtotal ke total harga
    ?>
    <tr>
        <td><?= $data['nama_produk']; ?></td>
        <td><?= $data['jumlah_produk']; ?></td>
        <td>Rp<?= number_format($data['harga'], 0, ',', '.'); ?></td>
        <td>Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
    </tr>
    <?php } ?>
</table>

<hr>
<p class="total">Total: Rp<?= number_format($total_harga, 0, ',', '.'); ?></p>
<hr>
<p class="footer">Terima kasih telah berbelanja!<br>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
<button class="btn-print" target="_blank" onclick="window.print()">Cetak Struk</button>

</div>

</body>
</html>
