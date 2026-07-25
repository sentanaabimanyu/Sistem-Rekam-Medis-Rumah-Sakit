<?php 
// Memanggil file header
include_once('../_header.php'); ?>

    <div class="box">
        <h1>Poliklinik</h1>
        <h4>
            <small>Data Poliklinik</small>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="generate.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Poli</a>
            </div>    
        </h4>
        <form method="post" name="proses">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Poli</th>
                        <th>Gedung</th>
                        <th>
                            <center>
                                <input type="checkbox" id="select_all" value="">
                            </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Nomor urut data
                $no =1;
                // Mengambil seluruh data poliklinik dari database.
                $sql_poli = mysqli_query($con, "SELECT * FROM tb_poliklinik ORDER BY nama_poli ASC") or die (mysqli_error($con));
                  // Jika data ditemukan, tampilkan seluruh data.
                if(mysqli_num_rows($sql_poli) > 0) { 
                    while($data = mysqli_fetch_array($sql_poli)) { ?>
                        <tr>
                           <td><?=$no++?>.</td>
                           <td><?=$data['nama_poli']?></td>
                           <td><?=$data['gedung']?></td>
                           <td align="center">
                             <input type="checkbox" name="checked[]" class="check" value="<?=$data['id_poli']?>">
                           </td>
                        </tr>
                    <?php
                    }
                } else {
                    // Jika tidak ada data
                    echo "<tr><td colspan=\"4\" align=\"center\">Data tidak ditemukan</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        </form>

        <div class="box pull-right">
            <button class="btn btn-warning btn-sm" onclick="edit()"><i class="glyphicon glyphicon-edit"></i>Edit</button>
            <button class="btn btn-warning btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i>Hapus</button>
        </div>
    </div>
    <script>
    $(document).ready(function() {
         // Checkbox "Pilih Semua" Jika dicentang maka seluruh checkboxpada tabel akan ikut dicentang.
        $('#select_all').on('click', function() {
            if(this.checked) {
                $('.check').each(function() {
                    this.checked = true;
                })
            } else {
                $('.check').each(function() {
                    this.checked = false;
                })
            }
        });
        // Mengecek apakah semua checkbox sudah dipilih atau belum
        $('.check').on('click', function() {
            if($('.check:checked').length == $('.check').length) {
                $('#select_all').prop('checked', true)
            } else {
                $('#select_all').prop('checked', false)
            }
        })
    })
    // Fungsi Edit 
    // mengirim data yang dipilih ke edit.php
    function edit() {
        document.proses.action = 'edit.php';
        document.proses.submit();
    }
    // Fungsi Hapus
    // Menampilkan konfirmasi terlebih dahulu.
    // Jika pengguna memilih OK,
    // data dikirim ke del.php.
    function hapus() {
        var conf = confirm('Yakin akan menghapus data?');
        if(conf) {
            document.proses.action = 'del.php';
            document.proses.submit();
        }
    }
    </script>

<?php 
// Memanggil file footer
include_once('../_footer.php'); ?>