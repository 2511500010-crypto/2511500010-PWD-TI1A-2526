<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# Cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#biodata');
}

# Ambil dan bersihkan nilai dari form
$nim = bersihkan($_POST['txtNIM'] ?? '');
$nama = bersihkan($_POST['txtNmDosen'] ?? '');
$alamat = bersihkan($_POST['txtAlRmh'] ?? '');
$tgl_lahir = bersihkan($_POST['txtTglLahir'] ?? '');
$jabatan = bersihkan($_POST['txtJabatan'] ?? '');
$prodi = bersihkan($_POST['txtProdi'] ?? '');
$no_hp = bersihkan($_POST['txtNoHP'] ?? '');
$pasangan = bersihkan($_POST['txtPasangan'] ?? '');
$anak = bersihkan($_POST['txtAnak'] ?? '');
$bidang_ilmu = bersihkan($_POST['txtBidangIlmu'] ?? '');

# Validasi
$errors = [];

if (!preg_match('/^[A-Za-z0-9]{6,20}$/', $nim)) {
    $errors[] = 'NIM harus 6-20 karakter alfanumerik.';
}

if (strlen($nama) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

if (strlen($alamat) < 10) {
    $errors[] = 'Alamat minimal 10 karakter.';
}

if (empty($tgl_lahir)) {
    $errors[] = 'Tanggal lahir wajib diisi.';
} elseif (strtotime($tgl_lahir) > strtotime('2000-01-01')) {
    $errors[] = 'Tanggal lahir tidak valid (minimal tahun 2000).';
}

if (empty($jabatan)) {
    $errors[] = 'Jabatan wajib dipilih.';
}

if (strlen($prodi) < 3) {
    $errors[] = 'Prodi minimal 3 karakter.';
}

if (!preg_match('/^[0-9]{10,15}$/', $no_hp)) {
    $errors[] = 'Nomor HP harus 10-15 digit angka.';
}

if (strlen($bidang_ilmu) < 3) {
    $errors[] = 'Bidang ilmu minimal 3 karakter.';
}

# Cek apakah NIM sudah ada
$stmt_check = mysqli_prepare($conn, "SELECT id FROM tbl_dosen WHERE nim = ?");
mysqli_stmt_bind_param($stmt_check, "s", $nim);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

if (mysqli_stmt_num_rows($stmt_check) > 0) {
    $errors[] = 'NIM sudah terdaftar.';
}
mysqli_stmt_close($stmt_check);

# Jika ada error, simpan nilai lama dan redirect
if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
        'nim' => $nim,
        'nama' => $nama,
        'alamat' => $alamat,
        'tgl_lahir' => $tgl_lahir,
        'jabatan' => $jabatan,
        'prodi' => $prodi,
        'no_hp' => $no_hp,
        'pasangan' => $pasangan,
        'anak' => $anak,
        'bidang_ilmu' => $bidang_ilmu
    ];
    
    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('index.php#biodata');
}

# Insert ke database
$sql = "INSERT INTO tbl_dosen 
        (nim, nama, alamat, tanggal_lahir, jabatan, prodi, no_hp, pasangan, anak, bidang_ilmu) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('index.php#biodata');
}

mysqli_stmt_bind_param($stmt, "ssssssssss", 
    $nim, $nama, $alamat, $tgl_lahir, $jabatan, $prodi, 
    $no_hp, $pasangan, $anak, $bidang_ilmu);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_sukses'] = 'Data biodata dosen berhasil disimpan.';
    redirect_ke('biodata_read.php');
} else {
    $_SESSION['flash_error'] = 'Data gagal disimpan: ' . mysqli_error($conn);
    redirect_ke('index.php#biodata');
}

mysqli_stmt_close($stmt);
?>