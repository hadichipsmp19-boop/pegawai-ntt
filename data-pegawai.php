<?php
    include 'layouts/header.php';
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Box style */
    .box {
        max-width: 1200px;
        margin: 20px auto;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
    }

    .box-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Form Search */
    form {
        margin-bottom: 15px;
    }
    form input[type="text"], form select {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }
    form input[type="text"] {
        width: 250px;
    }
    form input[type="text"]:focus, form select:focus {
        border-color: #007BFF;
    }
    .btn-search {
        padding: 8px 16px;              
        background: #01356d;           
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        margin-left: 8px;
        transition: background 0.3s ease;
        min-width: 100px;              
    }
    .btn-search:hover {
        background: orange;
        color: black;
    }

    /* Table Style */
    table {
        border-collapse: collapse;
        width: 100%;
        margin: auto;
        table-layout: fixed;
    }
    table thead {
        background: #01356d;
        color: white;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Button Detail */
    .btn-detail {
        padding: 6px 12px;
        border: none;
        background: #28a745;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
        min-width: 80px;
    }
    .btn-detail:hover {
        background: #218838;
    }

    /* Responsif */
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
            width: 100%;
        }
        thead tr {
            display: none;
        }
        tr {
            margin-bottom: 10px;
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px;
        }
        td {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            text-align: left;
            word-break: break-word;
        }
        td::before {
            content: attr(data-label);
            font-weight: bold;
        }
        form input[type="text"], form select {
            width: 60%;
        }
    }
</style>

<div class="box">
    <div class="box-header">
        <b>Tampilkan Data Pegawai</b>
    </div>
    <center>
        <form action="" method="GET">
            <select name="filter">
                <option value="name" <?= (isset($_GET['filter']) && $_GET['filter'] == 'name') ? 'selected' : '' ?>>Nama Pegawai</option>
                <option value="jeniskelamin" <?= (isset($_GET['filter']) && $_GET['filter'] == 'jeniskelamin') ? 'selected' : '' ?>>Jenis Kelamin</option>
                <option value="st_pegawai" <?= (isset($_GET['filter']) && $_GET['filter'] == 'st_pegawai') ? 'selected' : '' ?>>Status Pegawai</option>
                <option value="jabatan" <?= (isset($_GET['filter']) && $_GET['filter'] == 'jabatan') ? 'selected' : '' ?>>Jabatan</option>
            </select>
            <input type="text" name="cari" placeholder="Masukkan kata kunci..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <input type="submit" value="Cari" class="btn-search">
        </form>
    </center>
</div>

<div class="box">
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 20%;">Nama Pegawai</th>
                <th style="width: 10%;">Jenis Kelamin</th>
                <th style="width: 15%;">NIP</th>
                <th style="width: 10%;">Status Pegawai</th>
                <th style="width: 20%;">Jabatan</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($_GET['cari']) && !empty($_GET['cari'])){
                $cari = mysqli_real_escape_string($conn, $_GET['cari']);
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'name';
                $allowed_filter = ['name', 'st_pegawai', 'jeniskelamin', 'jabatan']; // whitelist kolom
                if(in_array($filter, $allowed_filter)){
                    $query_get_data = "SELECT * FROM users WHERE $filter LIKE '%$cari%' ORDER BY name";
                } else {
                    $query_get_data = "SELECT * FROM users ORDER BY name";
                }
            } else {
                $query_get_data = "SELECT * FROM users ORDER BY name";
            }

            $run_query_get_data = mysqli_query($conn, $query_get_data);
            $no = 1;
            while($row = mysqli_fetch_array($run_query_get_data)):
        ?>
            <tr>
                <td data-label="No."><?= $no++ ?></td>
                <td data-label="Nama Pegawai"><?= $row['name']; ?></td>
                <td data-label="Jenis Kelamin"><?= $row['jeniskelamin']; ?></td>
                <td data-label="NIP"><?= $row['nip']; ?></td>
                <td data-label="Status Pegawai"><?= $row['st_pegawai']; ?></td>
                <td data-label="Jabatan"><?= $row['jabatan']; ?></td>
                <td data-label="Aksi">
                    <button class="btn-detail" onclick="window.location.href='detail-pegawai.php?id=<?= $row['id'] ?>'">Detail</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
    include 'layouts/footer.php';
?>
