<?php 
// Memanggil file header
include_once('../_header.php'); ?>

    <div class="box">
        <h1>Obat</h1>
        <h4>
            <small>Data Obat</small>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
                <a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i>Tambah Obat</a>
            </div>    
        </h4>
        <div style="margin-bottom: 20px;">
            <form class="form-inline" action="" method="post">
                <div class="form-group">
                    <input type="text" name="pencarian" class="form-control" placeholder="Pencarian">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Obat</th>
                        <th>Keterangan</th>
                        <th><i class="glyphicon glyphicon-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Menentukan jumlah data setiap halaman
                $batas = 5;
                // Mengambil nomor halaman
                $hal = @$_GET['hal'];
                // Menghitung posisi awal data,untuk pagination
                if(empty($hal)) {
                    $posisi = 0;
                    $hal = 1;
                } else {
                    $posisi = ($hal - 1) * $batas;
                }
                // Nomor urut tabel
                $no = 1;
                // Jika pengguna melakukan pencarian
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    // Mengambil kata kunci pencarian
                    $pencarian = trim(mysqli_real_escape_string($con, $_POST['pencarian']));
                    // Jika kata kunci tidak kosong
                    if($pencarian != '') {
                        $sql = "SELECT * FROM tb_obat WHERE nama_obat LIKE '%$pencarian%'";
                        $query = $sql;
                        $queryJml = $sql;
                    } else {
                        // Menampilkan seluruh data
                        $query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tb_obat";
                        $no = $posisi + 1;
                    }
                } else {
                        // Menampilkan data tanpa pencarian
                        $query = "SELECT * FROM tb_obat LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tb_obat";
                        $no = $posisi + 1; 
                }
                // Menjalankan query
                $sql_obat = mysqli_query($con, $query) or die (mysqli_error($con));
                // Mengecek apakah data ditemukan
                if(mysqli_num_rows($sql_obat) > 0 ) {
                    while($data = mysqli_fetch_array($sql_obat)) { ?>
                        <tr>
                            <td><?=$no++?>.</td>
                            <td><?=$data['nama_obat']?></td>
                            <td><?=$data['ket_obat']?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?=$data['id_obat']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="del.php?id=<?=$data['id_obat']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    // Jika data tidak ditemukan
                    echo "<tr><td colspan=\"4\" align=\"center\">Data Tidak Ditemukan</td></tr>";
                }
                ?>  
                </tbody>
            </table>
        </div>
        <?php
        // Menampilkan Pagination
        if(($_POST['pencarian'] ?? '') == '') { ?>
             <div style="float:left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
                echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div style="float:right;">
                <ul class="pagination pagination-sm" style="margin:0">
                    <?php
                    // Menghitung jumlah halaman
                    $jml_hal = ceil($jml / $batas);
                    // Menampilkan nomor halaman
                    for ($i=1; $i <= $jml_hal; $i++) {
                        if($i != $hal) {
                            echo "<li><a href=\"?hal=$i\">$i</a></li>";
                        } else {
                            echo "<li class=\"active\"><a>$i</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php           
        } else { 
            // Menampilkan jumlah hasil pencarian
            echo "<div style=\"float:left;\">";
            $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
            echo "Data Hasil Pencarian : <b>$jml</b>";
            echo "</div>";
        }
        ?>
    </div>

<?php include_once('../_footer.php'); ?>