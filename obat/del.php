<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";

// Menghapus data obat dari database,ID obat diambil dari parameter URL.
mysqli_query($con, "DELETE FROM tb_obat WHERE id_obat = '$_GET[id]'") or die (mysqli_error($con));
// Setelah data berhasil dihapus,
// pengguna akan diarahkan kembali ke halaman data obat.
echo "<script>window.location='data.php';</script>";
?>