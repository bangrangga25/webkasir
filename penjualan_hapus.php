<?php
include 'koneksi.php';

// Get ID from URL parameter
$id = $_GET['id'];

// Delete from table penjualan
$query = "DELETE FROM penjualan WHERE id_penjualan='$id'";
$delete = mysqli_query($koneksi, $query);

// Delete related items from table detail_penjualan
$query2 = "DELETE FROM detail_penjualan WHERE id_penjualan='$id'";
$delete2 = mysqli_query($koneksi, $query2);

if($delete && $delete2){
    echo "<script>
        alert('Data penjualan berhasil dihapus!');
        window.location.href='penjualan.php';
    </script>";
} else {
    echo "<script>
        alert('Data penjualan gagal dihapus!');
        window.location.href='penjualan.php';
    </script>";
}
?>
