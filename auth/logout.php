<?php
// Memanggil file konfigurasi utama
require_once "../_config/config.php";

// Menghapus data session pengguna
unset($_SESSION['user']);

// Mengarahkan pengguna kembali ke halaman login
echo "<script>window.location='".base_url('auth/login.php')."';</script>";
?>