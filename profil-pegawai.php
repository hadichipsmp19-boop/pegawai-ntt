<?php
include 'layouts/header.php';

if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    $query_check = "SELECT * FROM users WHERE id ='$id'";
    $run_query_check = mysqli_query($conn, $query_check);
    $result = mysqli_fetch_object($run_query_check);

    if (!$result) {
        header("Location: users.php");
        exit;
    }
}

$MAX_SIZE = 1048576; // 1MB

// ========== Fungsi Validasi ==========
function cekUkuranFile($file_size, $max_size) {
    if ($file_size > $max_size) {
        showError("Ukuran file melebihi 1MB! Silakan unggah file yang lebih kecil.");
        return false;
    }
    return true;
}

function validasiPDF($file_name, $tmp_path) {
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if ($ext !== 'pdf') {
        showError("Jenis file tidak sesuai! Hanya file PDF yang diperbolehkan.");
        return false;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $tmp_path);
    finfo_close($finfo);

    if ($mime !== 'application/pdf') {
        showError("Jenis file tidak sesuai! File bukan PDF yang valid.");
        return false;
    }
    return true;
}

function validasiGambar($file_name, $tmp_path) {
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg'])) {
        showError("Jenis file tidak sesuai! Hanya JPG/JPEG yang diperbolehkan.");
        return false;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $tmp_path);
    finfo_close($finfo);

    if ($mime !== 'image/jpeg') {
        showError("Jenis file tidak sesuai! File bukan gambar JPG/JPEG.");
        return false;
    }
    return true;
}

// Fungsi pesan error pop-up
function showError($msg) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            showPopup('$msg');
        });
    </script>";
}

// ========== Fungsi Upload ==========
function uploadFile($id, $field, $file, $validasiFn, $max_size) {
    global $conn;

    $direktori = "file/";
    $file_name = $file['name'];
    $file_size = $file['size'];
    $tmp_path  = $file['tmp_name'];

    if (!$validasiFn($file_name, $tmp_path)) return;
    if (!cekUkuranFile($file_size, $max_size)) return;

    $safe_name     = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file_name);
    $new_file_name = $id . "-" . $field . "-" . $safe_name;

    // hapus file lama
    $cek = mysqli_query($conn, "SELECT $field FROM users WHERE id='$id'");
    $data = mysqli_fetch_assoc($cek);
    if (!empty($data[$field])) {
        $oldfile = $direktori . $data[$field];
        if (file_exists($oldfile)) unlink($oldfile);
    }

    if (move_uploaded_file($tmp_path, $direktori . $new_file_name)) {
        mysqli_query($conn, "UPDATE users SET $field='$new_file_name' WHERE id='$id'");
        echo "<script>alert('File berhasil diperbarui!');</script>";
    } else {
        showError("Gagal mengunggah file. Silakan coba lagi.");
    }
}

// ========== Proses Upload ==========
if (isset($_POST['proses_pas_foto'])) {
    uploadFile($_POST['id'], 'pas_foto', $_FILES['NamaFile'], 'validasiGambar', $MAX_SIZE);
}
if (isset($_POST['proses_ktp'])) {
    uploadFile($_POST['id'], 'ktp', $_FILES['NamaFile'], 'validasiPDF', $MAX_SIZE);
}
if (isset($_POST['proses_dokumen'])) {
    $field = $_POST['field'];
    uploadFile($_POST['id'], $field, $_FILES['NamaFile'], 'validasiPDF', $MAX_SIZE);
}
?>

<style>
/* RESET & GLOBAL */
* { margin: 0; padding: 0; box-sizing: border-box; }

