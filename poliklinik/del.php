<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";

// Mengambil daftar ID poliklinik yang dipilih dari halaman data.php
$chk = $_POST['checked'];

// Jika tidak ada data yang dipilih,tampilkan pesan peringatan.
if(!isset($chk)) {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='data.php';</script>";

// Menghapus setiap data yang dipilih menggunakan perulangan foreach.
} else {
    foreach($chk as $id) {
        $sql = mysqli_query($con, "DELETE FROM tb_poliklinik WHERE id_poli = '$id'") or die (mysqli_error($con));
    }


 // Jika proses berhasil,tampilkan jumlah data yang dihapus.
    if($sql) {
    echo "<script>alert('".count($chk)." data berhasil dihapus'); window.location='data.php';</script>";
   } else {
    // Jika proses gagal
    echo "<script>alert('gagal hapus data, coba lagi');</script>";
   }  
}
?>