<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# Cek method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('biodata_read.php');
}

# Validasi ID
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'ID tidak valid.';
    redirect_ke('biodata_read.php');
}

# Ambil dan bersihkan data
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

if (strlen($nama) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

if (strlen($alamat) < 10) {
    $errors[] = 'Alamat minimal 10 karakter.';
}

if (empty($tgl_lahir)) {
    $errors[] = 'Tanggal lahir wajib diisi.';
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

# Jika ada error
if (!empty($errors)) {
    $_SESSION['old_biodata'] = [
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
    redirect_ke('biodata_edit.php?id=' . $id);
}

# Update database
$sql = "UPDATE tbl_dosen 
        SET nama = ?, alamat = ?, tanggal_lahir = ?, jabatan = ?, 
            prodi = ?, no_hp = ?, pasangan = ?, anak = ?, bidang_ilmu = ?,
            updated_at = NOW()
        WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem.';
    redirect_ke('biodata_edit.php?id=' . $id);
}

mysqli_stmt_bind_param($stmt, "sssssssssi", 
    $nama, $alamat, $tgl_lahir, $jabatan, $prodi, 
    $no_hp, $pasangan, $anak, $bidang_ilmu, $id);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old_biodata']);
    $_SESSION['flash_sukses'] = 'Data biodata dosen berhasil diupdate.';
    redirect_ke('biodata_read.php');
} else {
    $_SESSION['flash_error'] = 'Data gagal diupdate: ' . mysqli_error($conn);
    redirect_ke('biodata_edit.php?id=' . $id);
}

mysqli_stmt_close($stmt);
?>