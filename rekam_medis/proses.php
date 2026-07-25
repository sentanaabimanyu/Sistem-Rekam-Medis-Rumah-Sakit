<?php
// Mengimpor file konfigurasi database untuk menggunakan koneksi
require_once "../_config/config.php";
// Mengimpor autoload composer untuk memuat library
require "../_assets/libs/vendor/autoload.php";

// Mengimpor namespace Class UUID dari pustaka Ramsey untuk pembuatan ID unik
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;

//Memeriksa apakah tombol/form 'add' telah dikirimkan (diklik) melalui metode POST
if(isset($_POST['add'])) {
    // Generate ID unik
    $uuid = Uuid::uuid4()->toString();
    // Ambil dan amankan input dari form (mencegah SQL Injection & spasi berlebih)
    $pasien = trim(mysqli_real_escape_string($con, $_POST['pasien']));
    $keluhan = trim(mysqli_real_escape_string($con, $_POST['keluhan']));
    $dokter = trim(mysqli_real_escape_string($con, $_POST['dokter']));
    $diagnosa = trim(mysqli_real_escape_string($con, $_POST['diagnosa']));
    $poli = trim(mysqli_real_escape_string($con, $_POST['poli']));
    $tgl = trim(mysqli_real_escape_string($con, $_POST['tgl']));
    // Simpan data utama ke tabel tb_rekammedis
    mysqli_query($con, "INSERT INTO tb_rekammedis (id_rm, id_pasien, keluhan, id_dokter, diagnosa, id_poli, tgl_periksa) VALUES ('$uuid', '$pasien', '$keluhan', '$dokter', '$diagnosa', '$poli', '$tgl')") or die (mysqli_error($con));
    // Simpan multiple data obat ke tabel relasi tb_rm_obat
    $obat = $_POST['obat'];
    foreach ($obat as $ob) {
        mysqli_query($con, "INSERT INTO tb_rm_obat (id_rm, id_obat) VALUES ('$uuid', '$ob')") or die (mysqli_error($con));
    }
    // mengalihkan kembali ke data.php
    echo "<script>window.location='data.php';</script>";
} 
?>