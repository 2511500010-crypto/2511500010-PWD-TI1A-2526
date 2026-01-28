<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# Validasi ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'ID tidak valid.';
    redirect_ke('biodata_read.php');
}

# Delete dari database
$stmt = mysqli_prepare($conn, "DELETE FROM tbl_dosen WHERE id = ?");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem.';
    redirect_ke('biodata_read.php');
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_sukses'] = 'Data berhasil dihapus.';
} else {
    $_SESSION['flash_error'] = 'Data gagal dihapus.';
}

mysqli_stmt_close($stmt);
redirect_ke('biodata_read.php');
?>