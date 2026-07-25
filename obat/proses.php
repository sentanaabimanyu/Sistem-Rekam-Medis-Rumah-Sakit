<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";
// Memanggil library Composer
require "../_assets/libs/vendor/autoload.php";

// Menggunakan class UUID dari library Ramsey
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;

// proses tambah data
if(isset($_POST['add'])) {
    // Membuat ID unik (UUID) untuk data obat baru
    $uuid = Uuid::uuid4()->toString();
    // Mengambil data dari form
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $ket = trim(mysqli_real_escape_string($con, $_POST['ket']));
    // Menyimpan data obat ke dalam database
    mysqli_query($con, "INSERT INTO tb_obat (id_obat, nama_obat, ket_obat) VALUES ('$uuid', '$nama', '$ket')") or die (mysqli_error($con));
    // Setelah data berhasil disimpan,kembali ke halaman data obat.
    echo "<script>window.location='data.php';</script>";
    // proses edit data obat
} else if(isset($_POST['edit'])) {
    // Mengambil ID obat yang akan diedit
    $id = $_POST['id'];
    // Mengambil data hasil edit dari form
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $ket = trim(mysqli_real_escape_string($con, $_POST['ket']));
    // Memperbarui data obat di database,berdasarkan ID obat
    mysqli_query($con, "UPDATE tb_obat SET nama_obat = '$nama', ket_obat = '$ket' WHERE id_obat = '$id'") or die (mysqli_error($con));
    // Setelah data berhasil diperbarui, kembali ke halaman data obat.
    echo "<script>window.location='data.php';</script>";
}
?>
