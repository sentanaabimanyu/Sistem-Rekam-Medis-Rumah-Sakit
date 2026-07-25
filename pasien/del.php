<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";

// Menghapus data pasien dari database,ID pasien diambil dari parameter URL.
mysqli_query($con, "DELETE FROM tb_pasien WHERE id_pasien = '$_GET[id]'") or die (mysqli_error($con));
// Setelah data berhasil dihapus,pengguna akan diarahkan kembali ke halaman data pasien.
echo "<script>window.location='data.php';</script>";
?>