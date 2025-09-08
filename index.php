<?php
include 'layouts/header.php';

if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    $query_check = "
        SELECT id, name, nik, nip, nohp, norek, tgl_lhr, agama, jeniskelamin,
               alamat_pegawai, st_perkawinan, st_pegawai, username, email, jabatan, jbtn_lain,
               tmpt_lhr, tgl_lhr, pas_foto, role
        FROM users 
        WHERE id = '$id'
    ";
    $run_query_check = mysqli_query($conn, $query_check);
    $result = mysqli_fetch_object($run_query_check);

    if (!$result) {
        header("Location: users.php");
        exit;
    }
}
?>

<div class="box">
    <div class="box-header">
        Selamat Datang, <b><?= htmlspecialchars($_SESSION['uname'])?></b> <br><br>
    </div>

    <div class="box-content">
        <center><h2>RESUME</h2></center>

        <div class="profile-container">
            <div class="profile-left">
                <?php
                $file = 'file/';
                $filename = $result->pas_foto;
                $filepath = $file . $filename;

                if (!empty($filename) && file_exists($filepath)) {
                    echo "<img src='$filepath' alt='Foto Pegawai'>";
                } else {
                    echo "<img src='Gambar/defaultpp.jpg' alt='Foto Default'>";
                }
                ?>
            </div>

            <div class="profile-right">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_SESSION['uid']) ?>">

                <table class="profile-table">
                    <tr><td>Nama Pegawai</td><td>: <?= ucwords($result->name) ?></td></tr>
                    <tr><td>Nomor Induk Pegawai</td><td>: <?= $result->nip ?></td></tr>
                    <tr><td>Nomor Induk Kependudukan</td><td>: <?= $result->nik ?></td></tr>
                    <tr><td>Jabatan</td><td>: <?= ucwords($result->jabatan) ?></td></tr>
                    <tr><td>Jabatan Lain</td><td>: <?= ucwords($result->jbtn_lain) ?></td></tr>
                    <?php $date = new DateTime($result->tgl_lhr); ?>
                    <tr><td>Tempat, Tanggal Lahir</td><td>: <?= ucwords($result->tmpt_lhr) ?>, <?= $date->format('d-m-Y') ?></td></tr>
                    <tr><td>Jenis Kelamin</td><td>: <?= $result->jeniskelamin ?></td></tr>
                    <tr><td>Agama</td><td>: <?= $result->agama ?></td></tr>
                    <tr>
                    <td>Alamat</td>
                    <td class="alamat-td">
                        <span class="colon">:</span>
                        <textarea class="address-box" readonly><?= ucwords($result->alamat_pegawai) ?></textarea>
                    </td>
                    </tr>
                    <tr><td>Status Perkawinan</td><td>: <?= $result->st_perkawinan ?></td></tr>
                    <tr><td>Status Kepegawaian</td><td>: <?= $result->st_pegawai ?></td></tr>
                    <tr><td>Nomor Handphone</td><td>: <?= $result->nohp ?></td></tr>
                    <tr><td>Email</td><td>: <?= $result->email ?></td></tr>
                    <tr><td>Nomor Rekening BRI</td><td>: <?= $result->norek ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

<style>
/* ====== BOX CONTAINER ====== */
.box {
    max-width: 1200px;
    margin: 20px auto;
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.box-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
}

/* ====== PROFILE LAYOUT ====== */
.profile-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    align-items: flex-start;
    margin-top: 20px;
}

.profile-left img {
    width: 200px;
    height: auto;
    border-radius: 10px;
    border: 2px solid #ddd;
    object-fit: cover;
}

.profile-right {
    flex: 1;
    min-width: 280px;
}

/* ====== PROFILE TABLE ====== */
.profile-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
}

.profile-table td {
    padding: 8px 10px;
    border: none;
    vertical-align: middle; /* Biar semua konten sejajar tengah vertikal */
}

.profile-table td:first-child {
    width: 40%;
    font-weight: bold;
}

/* ====== TEXTAREA STYLE ====== */
.address-box {
    width: 100%;
    min-height: 60px;
    resize: vertical;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 8px;
    font-size: 14px;
    font-family: inherit;
    background-color: #f9f9f9;
    color: #333;
    display: inline-block; /* Agar sejajar */
    vertical-align: middle; /* Sejajarkan dengan teks "Alamat" */
}

.textarea-cell {
    vertical-align: middle;
}

/* ====== RESPONSIVE DESIGN ====== */
@media (max-width: 992px) {
    .box {
        padding: 15px;
    }

    .profile-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-right {
        width: 100%;
    }

    .profile-table td {
        display: block;
        text-align: left;
        padding: 5px 0;
    }

    .profile-table td:first-child {
        font-weight: bold;
    }
}

@media (max-width: 600px) {
    .profile-left img {
        width: 150px;
    }

    .profile-table {
        font-size: 14px;
    }
}

/* ====== FLEX UNTUK ALAMAT ====== */
.alamat-td {
    display: flex;
    align-items: center; /* sejajarkan secara vertikal */
    gap: 8px; /* jarak titik dua dan textarea */
}

.colon {
    flex-shrink: 0; /* supaya titik dua tidak mengecil */
}

.address-box {
    flex: 1; /* biar textarea menyesuaikan lebar */
    min-height: 60px;
    resize: vertical;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 8px;
    font-size: 14px;
    font-family: inherit;
    background-color: #f9f9f9;
    color: #333;
}

</style>
