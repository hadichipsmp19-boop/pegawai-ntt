<?php
    include 'layouts/header.php';

    if(isset($_SESSION['uid'])){
        $id = $_SESSION['uid'];
        $query_check = "SELECT id, name, jabatan, jbtn_lain, nik, nip, nohp, norek, tgl_lhr, agama, jeniskelamin,
                        alamat_pegawai, st_perkawinan, st_pegawai, username, email, tmpt_lhr, role 
                        FROM users WHERE id ='$id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);

        if(!$result){
            header("Location: users.php");
            exit;
        }
    }

    if(isset($_POST['simpan'])){
        $id        = $_POST['id'];
        $name      = $_POST['name'];
        $jabatan   = $_POST['jabatan'];
        $jbtn_lain = $_POST['jbtn_lain'];
        $nik       = $_POST['nik'];
        $nip       = $_POST['nip'];
        $nohp      = $_POST['nohp'];
        $norek     = $_POST['norek'];
        $tmpt_lhr  = $_POST['tmpt_lhr'];
        $tgl_lhr   = $_POST['tgl_lhr'];
        $agama     = $_POST['agama'];
        $jk        = $_POST['jeniskelamin'];
        $alamatpeg = $_POST['alamat_pegawai'];
        $st_kawin  = $_POST['st_perkawinan'];
        $st_pegawai= $_POST['st_pegawai'];
        $email     = $_POST['email'];
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $role      = $_POST['role'];

        if(!empty($password)){
            $query_update = "UPDATE users 
                            SET name='$name', jabatan='$jabatan', jbtn_lain='$jbtn_lain', nik='$nik', nip='$nip', 
                                nohp='$nohp', norek='$norek', tgl_lhr='$tgl_lhr', agama='$agama', jeniskelamin='$jk',
                                alamat_pegawai='$alamatpeg', st_perkawinan='$st_kawin', email='$email', 
                                username='$username', tmpt_lhr='$tmpt_lhr', password='$password', role='$role'
                            WHERE id='$id'";
        } else {
            $query_update = "UPDATE users 
                            SET name='$name', jabatan='$jabatan', jbtn_lain='$jbtn_lain', nik='$nik', nip='$nip', 
                                nohp='$nohp', norek='$norek', tgl_lhr='$tgl_lhr', agama='$agama', jeniskelamin='$jk',
                                alamat_pegawai='$alamatpeg', st_perkawinan='$st_kawin', email='$email', 
                                username='$username', tmpt_lhr='$tmpt_lhr', role='$role'
                            WHERE id='$id'";
        }

        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                alert('Data Berhasil Diubah');
                window.location.href='informasi-pegawai.php';
            </script>";
        } else {
            echo "<script>
                alert('Data Gagal Diubah');
                window.location.href='index.php';
            </script>";
        }
    }
?>

<style>
    .box {
        max-width: 900px;
        margin: 20px auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .box-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .box-content form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px 20px;
    }

    .box-content form small {
        grid-column: span 2;
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }

    .form-group {
        grid-column: span 2;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        transition: border 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #01356d;
        outline: none;
    }

    .btn {
        background: #01356d;
        color: white;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
        width: 100%;
    }

    .btn:hover {
        background: orange;
        color: black;
    }

    .btn-container {
        grid-column: span 2;
        display: flex;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .box-content form {
            grid-template-columns: 1fr;
        }
        .btn-container {
            flex-direction: column;
        }
    }
</style>

