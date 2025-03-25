<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus'); window.location='pelanggan.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus'); window.location='pelanggan.php'</script>";
}

?>