/* BOX WRAPPER */
.box { max-width: 1200px; padding: 20px; margin: 20px auto; background: #fff;
  border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
.box-header { font-size: 1.5rem; font-weight: bold; text-align: center; margin-bottom: 20px; }
.box-content { padding: 20px; }

/* TABLE STYLE */
.table-container { width: 100%; overflow-x: auto; }
.responsive-table {
  width: 100%; border-collapse: collapse; table-layout: fixed;
}
.responsive-table th, .responsive-table td {
  padding: 12px 15px; border: 1px solid #ddd; text-align: center;
  word-break: break-word; white-space: normal;
}
.responsive-table th { background: #01356d; color: white; }
.responsive-table tr:nth-child(even) { background: #f9f9f9; }

/* Kolom spesifik */
.responsive-table th:first-child, .responsive-table td:first-child { 
  text-align: left; width: 60%; 
}
.responsive-table th:nth-child(2), .responsive-table td:nth-child(2) { 
  width: 80px; text-align: center; 
}
.responsive-table th:nth-child(3), .responsive-table td:nth-child(3) { 
  width: 30%; 
}

/* FORM STYLE */
.upload-form { display: flex; flex-direction: column; gap: 8px; }
.upload-form input[type="file"] { padding: 6px; border: 1px solid #ccc; border-radius: 5px; }

/* BUTTON STYLE */
.btn-upload, .btn-view {
  padding: 6px 10px; border: none; border-radius: 5px; background: #01356d;
  color: white; cursor: pointer; transition: 0.3s; font-size: 0.85rem;
}
.btn-upload:hover, .btn-view:hover { background: orange; color: black; }

/* POPUP STYLE */
#popup-overlay {
  position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 1000;
}
#popup-box {
  background: #fff; padding: 20px; border-radius: 10px; max-width: 400px; text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
#popup-box p {
  color: red; font-weight: bold; margin-bottom: 20px;
}
#popup-box button {
  padding: 8px 15px; border: none; background: #01356d; color: #fff; border-radius: 5px; cursor: pointer;
}
#popup-box button:hover { background: orange; color: black; }

/* RESPONSIVE */
@media (max-width:768px){
  .box-content{padding:10px;}
  .responsive-table th,.responsive-table td{font-size:0.9rem;padding:10px;}
}
@media (max-width:480px){
  .box-header{font-size:1rem;}
  .btn-upload,.btn-view{font-size:0.8rem;padding:6px 8px;}
}
</style>

<!-- Popup Overlay -->
<div id="popup-overlay">
  <div id="popup-box">
    <p id="popup-msg"></p>
    <button onclick="closePopup()">Tutup</button>
  </div>
</div>

<script>
function showPopup(msg){
  document.getElementById('popup-msg').innerHTML = msg;
  document.getElementById('popup-overlay').style.display = 'flex';
}
function closePopup(){
  document.getElementById('popup-overlay').style.display = 'none';
}
</script>

<div class="box">
    <div class="box-header">
      Dokumen Pegawai - <b><?= htmlspecialchars($_SESSION['uname']) ?></b>
    </div>

    <div class="box-content">
        <div class="table-container">
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th><center>Jenis Dokumen</center></th>
                        <th>Lihat File</th>
                        <th>Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Pas Foto -->
                    <tr>
                        <td>Pas Foto Terbaru Latar Belakang Merah <i>(Max. 1MB JPG/JPEG)</i></td>
                        <td><button class="btn-view" onclick="window.open('view_pas_foto.php?id=<?= $id ?>','popup','width=800,height=600'); return false;">Lihat</button></td>
                        <td>
                            <form action="" method="POST" enctype="multipart/form-data" class="upload-form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="file" name="NamaFile" required accept=".jpg,.jpeg">
                                <button type="submit" name="proses_pas_foto" class="btn-upload">Upload</button>
                            </form>
                        </td>
                    </tr>

                    <!-- KTP -->
                    <tr>
                        <td>Scan KTP <i>(Max. 1MB PDF)</i></td>
                        <td><button class="btn-view" onclick="window.open('view_ktp.php?id=<?= $id ?>','popup','width=800,height=600'); return false;">Lihat</button></td>
                        <td>
                            <form action="" method="POST" enctype="multipart/form-data" class="upload-form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="file" name="NamaFile" required accept=".pdf">
                                <button type="submit" name="proses_ktp" class="btn-upload">Upload</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Dokumen Lainnya -->
                    <?php
                    $dokumen = [
                        "akta" => "Akta Kelahiran",
                        "kk" => "Kartu Keluarga",
                        "ijazah_sd" => "Ijazah SD",
                        "ijazah_smp" => "Ijazah SMP",
                        "ijazah_sma" => "Ijazah SMA",
                        "ijazah_pt" => "Ijazah Perguruan Tinggi",
                        "buku_tabungan" => "Buku Tabungan",
                        "npwp" => "NPWP",
                        "sk_tmt" => "SK TMT",
                        "sk_spmt" => "SK SPMT",
                        "sk_terakhir" => "SK Terakhir CPNS/PPPK"
                    ];
                    foreach ($dokumen as $field => $label) { ?>
                        <tr>
                            <td>Scan <?= $label ?> <i>(Max. 1MB PDF)</i></td>
                            <td><button class="btn-view" onclick="window.open('view_pdf.php?id=<?= $id ?>&field=<?= $field ?>','popup','width=800,height=600'); return false;">Lihat</button></td>
                            <td>
                                <form action="" method="POST" enctype="multipart/form-data" class="upload-form">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="field" value="<?= $field ?>">
                                    <input type="file" name="NamaFile" required accept=".pdf">
                                    <button type="submit" name="proses_dokumen" class="btn-upload">Upload</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
