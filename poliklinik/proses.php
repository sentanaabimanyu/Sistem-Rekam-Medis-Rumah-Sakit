<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";
// Memanggil library Composer,digunakan untuk mengakses library UUID.
require "../_assets/libs/vendor/autoload.php";

// Menggunakan class UUID
// UUID digunakan sebagai ID unik untuk setiap data poliklinik.
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;

// proses tambah data poliklinik
if(isset($_POST['add'])) {
    // Jumlah data yang akan disimpan
   $total = $_POST['total'];
   // Melakukan perulangan sebanyak jumlah data yang diinputkan pengguna.
    for ($i=1; $i<=$total; $i++) {
        // Membuat UUID baru
        $uuid = Uuid::uuid4()->toString();
        // Mengambil input nama poliklinik
        $nama = trim(mysqli_real_escape_string($con, $_POST['nama-'.$i]));
        // Mengambil input nama gedung
        $gedung = trim(mysqli_real_escape_string($con, $_POST['gedung-'.$i]));
        // Menyimpan data ke tabel tb_poliklinik
        $sql = mysqli_query($con, "INSERT INTO tb_poliklinik (id_poli, nama_poli, gedung) VALUES ('$uuid', '$nama', '$gedung')") or die (mysqli_error($con));
    }
    // Jika seluruh data berhasil disimpan
   if($sql) {
    echo "<script>alert('".$total." data berhasil ditambahkan'); window.location='data.php';</script>";
   } else {
    // Jika gagal menyimpan data
    echo "<script>alert('".$total." gagal tambah data, coba lagi'); window.location='generate.php';</script>";
   }   
   // proses edit data poliklinik
} else if(isset($_POST['edit'])) {
    // Melakukan perulangan terhadap seluruh data yang dipilih untuk diedit.
    for ($i=0; $i<count($_POST['id']); $i++) {
         // Mengambil ID poliklinik
        $id = $_POST['id'][$i];
         // Mengambil nama poliklinik baru
        $nama = $_POST['nama'][$i];
        // Mengambil nama gedung baru
        $gedung = $_POST['gedung'][$i];
        // Memperbarui data poliklinik,berdasarkan ID.
        mysqli_query($con, "UPDATE tb_poliklinik SET nama_poli = '$nama', gedung = '$gedung' WHERE id_poli = '$id'") or die (mysqli_error($con));
    }
    // Menampilkan pesan berhasil lalu kembali ke halaman data.
    echo "<script>alert('Data berhasil di update'); window.location='data.php';</script>";
}
?>