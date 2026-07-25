<?php 
// Memanggil file header
include_once('../_header.php'); ?>

    <div class="box">
        <h1>Pasien</h1>
        <h4>
            <small>Data Pasien</small>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Pasien</a>
                <a href="import.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-import"></i>Import Pasien</a>
            </div>    
        </h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="pasien">
                <thead>
                    <tr>
                        <th>Nomor Identitas</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
        $(document).ready(function() {
            // Mengaktifkan DataTables
            $('#pasien').DataTable( {
                // Menampilkan proses loading
                "processing": true,
                // Menggunakan server-side processing
                "serverSide": true,
                // Mengambil data dari file pasien_data.php
                "ajax": "pasien_data.php",
                // Tinggi area scroll tabel
                scrolly : '250px',
                // Menampilkan tombol export
                dom : 'Bfrtip',
                // Tombol Export
                buttons : [
                    {
                        extend : 'pdf',
                        // Orientasi kertas PDF
                        orientation : 'potrait',
                        // Ukuran kertas
                        pageSize : 'Legal',
                        // Judul laporan
                        title : 'Data Pasien',

                        download : 'open'
                    },
                    'csv', 'excel', 'print', 'copy'
                ],
                 // Pengaturan Kolom
                columnDefs : [
                    {
                        // Kolom aksi tidak dapat dicari
                        "searchable" : false,
                        // Kolom aksi tidak dapat diurutkan
                        "orderable" : false,
                        "targets" : 5,
                        // Membuat tombol Edit dan Hapus,secara otomatis pada setiap baris.
                        "render" : function(data, type, row) {
                            var btn = "<center><a href=\"edit.php?id="+data+"\" class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id="+data+"\" onclick=\"return confirm('Yakin menghapus data?')\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
                            return btn;
                        }
                    }
                ]
            } );
        } );
        </script>
    </div>   

<?php 
// Memanggil file footer
include_once('../_footer.php'); ?>