<?php
    include 'layouts/header.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query_check = "SELECT id, name, username, nip, jabatan, st_pegawai, role, lok_berkas, jeniskelamin FROM users WHERE id ='$id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);

        if(!$result){
            header("Location: users.php");
            exit;
        }
    }

    if(isset($_POST['simpan'])){
        $id         = $_POST['id'];
        $name       = $_POST['name'];
        $username   = $_POST['nip'];
        $password   = $_POST['password'];
        $jeniskelamin = $_POST['jeniskelamin'];
        $jabatan    = $_POST['jabatan'];
        $st_pegawai = $_POST['st_pegawai'];
        $role       = $_POST['role'];
        $lok_berkas = $_POST['lok_berkas'];

        if(!empty($password)){
            $query_update = "UPDATE users SET 
                                name = '$name', 
                                nip = '$username', 
                                password = '$password', 
                                jeniskelamin = '$jeniskelamin', 
                                jabatan = '$jabatan', 
                                st_pegawai = '$st_pegawai', 
                                role = '$role', 
                                lok_berkas = '$lok_berkas' 
                            WHERE id = '$id'";
        } else {
            $query_update = "UPDATE users SET 
                                name = '$name', 
                                nip = '$username', 
                                jeniskelamin = '$jeniskelamin', 
                                jabatan = '$jabatan', 
                                st_pegawai = '$st_pegawai', 
                                role = '$role', 
                                lok_berkas = '$lok_berkas' 
                            WHERE id = '$id'";
        }

        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
            alert('Data Berhasil Diubah');
            window.location.href='users.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Diubah');
            window.location.href='users.php';
            </script>";
        }
    }
?>

