<?php
include 'header.php';
include 'config.php';
?>

<!-- Button -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAngkatan">Tambah Data</button>
<!--Button Trigger & Datalase Example -->
<div class="card shadow mb-4">
<div class="class-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Data Angkatan</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th width="50">No</th>
                    <th>Nama Angkatan</th>
                    <th>Biaya</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Query untuk baca data dari tabel Database (Webspp) -->
                <?php
                $no=1;
                $query = "SELECT * FROM angkatan";
                $exec = mysqli_query($db,$query);
                while($res = mysqli_fetch_assoc($exec)):
                ?>
                <tr>
                    <!-- Mengambil data yg ada di tiap kolom angkatan -->
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $res['nama_angkatan'] ?></td>
                    <td><?= $res['biaya'] ?></td>
                    <td class="text-center">
                        <div class="btn-grup mr-2" role="group" aria-label="Action group button">
                            <!-- tombol edit data angkatan -->
                            <a href="#" class="view_data btn btn-sm btn-warning" data-toggle="modal" data-target="#editAngkatan" id="<?php echo $res['id_angkatan']; ?>">Update</a>
                            <!-- Tombol hapus data angkatan -->
                            <a href="editdataangkatan.php?id_angkatan=<?= $res['id_angkatan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus Data?')">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>

<!-- INPUT DATA ANGKATAN -->
<!-- Modal -->
<div class="modal fade" id="tambahAngkatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="editdataangkatan.php" method="POST">
                    <input type="text" name="nama_angkatan" placeholder="Nama Angkatan" class="form-control mb-2">
                    <input type="text" name="biaya" placeholder="Biaya SPP" class="form-control mb-3">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAngkatan" tabindex="-1" aria-labelledby="exampleModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Angkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dataangkatan">
                <!-- Form edit data angkatan dipisah ke file view.php -->
            </div>
        </div>
    </div>
</div>
<script>
                    $('.view_data').click(function(){
                        var id_angkatan = $(this).attr('id');
                        $.ajax({
                            url: 'view.php',
                            method: 'POST',
                            data: {id_angkatan:id_angkatan},
                            success:function(data){
                                $('#dataangkatan').html(data)
                                $('#editAngkatan').modal('show');
                            }
                        })
                    })
                </script>

<!-- Fungsi PHP -->
<?php
if(isset($_POST['simpan'])) {
    $nama_angkatan = htmlentities(strip_tags(strtoupper($_POST['nama_angkatan'])));
    $biaya = htmlentities(strip_tags(strtoupper($_POST['biaya'])));
    $query = "INSERT INTO angkatan (nama_angkatan,biaya) VALUES ('$nama_angkatan', '$biaya')";
    $exec = mysqli_query($db, $query);
    if($exec) {
        echo "<script>alert('Save Success')
        document.location = 'editdataangkatan.php';</script>";
    }else {
        echo "<script>alert('Save Failed')
        document.location = 'editdataangkatan.php';</script>";
    }
}

if(isset($_GET['id_angkatan'])) {
    $id_angkatan = $_GET['id_angkatan'];
    $exec = mysqli_query($db,"DELETE FROM angkatan WHERE id_angkatan='$id_angkatan'");
    if($exec) {
        echo "<script>alert('data angkatan berhasil dihapus') document.location = 'editdataangkatan.php';</script>";
    }else {
        echo "<script>alert('data-angkatan gagal dihapus') document.location = 'editdataangkatan.php';</script>";
    }
}
//proses hapus data pada table

if(isset($_POST['update'])) {
    $id_angkatan = $_POST['id_angkatan'];
    $nama_angkatan = htmlentities(strip_tags(strtoupper($_POST['nama_angkatan'])));
    $biaya = htmlentities(strip_tags(strtoupper($_POST['biaya'])));
    $query = "UPDATE angkatan SET nama_angkatan = '$nama_angkatan', biaya = '$biaya' WHERE id_angkatan = '$id_angkatan'";
    if($exec) {
        echo "<script>alert('data angkatan success UPDATE')document.location = 'editdataangkatan.php'</script>";
    }else {
        echo "<script>alert('data angkatan failed UPDATE')document.location = 'editdataangkatan.php'</script>";
    }
}
?>