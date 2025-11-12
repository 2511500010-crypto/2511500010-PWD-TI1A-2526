<?php
session_start();

$nim        = $_SESSION["nim"]        ?? "";
$nama       = $_SESSION["nama"]       ?? "";
$tempat     = $_SESSION["tempat"]     ?? "";
$tgl_lahir  = $_SESSION["tgl_lahir"]  ?? "";
$hobi       = $_SESSION["hobi"]       ?? "";
$pasangan   = $_SESSION["pasangan"]   ?? "";
$pekerjaan  = $_SESSION["pekerjaan"]  ?? "";
$ortu       = $_SESSION["ortu"]       ?? "";
$kakak      = $_SESSION["kakak"]      ?? "";
$adik       = $_SESSION["adik"]       ?? "";

$sesnama  = $_SESSION["sesnama"]  ?? "";
$sesemail = $_SESSION["sesemail"] ?? "";
$sespesan = $_SESSION["sespesan"] ?? "";
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
        <li><a href="#pendaftaran">Pendaftaran profil Pengunjung</a></li>
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

    <section id="pendaftaran"> 
      <h2> Silahkan tulis form di bawah ini</h2>
      <form action="proses.php" method="POST">
<label><span>NIM:</span>
          <input type="text" name="nim" placeholder="Masukkan NIM" value="<?= $nim ?>" required>
        </label>

        <label><span>Nama Lengkap:</span>
          <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="<?= $nama ?>" required>
        </label>

        <label><span>Tempat Lahir:</span>
          <input type="text" name="tempat" placeholder="Masukkan tempat lahir" value="<?= $tempat ?>" required>
        </label>

<label><span>Tanggal Lahir:</span>
          <input type="text" name="tgl_lahir" placeholder="Masukkan tanggal lahir" value="<?= $tgl_lahir ?>" required>
        </label>

        <label><span>Hobi:</span>
          <input type="text" name="hobi" placeholder="Masukkan hobi" value="<?= $hobi ?>">
        </label>

        <label><span>Pasangan:</span>
          <input type="text" name="pasangan" placeholder="Masukkan nama pasangan" value="<?= $pasangan ?>">
        </label>


        <label><span>Pekerjaan:</span>
          <input type="text" name="pekerjaan" placeholder="Masukkan pekerjaan" value="<?= $pekerjaan ?>">
        </label>

        <label><span>Nama Orang Tua:</span>
          <input type="text" name="ortu" placeholder="Masukkan nama orang tua" value="<?= $ortu ?>">
        </label>

        <label><span>Nama Kakak:</span>
          <input type="text" name="kakak" placeholder="Masukkan nama kakak" value="<?= $kakak ?>">
        </label>

        <label><span>Nama Adik:</span>
          <input type="text" name="adik" placeholder="Masukkan nama adik" value="<?= $adik ?>">


        <div class="button-container">
          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
        </div>

      </form>
        </label>
    </section>

    <section id="about">
      <?php
      $nim =  "";
      $NIM = '0344300002';
      $nama = "Say'yid Abdullah";
      $Nama = 'Al\'kautar Benyamin';
      $tempat = "Jebus";
      ?>
      <h2>Tentang Saya</h2>
      <?php if (!empty($nim)): ?>
        <p><strong>NIM:</strong> <?php echo $sesNim ?></p>
        <p><strong>Nama Lengkap:</strong> <?= $Nama ?> 😎</p>
        <p><strong>Tempat Lahir:</strong> <?= $Tempat ?></p>
        <p><strong>Tanggal Lahir:</strong> <?= $Tanggal ?></p>
        <p><strong>Hobi:</strong> <?= $Hobi ?></p>
        <p><strong>Pasangan:</strong> <?= $Pasangan ?></p>
        <p><strong>Pekerjaan:</strong> <?= $Pekerjaan ?></p>
        <p><strong>Nama Orang Tua:</strong> <?= $Ortu ?></p>
        <p><strong>Nama Kakak:</strong> <?= $Kakak ?></p>
        <p><strong>Nama Adik:</strong> <?= $Adik ?></p>
      <?php else: ?>
        <p>Belum ada data pengunjung. Silakan isi form di atas 👆</p>
      <?php endif; ?>

    </section>

    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>

      <?php if (!empty($sesnama)): ?>
        <br><hr>
        <h2>Yang menghubungi kami</h2>
        <p><strong>Nama :</strong> <?php echo $sesnama ?></p>
        <p><strong>Email :</strong> <?php echo $sesemail ?></p>
        <p><strong>Pesan :</strong> <?php echo $sespesan ?></p>
      <?php endif; ?>



    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>