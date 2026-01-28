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
</head>
<body>
    <header>
        <h1>Ini Header</h1>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
            &#9776;
        </button>
        <nav>
            <ul>
                <li><a href="index.php#home">Beranda</a></li>
                <li><a href="index.php#about">Tentang</a></li>
                <li><a href="index.php#contact">Kontak</a></li>
                <li><a href="index.php#biodata">Biodata</a></li>
                <li><a href="biodata_read.php">Data Dosen</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="biodata-edit" style="max-width: 800px; margin: 20px auto;">
            <h2>Edit Biodata Dosen</h2>
            
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
                        readonly style="background-color: #e9ecef; cursor: not-allowed;">
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
                    <input type="text" id="txtTglLahir" name="txtTglLahir" 
                        value="<?= htmlspecialchars($tgl_lahir); ?>" required>
                </label>

                <label for="txtJabatan"><span>Jabatan:</span>
                    <input type="text" id="txtJabatan" name="txtJabatan" 
                        value="<?= htmlspecialchars($jabatan); ?>"
                        placeholder="Masukkan Jabatan" required>
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
                    <input type="text" id="txtAnak" name="txtAnak" 
                        value="<?= htmlspecialchars($anak); ?>"
                        placeholder="Masukkan Nama Anak (pisahkan dengan koma)">
                </label>

                <label for="txtBidangIlmu"><span>Bidang Ilmu Dosen:</span>
                    <input type="text" id="txtBidangIlmu" name="txtBidangIlmu" 
                        value="<?= htmlspecialchars($bidang_ilmu); ?>"
                        placeholder="Masukkan Bidang Ilmu Dosen" required>
                </label>

                <div style="margin-top: 20px;">
                    <button type="submit" style="background-color: #003366; color: white; padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; margin-right: 10px;">
                        Update Data
                    </button>
                    <button type="reset" style="background-color: #b4b4b4; color: #272727; padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; margin-right: 10px;">
                        Batal
                    </button>
                    <a href="biodata_read.php" style="display: inline-block; padding: 10px 24px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px;">
                        Kembali ke Data Dosen
                    </a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>