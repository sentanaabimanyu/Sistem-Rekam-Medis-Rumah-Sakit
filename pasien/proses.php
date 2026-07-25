<?php
// Memanggil file konfigurasi
require_once "../_config/config.php";
// Memanggil library Composer
require "../_assets/libs/vendor/autoload.php";

// Menggunakan class UUID
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;
// Menggunakan class PhpSpreadsheet,Digunakan untuk membaca file Excel
use PhpOffice\PhpSpreadsheet\IOFactory;

//proses tambah data pasien
if(isset($_POST['add'])) {
     // Membuat UUID sebagai ID pasien
    $uuid = Uuid::uuid4()->toString();
     // Mengambil data dari form
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    // Mengecek apakah nomor identitas, sudah ada di database
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM tb_pasien WHERE nomor_identitas = '$identitas'") or die (mysqli_error($con));
    // Jika nomor identitas sudah ada
    if(mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nomor identitas sudah pernah diinput!'); window.location='add.php';</script>";
    } else {
        // Menyimpan data pasien baru
        mysqli_query($con, "INSERT INTO tb_pasien (id_pasien, nomor_identitas, nama_pasien, jenis_kelamin, alamat, no_telp ) 
                            VALUES ('$uuid', '$identitas', '$nama', '$jk', '$alamat', '$telp')") or die (mysqli_error($con));
        // Kembali ke halaman data pasien
        echo "<script>window.location='data.php';</script>";
    }
    //proses edit data pasien
} else if(isset($_POST['edit'])) {
    // Mengambil ID pasien
    $id = $_POST['id'];
    // Mengambil data hasil edit
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
      // Mengecek nomor identitas
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM tb_pasien 
                                            WHERE nomor_identitas = '$identitas' 
                                            AND id_pasien != '$id'") or die (mysqli_error($con));
    if(mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nomor identitas sudah pernah diinput!'); window.location='edit.php?id=$id';</script>";
    } else {
        // Memperbarui data pasien
        mysqli_query($con, "UPDATE tb_pasien SET nomor_identitas = '$identitas', 
                            nama_pasien = '$nama', jenis_kelamin = '$jk', alamat = '$alamat', 
                            no_telp = '$telp' WHERE id_pasien = '$id'") or die (mysqli_error($con));
        // Kembali ke halaman data pasien
        echo "<script>window.location='data.php';</script>";
    }
    // proses import data pasien dari excel
} else if(isset($_POST['import'])) {
    // Mengambil nama file yang diupload
    $file = $_FILES['file']['name'];
    // Mengambil ekstensi file
    $ekstensi = explode(".", $file);
    // Membuat nama file baru agar unik
    $file_name = "file-".round(microtime(true)).".".end($ekstensi);
    // Lokasi sementara file
    $sumber = $_FILES['file']['tmp_name'];
    // Folder penyimpanan file upload
    $target_dir = "../_file/";
    // Lokasi file setelah dipindahkan
    $target_file = $target_dir.$file_name;
    // Memindahkan file ke folder tujuan
    $upload = move_uploaded_file($sumber, $target_file);

    // Membaca isi file Excel
    $spreadsheet = IOFactory::load($target_file);
    // Mengubah isi Excel menjadi array
    $all_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    // Menyiapkan query INSERT
    $sql = "INSERT INTO tb_pasien (id_pasien, nomor_identitas, nama_pasien,
        jenis_kelamin, alamat, no_telp) VALUES";

        // Membaca data mulai dari baris ke-3,Baris 1-2 dianggap sebagai judul
    for ($i=3; $i <= count($all_data) ; $i++) {
        // Membuat UUID baru
        $uuid = $uuid = Uuid::uuid4()->toString();
        // Mengambil data dari kolom Excel
        $no_id = $all_data[$i]['A'];
        $nama = $all_data[$i]['B'];
        $jk = $all_data[$i]['C'];
        $alamat = $all_data[$i]['D'];
        $telp = $all_data[$i]['E'];
        // Menambahkan data ke query INSERT
        $sql .= " ('$uuid', '$no_id', '$nama', '$jk', '$alamat', '$telp'),";
    }
    // Menghapus koma terakhir pada query
    $sql = substr($sql, 0, -1);
    echo $sql;
    mysqli_query($con, $sql) or die (mysqli_error($con));
    // Menghapus file Excel setelah selesai diproses
    unlink($target_file);
    // Kembali ke halaman data pasien
    echo "<script>window.location='data.php';</script>";
}
?>