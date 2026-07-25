<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// nama tabel yang digunakan/DB table to use
$table = 'tb_pasien';
 
// Primary Key, Digunakan DataTables untuk mengenali setiap data.
$primaryKey = 'id_pasien';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

// Daftar kolom yang akan dikirim ke DataTables.
$columns = array(
    // Kolom Nomor Identitas
    array( 'db' => 'nomor_identitas', 'dt' => 0 ),
    // Kolom Nama Pasien
    array( 'db' => 'nama_pasien',  'dt' => 1 ),
    // Kolom Jenis Kelamin
   
    array( 
        'db' => 'jenis_kelamin',
        'dt' => 2 ,
         // Formatter digunakan untuk mengubah isi data sebelum ditampilkan.
        'formatter' => function ($data, $row) {
            return $data == "L" ? "Laki-laki" : "Perempuan";
        }
    ),
    // Kolom Alamat
    array( 'db' => 'alamat',     'dt' => 3 ),
    // kolom no telepon
    array( 'db' => 'no_telp',     'dt' => 4 ),
     // Kolom ID Pasien 
     // Kolom ini tidak ditampilkan kepada pengguna,tetapi digunakan untuk tombol Edit dan Hapus pada DataTables.
    array( 'db' => 'id_pasien',     'dt' => 5 ),
);
 
// SQL server connection information
// Memanggil konfigurasi koneksi database
include_once "../_config/conn.php";
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
// Memanggil library SSP DataTables
require( '../_assets/libs/DataTables/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);