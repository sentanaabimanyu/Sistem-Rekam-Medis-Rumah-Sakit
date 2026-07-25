<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";
// Memanggil library Composer
require "../_assets/libs/vendor/autoload.php";

// Menggunakan class UUID dari library Ramsey
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;

//proses tambah data dokter
if(isset($_POST['add'])) {
    // Membuat ID unik (UUID) untuk dokter baru
    $uuid = Uuid::uuid4()->toString();
    // Mengambil data dari form
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    // Menyimpan data dokter ke database
    mysqli_query($con, "INSERT INTO tb_dokter (id_dokter, nama_dokter, spesialis, alamat, no_telp ) 
                        VALUES ('$uuid', '$nama', '$spesialis', '$alamat', '$telp')") or die (mysqli_error($con));
    echo "<script>window.location='data.php';</script>";
    // proses edit data dokter
} else if(isset($_POST['edit'])) {
    // Mengambil ID dokter yang akan diedit
    $id = $_POST['id'];
    // Mengambil data hasil edit dari form
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    // Memperbarui data dokter di database,berdasarkan ID dokter
    mysqli_query($con, "UPDATE tb_dokter SET nama_dokter = '$nama', 
                        spesialis = '$spesialis', alamat = '$alamat', 
                        no_telp = '$telp' WHERE id_dokter = '$id'") or die (mysqli_error($con));
    // setelah berhasil,kembali ke halaman data dokter
    echo "<script>window.location='data.php';</script>";
}
?>