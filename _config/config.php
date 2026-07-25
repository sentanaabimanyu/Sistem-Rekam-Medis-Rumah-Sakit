<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');

// Memulai Session
// Session digunakan untuk menyimpan data login pengguna
session_start();


// Mengambil file konfigurasi database (conn.php)
// File ini berisi host, username, password, dan database
include_once "conn.php";

// MEMBUAT KONEKSI KE DATABASE
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if(mysqli_connect_errno()) {
    echo mysqli_connect_error();
}

// Digunakan untuk mempermudah pemanggilan alamat website.
function base_url($url =null) {
    // Alamat utama website
    $base_url = "http://localhost/rumahsakit";
    if($url != null) {
        return $base_url."/".$url;
    } else {
        return $base_url;
    }
}


// Fungsi ini biasanya dipakai ketika menampilkan
// tanggal dari database ke halaman web.
function tgl_indo($tgl) {

    // Mengambil tanggal
    $tanggal = substr($tgl, 8, 2);

    // Mengambil bulan
    $bulan = substr($tgl, 5, 2);

    // Mengambil tahun
    $tahun = substr($tgl, 0, 4);

    // Menggabungkan hasil
    return $tanggal."/".$bulan."/".$tahun;
}
?>