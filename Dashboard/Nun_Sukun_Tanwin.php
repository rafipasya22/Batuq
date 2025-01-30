<?php

@include '../config.php';
session_start();

if(isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email']; 
} else {
    header("Location: Edit.php?error=Email is not set in the session");

}

if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $carijudul = "SELECT judul_materi FROM jumlah_materi WHERE judul_materi = '$judul' && Email = '$Email' && tanggal_baca = CURRENT_DATE";
    $hasilcarijudul = mysqli_query($conn, $carijudul);
    if(mysqli_num_rows($hasilcarijudul)>0){
        $stmt = mysqli_query($conn,"UPDATE jumlah_materi SET bacaan_count = bacaan_count + 1 WHERE judul_materi = '$judul' && Email = '$Email' && tanggal_baca = CURRENT_DATE");
    }else{
        $stmt = mysqli_query($conn,"INSERT INTO jumlah_materi (judul_materi, bacaan_count, Email, tanggal_baca) VALUES ('$judul', 1, '$Email', CURRENT_DATE)");
    }
    
}

?>
<script>
    var judul2 = "Hukum Nun Sukun dan Tanwin";
    function sendData() {
            var judul = "Hukum Nun Sukun dan Tanwin";

            // Membuat objek XMLHttpRequest
            var xhttp = new XMLHttpRequest();
            
            // Menetapkan fungsi callback untuk menangani respons
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Menampilkan respons dari server
                    document.getElementById("response").innerHTML = this.responseText;
                }
            };
            
            // Menyiapkan permintaan POST
            xhttp.open("POST", "Nun_Sukun_Tanwin.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Mengirim data ke server
            xhttp.send("judul=" + encodeURIComponent(judul));
        }
        
    window.onload = function(){
        sendData();
        const namajudul = localStorage.setItem('judul', judul2);
    };
    
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/Nun_Sukun_Tanwin.css"/>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <h1>BATU<span>Q</span></h1>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="../Dashboard/Home.php" class="link">
                    <span class="material-symbols-outlined">
                        Home
                        </span>
                    <h3>Home</h3>
                </a>
                <a href="../Dashboard/Materi.php" class="link active">
                    <span class="material-symbols-outlined">
                        menu_book
                        </span>
                    <h3>Materi</h3>
                </a>
                <a href="../Dashboard/Latihan_Soal.php" class="link">
                    <span class="material-symbols-outlined">
                        quiz
                        </span>
                    <h3>Latihan Soal</h3>
                </a>
                <a href="../Dashboard/Reports.php" class="link">
                    <span class="material-symbols-outlined">
                        lab_profile
                        </span>
                    <h3>Reports</h3>
                </a>
                <a href="../Dashboard/Baca_Quran.php" class="link">
                    <span class="material-symbols-outlined">
                        book
                        </span>
                    <h3>Baca Quran</h3>
                </a>
            </div>
        </aside>

        <main>
            <div class="header-main">
                <h1>
                    Materi
                </h1>
                <div class="right">
                    <div class="top">
                        <button id="menu-btn">
                            <span class="material-symbols-outlined">
                                menu
                                </span>
                        </button>
                        <div class="theme-toggler">
                            <span class="material-symbols-outlined active">
                                light_mode
                            </span>
                            <span class="material-symbols-outlined">
                                    dark_mode
                            </span>
                        </div>
                        <div class="profile">
                            <div class="info">
                                <p>Hey, <b><?php echo $_SESSION['NamaDepan']?></b></p>
                                <small class="text-muted">Admin</small>
                            </div>
                            <a href="#" class="profile-photo" id="drop-btn">
                            <?php
                                    $carifoto = "SELECT Foto_Profil FROM akun_batuq WHERE Nama_Depan = '$_SESSION[NamaDepan]'";
                                    $fotoprofil = mysqli_query($conn, $carifoto);
                                    if(mysqli_num_rows($fotoprofil)>0){
                                        while ($akun_batuq = mysqli_fetch_assoc($fotoprofil)){
                                            if($akun_batuq['Foto_Profil'] !== NULL){?>
                                              <img src="./uploads/<?=$akun_batuq['Foto_Profil']?>">
                                            <?php  
                                            }else{?>
                                              <img src="obj/def.jpg">  
                                            <?php 
                                            }
                                        }
                                    }else{
                                        ?>
                                        <img src="obj/def.jpg">
                                        <?php 
                                    }
                                    ?>
                            </a>
                            <div class="sub-menu-wrap" id="sub-menu-wrap">
                                <div class="sub-menu">
                                    <div class="user-infoo">
                                    <?php
                                    $carifoto = "SELECT Foto_Profil FROM akun_batuq WHERE Nama_Depan = '$_SESSION[NamaDepan]'";
                                    $fotoprofil = mysqli_query($conn, $carifoto);
                                    if(mysqli_num_rows($fotoprofil)>0){
                                        while ($akun_batuq = mysqli_fetch_assoc($fotoprofil)){
                                            if($akun_batuq['Foto_Profil'] !== NULL){?>
                                              <img src="./uploads/<?=$akun_batuq['Foto_Profil']?>">
                                            <?php  
                                            }else{?>
                                              <img src="obj/def.jpg">  
                                            <?php 
                                            }
                                        }
                                    }else{
                                        ?>
                                        <img src="obj/def.jpg">
                                        <?php 
                                    }
                                    ?>
                                        <div class="close" id="close-btn2">
                                            <span class="material-symbols-outlined">close</span>
                                        </div>
                                        <div class="info">
                                            <h1><?php echo $_SESSION['NamaDepan']?> <?php echo $_SESSION['NamaBelakang']?></h1>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    </div>
                                    <hr>
                                    <a href="../Dashboard/Edit.php" class="sub-menu-link">
                                        <span class="material-symbols-outlined active">
                                            person
                                        </span> 
                                        <p>Edit Profile</p>
                                    </a>
                                    
                                    <a href="../Logout.php" id="Logout" class="sub-menu-link">
                                        <span class="material-symbols-outlined active">
                                            logout
                                        </span> 
                                        <p>Logout</p>
                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         <div class="content">
                <div class="main-content">
                    <div class="isi">
                        <div class="middle">
                            <div class="left">
                                <h1 id = "judul">
                                    Hukum Nun Sukun dan Tanwin
                                </h1>
                                <h3>Dalam membaca Al-Qur’an sudah diatur tata cara membacanya, mana yang dibaca pendek, panjang, tebal, atau halus ucapannya. Ilmu yang mempelajari bagaimana tata cara membaca Al-Qur’an dengan benar yaitu ilmu tajwid. 
                                    Mempelajari ilmu tajwid untuk diterapkan dalam membaca Al-Qur’an adalah wajib, agar bacaan kita benar sesuai dengan ajaran Rasulullah SAW dan terhindar dari kesalahan pada bacaan yang menimbulkan perbedaan arti semestinya.
                                    Salah satu hukum dalam ilmu tajwid adalah hukum nun sukun dan tanwin. 
                                </h3>
                                <h3>Hukum nun sukun dan tanwin (  ـَــًـ , ـِــٍـ , ـُــٌـ ) adalah salah satu tajwid yang terdapat dalam Qur’an. 
                                    Hukum ini berlaku jika nun sukun atau tanwin bertemu huruf-huruf hijaiyah tertentu. 
                                    Pembagian hukum bacaan nun sukun dan tanwin yang bertemu huruf hijaiyah dibagi menjadi lima yaitu: 
                                </h3>
                                <h2>Izhar halqi</h2>
                                <h3>Izhar mempunyai makna terang atau jelas. 
                                    Disebut izhar halqi karena makhraj dari huruf-huruf izhar halqi keluar (diucapkan) dari dalam tenggorakan (halq). Hukum bacaan ini berlaku jika ada nun sukun atau tanwin yang bertemu dengan salah satu dari huruf izhar:

                                    . ا، ه،ع، غ، ح، خ
                                    
                                    Cara membaca izhar halqi adalah jelas, tanpa dengung. Misalnya bacaan كُفُوًااَحَدٌ maka huruf wau dengan harakat fathah tanwin tidak boleh dibaca dengung. kufuwan ahad
                                </h3>
                                <h2>Idgham</h2>
                                <h3>Idgham adalah salah satu hukum dalam ilmu tajwid yang berupa berpadu atau bercampurnya antara dua buah huruf atau memasukkannya satu huruf ke dalam huruf yang lainnya. Jika ada nun sukun atau tanwin yang bertemu dengan huruf idgham, maka cara membacanya harus melebur. Idham dibagi menjadi dua yaitu idgham bighunnah dan idgham bilaghunnah.

                                    Idgham Bighunnah adalah idgham yang dibaca dengan secara dengung atau ghunnah. Hal ini terjadi jika nun sukun atau tanwin bertemu dengan salah satu dari empat huruf hijaiyah sebagai berikut ini, yakni  ي-ن-م-و.
                                    
                                    Contohnya:لَهَبٍ وَتَبَّ . Maka huruf wau (و)  harus dibaca melebur dengan huruf sebelumnya. Lahabiw watab.
                                    
                                    Idgham Bilaghunnah atau bighairi ghunnah adalah idgham yang dibaca tanpa dengung. Hal ini terjadi jika nun sukun atau tanwin bertemu dengan dua huruf hijaiyah berikut ini ل dan ر. Contohnya: وَلَمْ يَكُن لَّهُ . Harus dibaca walam yakul lahu.</h3>
                                <h2>Ikhfa’ haqiqi</h2>
                                <h3>Secara bahasa, ikhfa’ berarti samar. Jika ada nun sukun atau tanwin bertemu dengan salah satu huruf ikhfa’, maka harus dibaca samar. Huruf ikhfa’ ada lima belas, yaitu: ت – ث – د – ذ – ز – س – ش – ص – ض – ط – ظ – ف – ق – ك.

                                    Cara membaca bacaan ikhfa’ haqiqi adalah dari dalam rongga hidung sampai dengan terlihat samar atau bisa juga menjadi suara “NG” atau “N” , sesudah itu disambut dengan dengung sepanjang 1 – 1 1/2 Alif atau bisa kurang lebih  2 – 3 harakat, kemudian setelah itu barulah  masuk untuk membaca huruf sesudah nun mati ataupun tanwin tersebut.
                                    
                                    Contoh bacaan ikhfa’ haqiqi: مِن دُونِهِمَا. Lafaz tersebut harus dibaca ming duunihimaa.</h3>
                                <h2>Iqlab</h2>
                                <h3>Secara harfiah, iqlab berarti mengganti. Apabila nun sukun atau tanwin bertemu dengan huruf ba’ (ب), maka bacaan nun sukun atau tanwin berubah menjadi bunyi mim.

                                    Contoh: لَيُنۢبَذَنَّ harus dibaca Layumbażanna.
                                    
                                    Empat hukum bacaan nun sukun atau tanwin yang bertemu dengan huruf hijaiyah tersebut bukan hanya perlu dipahami, tetapi juga perlu dipraktikkan dalam membaca Qur’an.</h3>
                                
                                <h3>Untuk Lebih Jelasnya, Yuk Tonton Video Dibawah!</h3>
                                <iframe width="100%" height="445"
                                    src="https://www.youtube.com/embed/4powvv57gdY?">          
                                </iframe>
                                <small class="text-muted">Credit: hehe</small>
                            </div>
                        </div>
                    </div>
                </div>
         </div>
        </main>
    </div>

    <script src="./js/Nun_Sukun_Tanwin.js"></script>
    <script> let submenu = document.getElementById("#sub-menu-wrap");
            function togglemenu(){
                submenu.classList.toggle(".open-class")
            }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.getElementById("Logout").addEventListener("click", function(event){
        event.preventDefault(); // Menghentikan perilaku default dari tautan

        swal({
            title: "Berhasil Logout!",
            text: "Mengalihkan Ke Halaman Login",
            icon: "success",
            button: "Ok",
        }).then((value) => {
            if (value) {
                window.location.href = "../Logout.php"; // Lakukan logout saat tombol "Ok" diklik
            }
        });
    });
</script>
</body>
</html>