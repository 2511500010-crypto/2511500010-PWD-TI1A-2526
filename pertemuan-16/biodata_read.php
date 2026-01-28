<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

$sql = "SELECT * FROM tbl_dosen ORDER BY id DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
    die("Query error: " . mysqli_error($conn));
}

$flash_sukses = $_SESSION['flash_sukses'] ?? '';
$flash_error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_sukses'], $_SESSION['flash_error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Biodata Dosen</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 1400px; /* Diperbesar untuk menampung lebih banyak kolom */
            margin: 0 auto;
            padding: 20px;
        }
        .action-buttons {
            margin-bottom: 20px;
        }
        .action-buttons a {
            display: inline-block;
            padding: 10px 20px;
            background: #003366;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .action-buttons a:hover {
            background: #0379ee;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px; /* Ukuran font lebih kecil */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: top; /* Untuk konten multi-line */
        }
        th {
            background-color: #003366;
            color: white;
            position: sticky;
            top: 0;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .actions a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
        .edit-btn {
            background: #28a745;
            color: white;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
        }
        .edit-btn:hover {
            background: #218838;
        }
        .delete-btn:hover {
            background: #c82333;
        }
        /* Kolom dengan konten panjang */
        .alamat-cell, .anak-cell {
            max-width: 200px;
            white-space: normal;
            word-wrap: break-word;
        }
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        /* Scroll horizontal untuk table */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Biodata Dosen</h1>
        
        <?php if (!empty($flash_sukses)): ?>
            <div class="alert success">
                <?= $flash_sukses; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($flash_error)): ?>
            <div class="alert error">
                <?= $flash_error; ?>
            </div>
        <?php endif; ?>
        
        <div class="action-buttons">
            <a href="index.php#biodata">Tambah Data Baru</a>
            <a href="index.php">Kembali ke Beranda</a>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>NIM</th>
                        <th>Nama Dosen</th>
                        <th>Alamat Rumah</th>
                        <th>Tanggal Lahir</th>
                        <th>Jabatan</th>
                        <th>Prodi</th>
                        <th>No HP</th>
                        <th>Pasangan</th>
                        <th>Anak</th>
                        <th>Bidang Ilmu</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($q)): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td class="actions">
                            <a href="biodata_edit.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>
                            <a href="biodata_delete.php?id=<?= $row['id']; ?>" 
                                class="delete-btn" 
                                onclick="return confirm('Hapus data <?= htmlspecialchars($row['nama']); ?>?')">Delete</a>
                        </td>
                        <td><?= htmlspecialchars($row['nim']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="alamat-cell"><?= nl2br(htmlspecialchars($row['alamat'])); ?></td>
                        <td><?= !empty($row['tanggal_lahir']) ? date('d/m/Y', strtotime($row['tanggal_lahir'])) : '-'; ?></td>
                        <td><?= htmlspecialchars($row['jabatan']); ?></td>
                        <td><?= htmlspecialchars($row['prodi']); ?></td>
                        <td><?= htmlspecialchars($row['no_hp']); ?></td>
                        <td><?= !empty($row['pasangan']) ? htmlspecialchars($row['pasangan']) : '-'; ?></td>
                        <td class="anak-cell"><?= !empty($row['anak']) ? nl2br(htmlspecialchars($row['anak'])) : '-'; ?></td>
                        <td><?= htmlspecialchars($row['bidang_ilmu']); ?></td>
                        <td><?= formatTanggal($row['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <?php if (mysqli_num_rows($q) == 0): ?>
            <p style="text-align: center; padding: 20px; color: #666;">
                Belum ada data biodata dosen.
            </p>
        <?php endif; ?>
    </div>
</body>
</html>