<?php include 'config.php';

if(isset($_POST['id_angkatan'])){
    $id_angkatan = $_POST['id_angkatan'];
    $exec = mysqli_query($db,"SELECT * FROM angkatan WHERE id_angkatan='$id_angkatan'");
    $res = mysqli_fetch_assoc($exec);
    ?>
    <form action="editdataangkatan.php" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_angkatan" value="<?= $res['id_angkatan']?>">
        </div>
        <div class="form-group">
            <label>Nama Angkatan</label>
            <input type="text" class="form-control" nama="nama_angkatan" value="<?= $res['nama_angkatan']?>">
        </div>
        <div class="form-group">
            <label>Biaya</label>
            <input type="text" class="form-control" name="biaya" value="<?= $res['biaya']?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="Submit" name="update" class="btn btn-warning">Update</button>
        </div>
    </form>
<?php }?>