<div class="box">
    <div class="box-header">
        Edit Data Pegawai - <b><?= $_SESSION['uname']?></b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <input type="hidden" name="id" value ="<?= $_SESSION['uid']?>">

            <small>Username :</small>
            <div class="form-group">
                <input type="text" name="username" value="<?= $result->nip?>" readonly>
            </div>

            <small>Password :</small>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan Password">
            </div>

            <small>Nomor Induk Pegawai :</small>
            <div class="form-group">
                <input type="text" name="nip" value="<?= $result->nip?>" readonly>
            </div>

            <small>Nomor Induk Kependudukan :</small>
            <div class="form-group">
                <input type="text" name="nik" value="<?= $result->nik?>" required>
            </div>

            <small>Nama Pegawai :</small>
            <div class="form-group">
                <input type="text" name="name" value="<?= $result->name?>" readonly>
            </div>

            <small>Jabatan :</small>
            <div class="form-group">
                <input type="text" name="jabatan" value="<?= $result->jabatan?>">
            </div>

            <small>Jabatan Lain :</small>
            <div class="form-group">
                <input type="text" name="jbtn_lain" value="<?= $result->jbtn_lain?>">
            </div>

            <small>Tempat Lahir :</small>
            <div class="form-group">
                <input type="text" name="tmpt_lhr" value="<?= $result->tmpt_lhr?>">
            </div>

            <small>Tanggal Lahir :</small>
            <div class="form-group">
                <input type="date" name="tgl_lhr" value="<?= $result->tgl_lhr?>">
            </div>

            <small>Jenis Kelamin :</small>
            <div class="form-group">
                <select name="jeniskelamin">
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki-laki" <?= $result->jeniskelamin == 'Laki-laki' ? 'selected':''?>>Laki-laki</option>
                    <option value="Perempuan" <?= $result->jeniskelamin == 'Perempuan' ? 'selected':''?>>Perempuan</option>
                </select>
            </div>

            <small>Agama :</small>
            <div class="form-group">
                <select name="agama">
                    <option value="">Pilih Agama</option>
                    <option value="Islam" <?= $result->agama == 'Islam' ? 'selected':''?>>Islam</option>
                    <option value="Kristen" <?= $result->agama == 'Kristen' ? 'selected':''?>>Kristen</option>
                    <option value="Katolik" <?= $result->agama == 'Katolik' ? 'selected':''?>>Katolik</option>
                    <option value="Hindu" <?= $result->agama == 'Hindu' ? 'selected':''?>>Hindu</option>
                    <option value="Buddha" <?= $result->agama == 'Buddha' ? 'selected':''?>>Buddha</option>
                    <option value="Konghucu" <?= $result->agama == 'Konghucu' ? 'selected':''?>>Kong Hu Cu</option>
                </select>
            </div>

            <small>Alamat Pegawai :</small>
            <div class="form-group">
                <input type="text" name="alamat_pegawai" value="<?= $result->alamat_pegawai?>" required>
            </div>

            <small>Status Perkawinan :</small>
            <div class="form-group">
                <select name="st_perkawinan">
                    <option value="">Status Perkawinan</option>
                    <option value="Kawin" <?= $result->st_perkawinan == 'Kawin' ? 'selected':''?>>Kawin</option>
                    <option value="Belum Kawin" <?= $result->st_perkawinan == 'Belum Kawin' ? 'selected':''?>>Belum Kawin</option>
                    <option value="Duda" <?= $result->st_perkawinan == 'Duda' ? 'selected':''?>>Duda</option>
                    <option value="Janda" <?= $result->st_perkawinan == 'Janda' ? 'selected':''?>>Janda</option>
                </select>
            </div>

            <small>Status Kepegawaian :</small>
            <div class="form-group">
                <select name="st_pegawai" disabled>
                    <option value="">Status Pegawai</option>
                    <option value="PNS" <?= $result->st_pegawai == 'PNS' ? 'selected':''?>>PNS</option>
                    <option value="PPPK" <?= $result->st_pegawai == 'PPPK' ? 'selected':''?>>PPPK</option>
                    <option value="PBPNS" <?= $result->st_pegawai == 'PBPNS' ? 'selected':''?>>PBPNS</option>
                    <option value="Kontrak" <?= $result->st_pegawai == 'Kontrak' ? 'selected':''?>>Kontrak</option>
                </select>
            </div>

            <small>Nomor HP :</small>
            <div class="form-group">
                <input type="text" name="nohp" value="<?= $result->nohp?>" required>
            </div>

            <small>Email :</small>
            <div class="form-group">
                <input type="email" name="email" value="<?= $result->email?>" required>
            </div>

            <small>Nomor Rekening BRI :</small>
            <div class="form-group">
                <input type="text" name="norek" value="<?= $result->norek?>">
            </div>

            <div class="form-group">
                <select name="role" hidden>
                    <option value="">Pilih Role</option>
                    <option value="admin" <?= $result->role == 'admin' ? 'selected':''?>>Admin</option>
                    <option value="user" <?= $result->role == 'user' ? 'selected':''?>>User</option>
                </select>
            </div>

            <div class="btn-container">
                <button type="submit" name="simpan" class="btn">Simpan Perubahan</button>
                <button type="button" onclick="window.location.href='index.php'" class="btn">Batal</button>
            </div>
        </form>
    </div>
</div>

<?php
    include 'layouts/footer.php';
?>
