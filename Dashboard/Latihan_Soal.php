<?php

@include '../config.php';
session_start();



if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Soal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/Latihan_Soal.css"/>
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
                <a href="../Dashboard/Materi.php" class="link">
                    <span class="material-symbols-outlined">
                        menu_book
                        </span>
                    <h3>Materi</h3>
                </a>
                <a href="#" class="link active">
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
                Latihan Soal
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
        <div class="search-btn">
                <input type="text" placeholder="Search.." id="search-input">
                <script>
                    document.getElementById("search-input").addEventListener("input", function() {
                        var input, filter, materi, i, txtValue;
                        input = document.getElementById("search-input");
                        filter = input.value.toUpperCase();
                        materi = document.getElementsByClassName("Materi");
                        for (i = 0; i < materi.length; i++) {
                            txtValue = materi[i].getElementsByTagName("h3")[0].textContent || materi[i].getElementsByTagName("h3")[0].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                materi[i].style.display = "";
                            } else {
                                materi[i].style.display = "none";
                            }
                        }
                    });
                </script>
            </div>
            <div class="insight">
                <div class="Materi">
                    <img src="./Materi/obj/Prinsip-dasar-ilmu-tajwid.jpg">
                    <div class="content-tajwid">
                        <div class="middle">
                            <div class="left">
                                <h3>
                                    Tajwid
                                </h3>
                                <h5>Tajwid adalah pengetahuan tentang kaidah serta cara-cara membaca Al-Quran dengan mengeluarkan huruf dari mahrojnya serta memberi hak dan mustahaknya. 
                                </h5>
                            </div>
                        </div>
                        <a href="./Lt_Tajwid.php" class="mulai-belajar-btn">
                            Mulai Belajar!
                        </a>
                        
                    </div>
                </div>
                <div class="Materi">
                    <img src="./Materi/obj/Screenshot-2024-03-23-151722.png">
                    <div class="content-qiraah">
                        <div class="middle">
                            <div class="left">
                                <h3>
                                    Qira'ah
                                </h3>
                                <h5>Qira'ah adalah hal-hal yang berhubungan dengan cara pembacaan Al-Quran dan cara pembacaan ayat-ayat Al-Quran.
                                </h5>
                            </div>
                        </div>
                        <a href="#" class="mulai-belajar-btn">
                            Belum Tersedia
                        </a>
                        
                    </div>
                </div>
                <div class="Materi">
                    <img src="./Materi/obj/asian-muslim-man-teaching-woman-reading-koran-quran-living-room-muslim-couple-praying-home_8595-21025.jpg">
                    <div class="content-irab">
                        <div class="middle">
                            <div class="left">
                                <h3>
                                    I'rab
                                </h3>
                                <h5>I’rab (الإِعْرَابُ) adalah perubahan yang terjadi pada akhir kata/kalimah secara lafal ataupun karena perbedaan amil yang masuk atau mempengaruhi kata tersebut.
                                </h5>
                            </div>
                        </div>
                        <a href="#" class="mulai-belajar-btn">
                            Belum Tersedia
                        </a>
                        
                    </div>
                </div>
            </div>
         </div>
        </main>
        
    </div>

    <script src="./js/materr.js"></script>
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