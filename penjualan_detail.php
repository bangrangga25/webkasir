<?php
include 'koneksi.php';
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT*FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id_penjualan=$id");
    $data = mysqli_fetch_array($query);
?>
<style>
    /* Container utama */
.container-fluid {
    max-width: 800px;
    margin: 30px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* Judul Halaman */
h1 {
    font-size: 28px;
    color: #2c3e50;
    font-weight: 700;
    text-align: center;
    margin-bottom: 15px;
}

/* Breadcrumb */
.breadcrumb {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
}

/* Tombol Kembali */
.btn-danger {
    display: inline-block;
    padding: 10px 15px;
    font-size: 14px;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    background: #e74c3c;
    border: none;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: #c0392b;
    transform: scale(1.05);
}

/* Tabel */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    background: #ffffff;
}

.table-bordered {
    border: 1px solid #ddd;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background: #3498db;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.table tr:nth-child(even) {
    background: #f9f9f9;
}

/* Efek Hover pada Baris Tabel */
.table tr:hover {
    background: #f0f0f0;
    transition: all 0.3s ease;
}

/* Styling untuk Total Harga */
.table tr:last-child td {
    font-weight: bold;
    background: #ecf0f1;
    font-size: 16px;
    color: #2c3e50;
}

/* Responsif untuk Mobile */
@media screen and (max-width: 768px) {
    .container-fluid {
        padding: 15px;
    }

    h1 {
        font-size: 24px;
    }

    .table th, .table td {
        font-size: 14px;
        padding: 8px;
    }

    .btn-danger {
        padding: 8px 12px;
        font-size: 12px;
    }
}

</style>

<?php include 'sidebar.php'; ?>
<div class="container-fluid">
                        <h1 class="mt-4">Detail Pembelian</h1>
                        
                        
                        <hr>

                        <form method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="200">Nama Pelanggan</td>
                                    <td width="1">:</td>
                                    <td>
                                        <?php echo $data['nama_pelanggan']; ?>
                                    </td>
                                </tr>
                                <?php
                                $pro = mysqli_query($koneksi, "SELECT*FROM detail_penjualan LEFT JOIN produk on produk.id_produk = detail_penjualan.id_produk where id_penjualan=$id");
                                while ($produk = mysqli_fetch_array($pro)) {
                                ?>
                                    <tr>
                                        <td><?php echo $produk['nama_produk']; ?></td>
                                        <td>:</td>
                                        <td>
                                            Harga Satuan : <?php echo $produk['harga']; ?><br>
                                            Jumlah : <?php echo $produk['jumlah_produk']; ?><br>
                                            Sub Total : <?php echo $produk['sub_total']; ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td><?php echo $data['total_harga']; ?></td>
                                </tr>
                                
                            </table>
                            <a href="penjualan.php" class="btn btn-danger">Kembali</a>
                        </form>

</div>