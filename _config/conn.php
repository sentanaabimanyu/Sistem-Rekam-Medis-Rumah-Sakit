

<?php
//Konfigurasi Database
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'rumahsakit',
    'host' => 'localhost'
);

// Variabel ini nantinya dipanggil pada file lain
// menggunakan include atau require.
$con = $sql_details;
?>