<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";

// Mengambil data checkbox yang dipilih
$chk = $_POST['checked'];
// Mengecek apakah ada data yang dipilih
if(!isset($chk)) {
    // Jika tidak ada data yang dipilih
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='data.php';</script>";
} else {
    // Menghapus seluruh data yang dipilih
    foreach($chk as $id) {
        $sql = mysqli_query($con, "DELETE FROM tb_dokter WHERE id_dokter = '$id'") or die (mysqli_error($con));
    }
    // Mengecek apakah proses hapus berhasil
    if($sql) {
        // Menampilkan jumlah data yang berhasil dihapus
    echo "<script>alert('".count($chk)." data berhasil dihapus'); window.location='data.php';</script>";
   } else {
    echo "<script>alert('gagal hapus data, coba lagi');</script>";
   }  
}
?>