<?php
    include 'layouts/header.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query_check = "SELECT id, name, tmpt_lhr, norek, email, nohp, tgl_lhr, agama,
                        st_perkawinan, jeniskelamin, alamat_pegawai, username, nip, nik,
                        jabatan, jbtn_lain, st_pegawai, role, pas_foto, lok_berkas 
                        FROM users WHERE id ='$id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $result = mysqli_fetch_object($run_query_check);

        if (!$result) {
            header('Location: users.php');
            exit;
        }
    }
?>

<style>
    /* Container Utama */
    .box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin: 20px auto;
        max-width: 1200px;
    }

    .box-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Table Umum */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    td {
        padding: 10px;
        vertical-align: top;
        border: none;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    /* Tombol */
    button {
        padding: 8px 14px;
        border: none;
        background: #007bff;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background 0.3s;
    }
    button:hover {
        background: #0056b3;
    }

    /* Responsif untuk Detail Pegawai */
    @media (max-width: 768px) {
        table,
        tbody,
        tr,
        td {
            display: block;
            width: 100%;
        }

        td {
            padding: 8px 5px;
        }

        tr {
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        td:first-child {
            font-weight: bold;
            background: #f8f9fa;
        }
    }

    /* Heading Dokumen */
    h4 {
        margin: 20px 0 10px;
    }
</style>

<div class="box">
    <div class="box-header">
        Detail Data Pegawai
    </div>

    <input type="hidden" name="id" value ="<?= $_GET['id'] ?>">

    <!-- Data Pegawai -->
    <table>
        <tr><td>Nama Pegawai</td><td>: <?= ucwords($result->name) ?></td></tr>
        <tr><td>Nomor Induk Pegawai</td><td>: <?= $result->nip ?></td></tr>
        <tr><td>Nomor Induk Kependudukan</td><td>: <?= $result->nik ?></td></tr>
        <tr><td>Jabatan</td><td>: <?= $result->jabatan ?></td></tr>
        <tr><td>Jabatan Lain</td><td>: <?= ucwords($result->jbtn_lain) ?></td></tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: <?= ucwords($result->tmpt_lhr) ?>, <?= (new DateTime($result->tgl_lhr))->format('d-m-Y') ?></td>
        </tr>
        <tr><td>Jenis Kelamin</td><td>: <?= $result->jeniskelamin ?></td></tr>
        <tr><td>Agama</td><td>: <?= $result->agama ?></td></tr>
        <tr><td>Alamat</td><td>: <?= ucwords($result->alamat_pegawai) ?></td></tr>
        <tr><td>Status Perkawinan</td><td>: <?= $result->st_perkawinan ?></td></tr>
        <tr><td>Status Kepegawaian</td><td>: <?= $result->st_pegawai ?></td></tr>
        <tr><td>Nomor Handphone</td><td>: <?= $result->nohp ?></td></tr>
        <tr><td>Email</td><td>: <?= $result->email ?></td></tr>
        <tr><td>Nomor Rekening BRI</td><td>: <?= $result->norek ?></td></tr>
        <tr><td>Lokasi Berkas</td><td>: <?= $result->lok_berkas ?></td></tr>
    </table>

    <center><h4><u>Dokumen/Berkas Pegawai</u></h4></center>

    <!-- Dokumen Pegawai -->
    <table>
        <?php 
            $dokumen = [
                "File Pas Foto Terbaru Latar Belakang Merah",
                "File Scan Kartu Tanda Penduduk",
                "File Scan Akta Kelahiran",
                "File Scan Kartu Keluarga",
                "File Scan Ijazah SD",
                "File Scan Ijazah SMP",
                "File Scan Ijazah SMA",
                "File Scan Ijazah Perguruan Tinggi",
                "File Scan Buku Tabungan",
                "File Scan NPWP",
                "File Scan SK TMT",
                "File Scan SK SPMT",
                "File Scan SK Terakhir CPNS/PPPK"
            ];
            foreach ($dokumen as $doc):
        ?>
        <tr>
            <td><?= $doc ?></td>
            <td>
                <center>
                    <button onclick="window.open('view_pas_foto.php?id=<?= $id ?>', 'popup', 'width=800,height=600'); return false;">Lihat</button>
                </center>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
    include 'layouts/footer.php';
?>
