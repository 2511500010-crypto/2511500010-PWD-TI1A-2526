<?php
session_start();
require_once __DIR__ . '/fungsi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Judul Halaman</title>
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
        <li><a href="#home">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>

    <section id="biodata">
      <h2>Biodata Dosen</h2>
      <form action="proses_biodata.php" method="POST">

          <label for="txtNIM"><span>NIM Dosen:</span>
      <input type="text" id="txtNIM" name="txtNIM" 
        placeholder="Masukkan NIM Dosen" required 
        pattern="[A-Za-z0-9]{6,20}"
        title="NIM minimal 6 karakter, maksimal 20 karakter">
    </label>

    <label for="txtNmDosen"><span>Nama Dosen:</span>
      <input type="text" id="txtNmDosen" name="txtNmDosen" 
        placeholder="Masukkan Nama Dosen" required>
    </label>

    <label for="txtAlRmh"><span>Alamat Rumah:</span>
      <textarea id="txtAlRmh" name="txtAlRmh" rows="3"
        placeholder="Masukkan Alamat Rumah" required></textarea>
    </label>

    <label for="txtTglLahir"><span>Tanggal Lahir:</span>
      <input type="text" id="txtTglLahir" name="txtTglLahir" placeholder="Masukkan tanggal lahir" required>
    </label>

    <label for="txtJabatan"><span>Jabatan:</span>
      <input type="text" id="txtJabatan" name="txtJabatan" 
        placeholder="Masukkan Jabatan" required
        value="<?= isset($old_biodata['jabatan']) ? htmlspecialchars($old_biodata['jabatan']) : '' ?>">
    </label>

    <label for="txtProdi"><span>Homebase Prodi:</span>
      <input type="text" id="txtProdi" name="txtProdi" 
        placeholder="Masukkan Homebase Prodi" required>
    </label>

    <label for="txtNoHP"><span>Nomor HP:</span>
      <input type="tel" id="txtNoHP" name="txtNoHP" 
        placeholder="Masukkan Nomor HP" 
        pattern="[0-9]{10,15}" required>
    </label>

    <label for="txtPasangan"><span>Nama Pasangan:</span>
      <input type="text" id="txtPasangan" name="txtPasangan" 
        placeholder="Masukkan Nama Pasangan">
    </label>

    <label for="txtAnak"><span>Nama Anak:</span>
      <textarea id="txtAnak" name="txtAnak" rows="2"
        placeholder="Masukkan Nama Anak (pisahkan dengan koma)"></textarea>
    </label>

    <label for="txtBidangIlmu"><span>Bidang Ilmu Dosen:</span>
      <input type="text" id="txtBidangIlmu" name="txtBidangIlmu" 
        placeholder="Masukkan Bidang Ilmu Dosen" required>
    </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>

    <?php
    $biodata = $_SESSION["biodata"] ?? [];

    $fieldConfig = [
      "kodedos" => ["label" => "Kode Dosen:", "suffix" => ""],
      "nama" => ["label" => "Nama Dosen:", "suffix" => " &#128526;"],
      "alamat" => ["label" => "Alamat Rumah:", "suffix" => ""],
      "tanggal" => ["label" => "Tanggal Jadi Dosen:", "suffix" => ""],
      "jja" => ["label" => "JJA Dosen:", "suffix" => " &#127926;"],
      "prodi" => ["label" => "Homebase Prodi:", "suffix" => " &hearts;"],
      "nohp" => ["label" => "Nomor HP:", "suffix" => " &copy; 2025"],
      "pasangan" => ["label" => "Nama Pasangan:", "suffix" => ""],
      "anak" => ["label" => "Nama Anak:", "suffix" => ""],
      "ilmu" => ["label" => "Bidang Ilmu Dosen:", "suffix" => ""],
    ];
    ?>

    <section id="about">
      <h2>Tentang Saya</h2>
      <?= tampilkanBiodata($fieldConfig, $biodata) ?>
    </section>

    <?php
    $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
    $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
    $old          = $_SESSION['old'] ?? []; #untuk nilai lama form

    unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']); #bersihkan 3 session ini
    ?>

    <section id="contact">
      <h2>Kontak Kami</h2>

      <?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
      <?php endif; ?>

      <form action="proses.php" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama"
            required autocomplete="name"
            value="<?= isset($old['nama']) ? htmlspecialchars($old['nama']) : '' ?>">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email"
            required autocomplete="email"
            value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..."
            required><?= isset($old['pesan']) ? htmlspecialchars($old['pesan']) : '' ?></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>

        <label for="txtCaptcha"><span>Captcha 2 + 3 = ?</span>
          <input type="number" id="txtCaptcha" name="txtCaptcha" placeholder="Jawab Pertanyaan..."
            required
            value="<?= isset($old['captcha']) ? htmlspecialchars($old['captcha']) : '' ?>">
        </label>

        <button type=" submit">Kirim</button>
          <button type="reset">Batal</button>
      </form>

      <br>
      <hr>
      <h2>Yang menghubungi kami</h2>
      <?php include 'read_inc.php'; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>