<style>
    .box {
        max-width: 700px;
        margin: 30px auto;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }

    .box-header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    input[type="text"], input[type="password"], select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="password"]:focus, select:focus {
        border-color: #007bff;
        outline: none;
    }

    small {
        display: block;
        margin-bottom: 5px;
        color: #444;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background: #01356d;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        margin: 5px;
        transition: background 0.3s;
    }

    .btn:hover {
        background: orange;
        color : black;
    }

    .btn-group {
        text-align: center;
        margin-top: 20px;
    }

    footer {
        font-weight: normal !important;
    }

    @media (max-width: 1024px) {
        .box {
            width: 90%;
        }
    }

    @media (max-width: 768px) {
        .box {
            padding: 15px;
        }

        input, select {
            font-size: 13px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    @media (max-width: 480px) {
        .box-header {
            font-size: 18px;
        }

        small {
            font-size: 13px;
        }

        input, select {
            font-size: 12px;
            padding: 8px;
        }

        .btn {
            font-size: 13px;
        }
    }
</style>

<div class="box">
    <div class="box-header">
        <b>Edit Data Pegawai</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <input type="hidden" name="id" value ="<?= $_GET['id']?>">

            <small>Nama Pegawai (Beserta Gelar Jika Ada) :</small>
            <div class="form-group">
                <input type="text" name="name" placeholder="Masukkan Nama Pegawai" value="<?= $result->name?>" required>
            </div>

            <small>Username (NIP) :</small>
            <div class="form-group">
                <input type="text" name="nip" placeholder="Masukkan Username" value="<?= $result->nip?>" required>
            </div>

            <small>Password :</small>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan Password">
            </div>

            <small>Jenis Kelamin :</small>
            <div class="form-group">
                <select name="jeniskelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" <?= $result->jeniskelamin == 'Laki-laki' ? 'selected':''?>>Laki-laki</option>
                    <option value="Perempuan" <?= $result->jeniskelamin == 'Perempuan' ? 'selected':''?>>Perempuan</option>
                </select>
            </div>

            <small>Jabatan :</small>
            <div class="form-group">
                <select name="jabatan">
                    <option value="">Jabatan</option>
                    <option value="Kepala Stasiun NTT" <?= $result->jabatan == 'Kepala Stasiun NTT' ? 'selected':''?>>Kepala Stasiun</option>
                    <option value="Kepala Tata Usaha" <?= $result->jabatan == 'Kepala Tata Usaha' ? 'selected':''?>>Kepala Tata Usaha</option>
                    <option value="Analis Anggaran Ahli Pertama" <?= $result->jabatan == 'Analis Anggaran Ahli Pertama' ? 'selected':''?>>Analis Anggaran Ahli Pertama</option>
                    <option value="Analis Hukum Ahli Pertama" <?= $result->jabatan == 'Analis Hukum Ahli Pertama' ? 'selected':''?>>Analis Hukum Ahli Pertama</option>
                    <option value="Analis Pengelolaan Keuangan APBN Ahli Pertama" <?= $result->jabatan == 'Analis Pengelolaan Keuangan APBN Ahli Pertama' ? 'selected':''?>>Analis Pengelolaan Keuangan APBN Ahli Pertama</option>
                    <option value="Analis Sumber Daya Manusia Aparatur Ahli Pertama" <?= $result->jabatan == 'Analis Sumber Daya Manusia Aparatur Ahli Pertama' ? 'selected':''?>>Analis Sumber Daya Manusia Aparatur Ahli Pertama</option>
                    <option value="Apoteker Ahli Pertama" <?= $result->jabatan == 'Apoteker Ahli Pertama' ? 'selected':''?>>Apoteker Ahli Pertama</option>
                    <option value="Arsiparis Ahli Pertama" <?= $result->jabatan == 'Arsiparis Ahli Pertama' ? 'selected':''?>>Arsiparis Ahli Pertama</option>
                    <option value="Arsiparis Terampil" <?= $result->jabatan == 'Arsiparis Terampil' ? 'selected':''?>>Arsiparis Terampil</option>
                    <option value="Asesor Sumber Daya Manusia Aparatur Ahli Pertama" <?= $result->jabatan == 'Asesor Sumber Daya Manusia Aparatur Ahli Pertama' ? 'selected':''?>>Asesor Sumber Daya Manusia Aparatur Ahli Pertama</option>
                    <option value="Asisten Teknisi Siaran Pemula" <?= $result->jabatan == 'Asisten Teknisi Siaran Pemula' ? 'selected':''?>>Asisten Teknisi Siaran Pemula</option>
                    <option value="Asisten Teknisi Siaran Terampil" <?= $result->jabatan == 'Asisten Teknisi Siaran Terampil' ? 'selected':''?>>Asisten Teknisi Siaran Terampil</option>
                    <option value="Dokter Ahli Pertama" <?= $result->jabatan == 'Dokter Ahli Pertama' ? 'selected':''?>>Dokter Ahli Pertama</option>
                    <option value="Dokter Gigi Ahli Pertama" <?= $result->jabatan == 'Dokter Gigi Ahli Pertama' ? 'selected':''?>>Dokter Gigi Ahli Pertama</option>
                    <option value="Penata Kelola Pemerintahan" <?= $result->jabatan == 'Penata Kelola Pemerintahan' ? 'selected':''?>>Penata Kelola Pemerintahan</option>
                    <option value="Penata Laksana Barang Terampil" <?= $result->jabatan == 'Penata Laksana Barang Terampil' ? 'selected':''?>>Penata Laksana Barang Terampil</option>
                    <option value="Pengelola Keprotokolan" <?= $result->jabatan == 'Pengelola Keprotokolan' ? 'selected':''?>>Pengelola Keprotokolan</option>
                    <option value="Penyusun Materi Hukum dan Perundang Undangan" <?= $result->jabatan == 'Penyusun Materi Hukum dan Perundang Undangan' ? 'selected':''?>>Penyusun Materi Hukum dan Perundang Undangan</option>
                    <option value="Perawat Ahli Pertama" <?= $result->jabatan == 'Perawat Ahli Pertama' ? 'selected':''?>>Perawat Ahli Pertama</option>
                    <option value="Perencana Ahli Pertama" <?= $result->jabatan == 'Perencana Ahli Pertama' ? 'selected':''?>>Perencana Ahli Pertama</option>
                    <option value="Pranata Hubungan Masyarakat Ahli Pertama" <?= $result->jabatan == 'Pranata Hubungan Masyarakat Ahli Pertama' ? 'selected':''?>>Pranata Hubungan Masyarakat Ahli Pertama</option>
                    <option value="Pranata Hubungan Masyarakat Terampil" <?= $result->jabatan == 'Pranata Hubungan Masyarakat Terampil' ? 'selected':''?>>Pranata Hubungan Masyarakat Terampil</option>
                    <option value="Pranata Keuangan APBN Terampil" <?= $result->jabatan == 'Pranata Keuangan APBN Terampil' ? 'selected':''?>>Pranata Keuangan APBN Terampil</option>
                    <option value="Pranata Komputer Ahli Pertama" <?= $result->jabatan == 'Pranata Komputer Ahli Pertama' ? 'selected':''?>>Pranata Komputer Ahli Pertama</option>
                    <option value="Pranata Siaran Ahli Pertama" <?= $result->jabatan == 'Pranata Siaran Ahli Pertama' ? 'selected':''?>>Pranata Siaran Ahli Pertama</option>
                    <option value="Pranata Sumber Daya Manusia Aparatur Terampil" <?= $result->jabatan == 'Pranata Sumber Daya Manusia Aparatur Terampil' ? 'selected':''?>>Pranata Sumber Daya Manusia Aparatur Terampil</option>
                    <option value="Teknisi Siaran Ahli Pertama" <?= $result->jabatan == 'Teknisi Siaran Ahli Pertama' ? 'selected':''?>>Teknisi Siaran Ahli Pertama</option>
                </select>
            </div>

            <small>Status Kepegawaian :</small>
            <div class="form-group">
                <select name="st_pegawai">
                    <option value="">Status Pegawai</option>
                    <option value="PNS" <?= $result->st_pegawai == 'PNS' ? 'selected':''?>>PNS</option>
                    <option value="PPPK" <?= $result->st_pegawai == 'PPPK' ? 'selected':''?>>PPPK</option>
                    <option value="PBPNS" <?= $result->st_pegawai == 'PBPNS' ? 'selected':''?>>PBPNS</option>
                    <option value="Kontrak" <?= $result->st_pegawai == 'Kontrak' ? 'selected':''?>>Kontrak</option>
                </select>
            </div>

            <small>Role :</small>
            <div class="form-group">
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" <?= $result->role == 'admin' ? 'selected':''?>>Admin</option>
                    <option value="user" <?= $result->role == 'user' ? 'selected':''?>>User</option>
                </select>
            </div>

            <small>Lokasi Berkas :</small>
            <div class="form-group">
                <input type="text" name="lok_berkas" placeholder="Lokasi Berkas" value="<?= $result->lok_berkas?>">
            </div>

            <div class="btn-group">
                <button type="submit" name="simpan" class="btn">Simpan Perubahan</button>
                <button type="button" onclick="window.location.href='users.php'" class="btn">Kembali</button>
            </div>
        </form>
    </div>
</div>

<?php
    include 'layouts/footer.php';
?>
