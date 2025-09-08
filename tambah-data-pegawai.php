<?php
include 'layouts/header.php';

if (isset($_POST['simpan'])) {
    $name         = $_POST['name'];
    $username     = $_POST['nip'];
    $password     = $_POST['password'];
    $jabatan      = $_POST['jabatan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $st_pegawai   = $_POST['st_pegawai'];
    $role         = $_POST['role'];
    $lok_berkas   = $_POST['lok_berkas'];

    if (!empty($password)) {
        $query_insert = "INSERT INTO users (name, nip, password, jabatan, jeniskelamin, st_pegawai, role, lok_berkas)
                         VALUES ('$name', '$username', '$password', '$jabatan', '$jeniskelamin', '$st_pegawai', '$role', '$lok_berkas')";
    } else {
        $query_insert = "INSERT INTO users (name, nip, jabatan, jeniskelamin, st_pegawai, role, lok_berkas)
                         VALUES ('$name', '$username', '$jabatan', '$jeniskelamin', '$st_pegawai', '$role', '$lok_berkas')";
    }

    $run_query_insert = mysqli_query($conn, $query_insert);

    if ($run_query_insert) {
        echo "<script>
        alert('Data Berhasil Ditambahkan');
        window.location.href='users.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Ditambahkan');
        window.location.href='tambah-data-pegawai.php';
        </script>";
    }
}
?>

<style>
    /* ======= STYLING RESPONSIF SENADA ======= */
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

    .form-buttons {
        text-align: center;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        background: #01356d;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        margin: 0 5px;
        transition: background 0.3s;
    }

    .btn:hover {
        background: orange;
        color: black;
    }

    /* RESPONSIVE */
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

        .form-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
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
        <b>Tambah Data Pegawai</b>
    </div>

    <div class="box-content">
        <form action="" method="post">
            <small>Nama Pegawai (Beserta Gelar Jika Ada) :</small>
            <div class="form-group">
                <input type="text" name="name" placeholder="Masukkan Nama Pegawai" required>
            </div>

            <small>Username (NIP) :</small>
            <div class="form-group">
                <input type="text" name="nip" placeholder="Masukkan Username" required>
            </div>

            <small>Password :</small>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan Password">
            </div>

            <small>Jenis Kelamin :</small>
            <div class="form-group">
                <select name="jeniskelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <small>Jabatan :</small>
            <div class="form-group">
                <select name="jabatan">
                    <option value="">Jabatan</option>
                    <option value="Kepala Stasiun NTT">Kepala Stasiun</option>
                    <option value="Kepala Tata Usaha">Kepala Tata Usaha</option>
                    <option value="Analis Anggaran Ahli Pertama">Analis Anggaran Ahli Pertama</option>
                    <option value="Analis Hukum Ahli Pertama">Analis Hukum Ahli Pertama</option>
                    <option value="Analis Pengelolaan Keuangan APBN Ahli Pertama">Analis Pengelolaan Keuangan APBN Ahli Pertama</option>
                    <option value="Analis Sumber Daya Manusia Aparatur Ahli Pertama">Analis Sumber Daya Manusia Aparatur Ahli Pertama</option>
                    <option value="Apoteker Ahli Pertama">Apoteker Ahli Pertama</option>
                    <option value="Arsiparis Ahli Pertama">Arsiparis Ahli Pertama</option>
                    <option value="Arsiparis Terampil">Arsiparis Terampil</option>
                    <option value="Asesor Sumber Daya Manusia Aparatur Ahli Pertama">Asesor Sumber Daya Manusia Aparatur Ahli Pertama</option>
                    <option value="Asisten Teknisi Siaran Pemula">Asisten Teknisi Siaran Pemula</option>
                    <option value="Asisten Teknisi Siaran Terampil">Asisten Teknisi Siaran Terampil</option>
                    <option value="Dokter Ahli Pertama">Dokter Ahli Pertama</option>
                    <option value="Dokter Gigi Ahli Pertama">Dokter Gigi Ahli Pertama</option>
                    <option value="Penata Kelola Pemerintahan">Penata Kelola Pemerintahan</option>
                    <option value="Penata Laksana Barang Terampil">Penata Laksana Barang Terampil</option>
                    <option value="Pengelola Keprotokolan">Pengelola Keprotokolan</option>
                    <option value="Penyusun Materi Hukum dan Perundang Undangan">Penyusun Materi Hukum dan Perundang Undangan</option>
                    <option value="Perawat Ahli Pertama">Perawat Ahli Pertama</option>
                    <option value="Perencana Ahli Pertama">Perencana Ahli Pertama</option>
                    <option value="Pranata Hubungan Masyarakat Ahli Pertama">Pranata Hubungan Masyarakat Ahli Pertama</option>
                    <option value="Pranata Hubungan Masyarakat Terampil">Pranata Hubungan Masyarakat Terampil</option>
                    <option value="Pranata Keuangan APBN Terampil">Pranata Keuangan APBN Terampil</option>
                    <option value="Pranata Komputer Ahli Pertama">Pranata Komputer Ahli Pertama</option>
                    <option value="Pranata Siaran Ahli Pertama">Pranata Siaran Ahli Pertama</option>
                    <option value="Pranata Sumber Daya Manusia Aparatur Terampil">Pranata Sumber Daya Manusia Aparatur Terampil</option>
                    <option value="Teknisi Siaran Ahli Pertama">Teknisi Siaran Ahli Pertama</option>
                </select>
            </div>

            <small>Status Kepegawaian :</small>
            <div class="form-group">
                <select name="st_pegawai">
                    <option value="">Status Pegawai</option>
                    <option value="PNS">PNS</option>
                    <option value="PPPK">PPPK</option>
                    <option value="PBPNS">PBPNS</option>
                    <option value="Kontrak">Kontrak</option>
                </select>
            </div>

            <small>Role :</small>
            <div class="form-group">
                <select name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <small>Lokasi Berkas :</small>
            <div class="form-group">
                <input type="text" name="lok_berkas" placeholder="Lokasi Berkas">
            </div>

            <div class="form-buttons">
                <button type="submit" name="simpan" class="btn">Simpan</button>
                <button type="button" onclick="window.location.href='users.php'" class="btn">Kembali</button>
            </div>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
