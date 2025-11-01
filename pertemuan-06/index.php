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
                echo "perkenalkan nama saya Muhammad Miftah Alqois"
            ?>
            <p>Ini contoh paragraf HTML</p>
        </section>

        <section id="about">
            <?php
                $nim = 2511500010;
                $NIM = 2511500020;
                $Nim = "";
                $nama = "Muhammad Miftah Alqois";
                $Nama = "Miftah Alqois";
            ?>
            <h2>Tentang saya</h2>
            <p><strong>NIM</strong> 
                <?php
                echo $nim;
                ?>
        </p>
            <p><strong>Nama Lengkap</strong> Muhammad MIftah Alqois &#128526</p>
            <p><strong>Tempat lahir</strong> Sungailiat</p>
            <p><strong>tanggal lahir</strong> 23 MEI 2007</p>
            <p><strong>hobi</strong> coding,bermain game,bermain musik &#127926,memancing</p>
            <p><strong>pasangan</strong> Pacar : Cilla</p>
            <p><strong>pekerjaan</strong> Mahasiswa ISB Atma Luhur Pangkalpinang &copy; 2025</p>
            <p><strong>Nama Orang tua</strong> Bapak Eddy Sastra dan Ibu Henny Afrida</p>
            <p><strong>Nama Kakak</strong> Tidak ada</p>
            <p><strong>Nama adek</strong> Tidak Ada</p>
        </section>

        <section id="contact">
            <h2>Kontak Kami</h2>
            <form action="" method="get">
                <label for="txtNama"><span>Nama:</span>
                    <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required
                        autocomplete="name">
                </label>

                <label for="txtEmail"><span>Email:</span>
                    <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required
                        autocomplete="email">
                </label>

                <label for="txtPesan"><span>Pesan:</span>
                    <textarea name="txtPesan" id="txtPesan" rows="4" placeholder="Tulis pesan anda..."
                        required></textarea>
                    <small id="charCount">0/200 karakter</small>
                </label>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 MUHAMMAD MIFTAH ALQOIS (251150010)</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>