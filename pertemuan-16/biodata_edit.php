<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

# Validasi ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('biodata_read.php');
}

# Ambil data dari database
$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_dosen WHERE id = ? LIMIT 1");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('biodata_read.php');
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('biodata_read.php');
}

# Nilai awal form
$nim = $row['nim'] ?? '';
$nama = $row['nama'] ?? '';
$alamat = $row['alamat'] ?? '';
$tgl_lahir = $row['tanggal_lahir'] ?? '';
$jabatan = $row['jabatan'] ?? '';
$prodi = $row['prodi'] ?? '';
$no_hp = $row['no_hp'] ?? '';
$pasangan = $row['pasangan'] ?? '';
$anak = $row['anak'] ?? '';
$bidang_ilmu = $row['bidang_ilmu'] ?? '';

# Ambil error dan nilai old input
$flash_error = $_SESSION['flash_error'] ?? '';
$old = $_SESSION['old_biodata'] ?? [];
unset($_SESSION['flash_error'], $_SESSION['old_biodata']);

if (!empty($old)) {
    $nama = $old['nama'] ?? $nama;
    $alamat = $old['alamat'] ?? $alamat;
    $tgl_lahir = $old['tgl_lahir'] ?? $tgl_lahir;
    $jabatan = $old['jabatan'] ?? $jabatan;
    $prodi = $old['prodi'] ?? $prodi;
    $no_hp = $old['no_hp'] ?? $no_hp;
    $pasangan = $old['pasangan'] ?? $pasangan;
    $anak = $old['anak'] ?? $anak;
    $bidang_ilmu = $old['bidang_ilmu'] ?? $bidang_ilmu;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata Dosen</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="biodata_read.php" class="back-link">← Kembali ke Data Dosen</a>
        
        <h1>Edit Biodata Dosen</h1>
        
        <?php if (!empty($flash_error)): ?>
            <div style="padding:10px; margin-bottom:10px; 
                background:#f8d7da; color:#721c24; border-radius:6px;">
                <?= $flash_error; ?>
            </div>
        <?php endif; ?>
        
        <form action="proses_biodata_update.php" method="POST">
            <input type="hidden" name="id" value="<?= (int)$id; ?>">
            
            <label for="txtNIM"><span>NIM Dosen:</span>
                <input type="text" id="txtNIM" name="txtNIM" 
                    value="<?= htmlspecialchars($nim); ?>"
                    readonly style="background-color: #e9ecef;">
            </label>

            <label for="txtNmDosen"><span>Nama Dosen:</span>
                <input type="text" id="txtNmDosen" name="txtNmDosen" 
                    value="<?= htmlspecialchars($nama); ?>"
                    placeholder="Masukkan Nama Dosen" required>
            </label>

            <label for="txtAlRmh"><span>Alamat Rumah:</span>
                <textarea id="txtAlRmh" name="txtAlRmh" rows="3"
                    placeholder="Masukkan Alamat Rumah" required><?= htmlspecialchars($alamat); ?></textarea>
            </label>

            <label for="txtTglLahir"><span>Tanggal Lahir:</span>
                <input type="date" id="txtTglLahir" name="txtTglLahir" 
                    value="<?= htmlspecialchars($tgl_lahir); ?>" required>
            </label>

            <label for="txtJabatan"><span>Jabatan:</span>
                <select id="txtJabatan" name="txtJabatan" required>
                    <option value="">Pilih Jabatan</option>
                    <option value="Asisten Ahli" <?= $jabatan == 'Asisten Ahli' ? 'selected' : '' ?>>Asisten Ahli</option>
                    <option value="Lektor" <?= $jabatan == 'Lektor' ? 'selected' : '' ?>>Lektor</option>
                    <option value="Lektor Kepala" <?= $jabatan == 'Lektor Kepala' ? 'selected' : '' ?>>Lektor Kepala</option>
                    <option value="Guru Besar" <?= $jabatan == 'Guru Besar' ? 'selected' : '' ?>>Guru Besar</option>
                </select>
            </label>

            <label for="txtProdi"><span>Homebase Prodi:</span>
                <input type="text" id="txtProdi" name="txtProdi" 
                    value="<?= htmlspecialchars($prodi); ?>"
                    placeholder="Masukkan Homebase Prodi" required>
            </label>

            <label for="txtNoHP"><span>Nomor HP:</span>
                <input type="tel" id="txtNoHP" name="txtNoHP" 
                    value="<?= htmlspecialchars($no_hp); ?>"
                    placeholder="Masukkan Nomor HP" 
                    pattern="[0-9]{10,15}" required>
            </label>

            <label for="txtPasangan"><span>Nama Pasangan:</span>
                <input type="text" id="txtPasangan" name="txtPasangan" 
                    value="<?= htmlspecialchars($pasangan); ?>"
                    placeholder="Masukkan Nama Pasangan">
            </label>

            <label for="txtAnak"><span>Nama Anak:</span>
                <textarea id="txtAnak" name="txtAnak" rows="2"
                    placeholder="Masukkan Nama Anak (pisahkan dengan koma)"><?= htmlspecialchars($anak); ?></textarea>
            </label>

            <label for="txtBidangIlmu"><span>Bidang Ilmu Dosen:</span>
                <input type="text" id="txtBidangIlmu" name="txtBidangIlmu" 
                    value="<?= htmlspecialchars($bidang_ilmu); ?>"
                    placeholder="Masukkan Bidang Ilmu Dosen" required>
            </label>

            <button type="submit">Update Data</button>
            <button type="reset">Batal</button>
        </form>
    </div>
</body>
</html>