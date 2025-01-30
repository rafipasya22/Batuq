<?php

@include '../config.php';
session_start();

if(isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email']; 
} else {
    header("Location: Edit.php?error=Email is not set in the session");

}

if(!isset($_SESSION['waktu_login'])){
    $_SESSION['waktu_login'] = time();
}

if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}
function hitungTotalWaktuLogin() {
    $waktu_login = $_SESSION['waktu_login'];
    $total_waktu = time() - $waktu_login;
    $jam = floor($total_waktu / (60 * 60));
    $menit = floor(($total_waktu - ($jam * 60 * 60)) / 60);
    return sprintf("%02d Jam %02d Menit", $jam, $menit);
}

function hitungTotalWaktuLogin24JamTerakhir() {
    $total_waktu_24jam = hitungTotalWaktuLogin();
    if (isset($_SESSION['waktu_login'])) {
        $waktu_login_terakhir = $_SESSION['waktu_login'];
        $sekarang = time();

        $detik_24jam = 24 * 60 * 60;

        $total_waktu_24jam = $sekarang - $waktu_login_terakhir;

        if ($total_waktu_24jam > $detik_24jam) {
            $total_waktu_24jam = $detik_24jam;
        }
    }
    $jam = floor($total_waktu_24jam / (60 * 60));
    $menit = floor(($total_waktu_24jam - ($jam * 60 * 60)) / 60);
    return sprintf("%02d Jam %02d Menit", $jam, $menit);
}

$total_waktu_login_24jam = hitungTotalWaktuLogin24JamTerakhir();
$carisesi = "SELECT total_waktu_login FROM session_akun WHERE Email = '$Email' AND tanggal_sesi = CURRENT_DATE";
$hasilcarisesi = mysqli_query($conn, $carisesi);

if(mysqli_num_rows($hasilcarisesi) > 0) {
    $stmt = mysqli_query($conn, "UPDATE session_akun SET total_waktu_login = '$total_waktu_login_24jam' WHERE Email = '$Email' AND tanggal_sesi = CURRENT_DATE");
} else {
    $stmt = mysqli_query($conn, "INSERT INTO session_akun (Email, total_waktu_login, tanggal_sesi) VALUES ('$Email', '$total_waktu_login_24jam', CURRENT_DATE)");
}


$caritotalbaca = "SELECT COUNT(surah_number) AS Total_baca FROM jumlah_bacaan WHERE tanggal_baca = CURRENT_DATE AND Email = '$Email'";
$hasilcari = mysqli_query($conn, $caritotalbaca);
$displayhasilcari = mysqli_fetch_assoc($hasilcari);

$caritotalbacamateri = "SELECT COUNT(judul_materi) AS Total_baca_Materi FROM jumlah_materi WHERE tanggal_baca = CURRENT_DATE AND Email = '$Email'";
$hasilcarimateri = mysqli_query($conn, $caritotalbacamateri);
$displayhasilcarimateri = mysqli_fetch_assoc($hasilcarimateri);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/Home.css"/>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <h1 class="Nama">BATU<span>Q</span></h1>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="#" class="link active">
                    <span class="material-symbols-outlined">
                        Home
                        </span>
                    <h3>Home</h3>
                </a>
                <a href="../Dashboard/Materi.php" class="link">
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
                    Home
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
                                    <a href="./Edit.php" class="sub-menu-link">
                                        <span class="material-symbols-outlined active">
                                            person
                                        </span> 
                                        <p>Edit Profile</p>
                                    </a>
                                    <a href="#" id="Logout" class="sub-menu-link">
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
            <div class="insight">
                <div class="sales">
                    <span class="material-symbols-outlined">
                        schedule
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Total Waktu Belajar
                            </h3>
                            <h1><?php echo $total_waktu_login_24jam?></h1>
                        </div>
                    </div>
                    <small class="text-muted">Sesi Ini</small>
                </div>
                <!--------End of Sales-------->
                <div class="Expenses">
                    <span class="material-symbols-outlined">
                        menu_book
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Total Materi Dibaca
                            </h3>
                            <h1><?php echo $displayhasilcarimateri['Total_baca_Materi']; ?> Materi</h1>
                        </div>
                        
                    </div>
                    <small class="text-muted">Hari Ini</small>
                </div>
                <!--------End of Expenses-------->
                <div class="Income">
                    <span class="material-symbols-outlined">
                        local_library
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Total Surah Dibaca
                            </h3>
                            <h1><?php echo $displayhasilcari['Total_baca']; ?> Surah</h1>
                        </div>
                    </div>
                    <small class="text-muted">Hari Ini</small>
                </div>
                <!--------End of Income-------->
            </div>
            <div class="progress-belajar">
                <div class="lanjut">
                    <h2>Progress Belajar</h2>
                    <div class="isi">
                        <div class="icon">
                            <span class="material-symbols-outlined">
                                bookmarks
                                </span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <small class="text-muted">Terakhir Dibaca:</small>
                                <h1 id="judulterakhir">Tajwid Dasar</h1>
                                
                            </div>
                            <a href="../Dashboard/Materi.php" class="lanjut-btn">
                                Lanjutkan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="lanjut-ngaji">
                    <div class="isi">
                        <div class="icon">
                            <span class="material-symbols-outlined">
                                local_library
                                </span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <small class="text-muted">Terakhir Dibaca:</small>
                                <div class="surah">
                                <h1 id="surah-name"></h1>
                                <small class="text-muted">Surah ke-<span id="surah-number"></span></small>
                                </div>
                            </div>
                            <a href="../Dashboard/Baca_Quran.php" class="lanjut-btn">
                                Lanjutkan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="right-btn">
                    <a href="#">Selengkapnya</a>
                </div>
            </div>
        </main>
    </div>

    <script src="./js/dash.js"></script>
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