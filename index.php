<?php
// Load koneksi database
require_once "_config/config.php";
// Cek status login user
if(isset($_SESSION['user'])) {
    // Jika sudah login, alihkan ke dashboard
    echo "<script>window.location='".base_url('dashboard')."';</script>";
} else {
    // Jika belum login, alihkan ke halaman login
    echo "<script>window.location='".base_url('auth/login.php')."';</script>";
}
?>

