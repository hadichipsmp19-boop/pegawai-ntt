<?php
    include 'layouts/header.php';

    if (isset($_GET['hapus-user'])) {
        $id = $_GET['hapus-user'];
        $query_delete = "DELETE FROM users WHERE id = '$id'";
        $run_query_delete = mysqli_query($conn, $query_delete);
    }
?>

<style>
    /* Container utama */
    .box {
        background: #fff;
        padding: 20px;
        margin: 20px auto;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        max-width: 1200px;
    }

    .box-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .box-content {
        width: 100%;
    }

    /* Tombol tambah */
    .box-content a:first-child {
        background: #007bff;
        color: #fff;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s;
    }
    .box-content a:first-child:hover {
        background: #0b3d91;
    }

    /* Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        table-layout: fixed;
    }
    thead {
        background: #01356d;
        color: white;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Lebar kolom */
    th:nth-child(1), td:nth-child(1) { width: 50px; }     /* No. */
    th:nth-child(2), td:nth-child(2) { width: 220px; }    /* Nama Pegawai */
    th:nth-child(3), td:nth-child(3) { width: 160px; white-space: nowrap; } /* Username (NIP) */
    th:nth-child(4), td:nth-child(4) { width: 280px; }    /* Jabatan diperlebar */
    th:nth-child(5), td:nth-child(5) { width: 90px; }     /* Role kecil */
    th:nth-child(6), td:nth-child(6) { width: 140px; white-space: nowrap; } /* Aksi diperkecil */

    /* Tombol Edit & Hapus */
    .btn-edit, .btn-delete {
        display: inline-block;
        padding: 8px 0;
        width: 65px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
        font-size: 14px;
        margin: 0 2px;
    }
    .btn-edit {
        background: #007bff;
        color: #fff;
    }
    .btn-edit:hover {
        background: #0056b3;
    }
    .btn-delete {
        background: #ef0e25ff;
        color: #fff;
    }
    .btn-delete:hover {
        background: #a71d2a;
    }

    /* Responsif */
    @media (max-width: 768px) {
        table, thead, tbody, tr, td, th {
            display: block;
            width: 100%;
        }
        thead { display: none; }
        tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        td {
            text-align: left;
            padding: 8px 10px;
            position: relative;
            word-break: break-word;
        }
        td:before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
    }
</style>

<div class="box">
    <div class="box-header">
        <b>Data Admin/User</b>
    </div>

    <div class="box-content">
        <a href="tambah-data-pegawai.php">+ Tambah Admin/User</a></br></br>
        <center>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pegawai</th>
                        <th>Username (NIP)</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_get_data = "SELECT * FROM users ORDER BY id DESC";
                        $run_query_get_data = mysqli_query($conn, $query_get_data);
                        $no = 1;
                        while ($row = mysqli_fetch_array($run_query_get_data)):
                    ?>
                    <tr>
                        <td data-label="No."><?= $no++ ?></td>
                        <td data-label="Nama Pegawai"><?= ucwords($row['name']) ?></td>
                        <td data-label="Username (NIP)"><?= $row['nip'] ?></td>
                        <td data-label="Jabatan"><?= ucwords($row['jabatan']) ?></td>
                        <td data-label="Role"><?= ucwords($row['role']) ?></td>
                        <td data-label="Aksi">
                            <a class="btn-edit" href="edit-user.php?id=<?= $row['id'] ?>">Edit</a>
                            <a class="btn-delete" href="?hapus-user=<?= $row['id'] ?>" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </center>
    </div>
</div>

<?php
    include 'layouts/footer.php';
?>
