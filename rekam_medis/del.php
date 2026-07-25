<?php
// Mengimpor file konfigurasi
require_once "../_config/config.php";

// Menjalankan query SQL untuk menghapus data dari tabel 'tb_rekammedis' 
// berdasarkan 'id_rm' yang diambil dari parameter URL
mysqli_query($con, "DELETE FROM tb_rekammedis WHERE id_rm = '$_GET[id]'") or die (mysqli_error($con));
// Mengalihkan (redirect) halaman pengguna kembali ke 'data.php'
echo "<script>window.location='data.php';</script>";
?>