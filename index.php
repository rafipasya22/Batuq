<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Selamat Datang Ke BATUQ!</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
     <header>
        <h2 class="logo">BATUQ</h2>
        <ul class="navbar">
            <li><a href="#materr">Materi</a></li>
            <li><a href="./Dashboard/Latihan_Soal.php">Latihan Soal</a></li>
            <li><a href="./Dashboard/Baca_Quran.php">Baca Qur'an</a></li>
            <li><a href="#about">Tentang Kami</a></li>
        </ul>
        <div class="header-icon">
            <a href="./Login_Signup/Login.php"><i class='bx bxs-user-circle' id="Profile"></i></a>
        </div>
     </header>

     <main class="content">
       <section class="home">
        <div class="home-text">
            <h6>Selamat Datang di BATUQ, Pusat Pembelajaran Al-Quran Online Anda!</h6>
            <h1>Sumber Belajar Qur'an yang Dapat Diakses Kapan saja, Dimana saja</h1>
            <p>Mulailah Perjalanan Anda Bersama Kami!</p>
            <div class="latter">
                <a href="./Login_Signup/Login.php" class="button">Get Started</a>
            </div>
         </div>
         <div class="homeimg">
            <img src="obj/Aldenaire__2_-removebg-preview.png" alt="">
         </div>
       </section>
       
       <section class="container">
        <div class="container-box">
            <div class="container-img">
                <i class='bx bx-book-reader'></i>
            </div>
            <div class="container-text">
                <h4>30</h4>
                <p>Materi Interaktif</p>
            </div>
        </div>
        <div class="container-box">
            <div class="container-img">
                <i class='bx bx-book-reader'></i>
            </div>
            <div class="container-text">
                <h4>30</h4>
                <p>Latihan Soal</p>
            </div>
        </div>
        <div class="container-box">
            <div class="container-img">
                <i class='bx bx-book-reader'></i>
            </div>
            <div class="container-text">
                <h4>114</h4>
                <p>Surah Ayat Suci Al-Qur'an</p>
            </div>
        </div>
       </section>
       <section class="categories" id="categories">
        <div class="center-text" id="materr">
            <h5>KATEGORI</h5>
            <h2>Bahan Ajar Kami</h2>
        </div>
        <div class="categories-content">
            <div class="box">
                <img src="obj/Aldenaire__4_-removebg-preview.png" alt="#" id="Tajwid">
                <h3>Tajwid</h3>
                <p>5 Courses</p>
            </div>
            <div class="box">
                <img src="obj/Aldenaire__4_-removebg-preview.png" alt="#" id="Hijaiyah">
                <h3>Qiraah</h3>
                <p>5 Courses</p>
            </div>
            <div class="box">
                <img src="obj/Aldenaire__4_-removebg-preview.png" alt="#">
                <h3>I'rab</h3>
                <p>5 Courses</p>
            </div>
        </div>

        <div class="main-btn">
            <a href="./Dashboard/Materi.php" class="btn">Mulai Belajar!</a>
        </div>
       </section>

       <section class="courses" id="tenaga">
        <div class="center-text">
            <h5>Tenaga Ajar</h5>
            <h2>Tenaga Ajar Kami!</h2>
        </div>
        <div class="body2">
          <section class="containers">
            <div class="testicard">
              <div class="image">
                <img src="../Dashboard/obj/def.jpg">
              </div>
              <h2>Rangga AM</h2>
             
            </div>
            <div class="testicard">
              <div class="image">
              <img src="../Dashboard/obj/def.jpg">
              </div>
              <h2>Salsabilla Nida</h2>
            </div>
            <div class="testicard">
              <div class="image">
              <img src="../Dashboard/obj/def.jpg">
              </div>
              <h2>Rafi Pasya</h2>
              
            </div>
         </section>
         </div>
       </section>
       
       <section class="about" id="about">
        <div class="about-img">
            <img src="./obj/Muslim-man-Reading-the-quran-on-transparent-background-PNG.png" alt="">
        </div>
        <div class="about-text" > 
            <div class="center-text">
                <h5>About Us</h5>
                <h2>Tentang Kami</h2>
            </div>
         <section class="about_1">
            <h2>Misi Kami</h2>
                <p>
                    Misi kami adalah untuk menginspirasi dan memotivasi umat Islam di seluruh dunia untuk meningkatkan kualitas bacaan Al-Quran mereka dan memperkaya pengertian mereka tentang keindahan Islam. 
                    Kami berusaha untuk menciptakan lingkungan belajar yang inklusif, mendukung, dan memotivasi, yang mendorong pertumbuhan spiritual dan intelektual.
                </p>
         </section>
         <section class="about_2">
            <h2>Apa yang Kami Tawarkan?</h2>
            <ul>
                <li><span class="titleabout">Kelas Tajwid:</span> Dari pemula hingga lanjutan, pelajari tajwid dengan metode yang mudah dipahami.</li>
                <li><span class="titleabout">Pembelajaran Hafalan:</span> Program terstruktur untuk membantu Anda menghafal Al-Quran dengan efektif.</li>
                <li><span class="titleabout">Terjemahan dan Tafsir:</span> Tingkatkan pemahaman Anda tentang ayat-ayat Al-Quran dengan kelas terjemahan dan tafsir kami.</li>
                <li><span class="titleabout">Kelas Interaktif:</span> Sesi langsung dan interaktif dengan pengajar untuk feedback dan bimbingan personal.</li>   
                <li><span class="titleabout">Komunitas Pembelajar:</span> Bergabung dengan komunitas belajar kami untuk mendapatkan motivasi dan dukungan.</li>    
            </ul>
         </section>
        </div>
       </section>
       <section class="contact">
        <div class="main-contact">
            <div class="contact-content">
                <img src="obj/Aldenaire__5_-removebg-preview.png" alt="">
                <li><a href="#">Jl. Pendidikan No.15, Cibiru Wetan, <br>Kec. Cileunyi, Kabupaten Bandung, <br>Jawa Barat 40625</a></li>
                <li><a href="#">batuq_team@gmail.com</a></li>
                <li><a href="#">+62 8893728192</a></li>
            </div>
            <div class="contact-content">
                <li><a href="#materr">Materi</a></li>
                <li><a href="./Dashboard/Latihan_Soal.php">Latihan Soal</a></li>
                <li><a href="./Dashboard/Baca_Quran.php">Baca Qur'an</a></li>
                <li><a href="#tenaga">Tenaga Ajar Kami</a></li>
                <li><a href="#about">Tentang Kami</a></li>
            </div>
            <div class="contact-content">
                <li><a href="./Login_Signup/Login.php">Login</a></li>
                <li><a href="./Login_Signup/Login.php">Sign Up</a></li>
            </div>
        </div>
       </section>
     </main>


     <footer>
       
    </footer>

    <script type="text/javascript" src="js/script.js"></script>
    </body>
    
</html>