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
    $surahNumber = $_POST['surahNumber'];
    $carisurah = "SELECT surah_number FROM jumlah_bacaan WHERE surah_number = '$surahNumber' && Email = '$Email' && tanggal_baca = CURRENT_DATE";
    $hasilcarisurah = mysqli_query($conn, $carisurah);
    if(mysqli_num_rows($hasilcarisurah)>0){
        $stmt = mysqli_query($conn,"UPDATE jumlah_bacaan SET bacaan_count = bacaan_count + 1 WHERE surah_number = '$surahNumber' && Email = '$Email' && tanggal_baca = CURRENT_DATE");
    }else{
        $stmt = mysqli_query($conn,"INSERT INTO jumlah_bacaan (surah_number, bacaan_count, Email, tanggal_baca) VALUES ('$surahNumber', 1, '$Email', CURRENT_DATE)");
    }
    
    

    $stmt->close();
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        async function getSurahList() {
            const url = "http://api.alquran.cloud/v1/surah";
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const data = await response.json();
                    const surahList = document.getElementById("surah-list");
                    data.data.forEach((surah) => {
                        const listItem = document.createElement("li");
                        listItem.textContent = `${surah.number}. ${surah.englishName} (${surah.name})`;
                        listItem.addEventListener("click", () => {
                        const surahName = `${surah.englishName} (${surah.name})`;
                        const surahNumber = `${surah.number}`;
                         
                        sendData(surahNumber);
                        showSurah(surah.number);
                        });
                        surahList.appendChild(listItem);
                    });
                } else {
                    console.error("Gagal mendapatkan data dari API");
                }
            } catch (error) {
                console.error("Terjadi kesalahan:", error);
            }
        }

        function sendData(surahNumber) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'Baca_Quran.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                }
            };
            xhr.send('surahNumber=' + encodeURIComponent(surahNumber));
        }
        
    </script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Qur'an</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/Baca_Quran.css"/>
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
                <a href="#" class="link active">
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
                    Baca Qur'an
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
                                    
                                    <a href="../Logout.php" id= "Logout" class="sub-menu-link">
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
            <div class="progress-belajar">
                <div class="search-btn">
                    <input type="text" placeholder="Search..">
                    <script>
                        document.querySelector('input[type="text"]').addEventListener('input', function() {
                            const searchText = this.value.toLowerCase();
                            const surahItems = document.querySelectorAll('#surah-list li');
                            surahItems.forEach(function(item) {
                                const surahText = item.textContent.toLowerCase();
                                if (surahText.includes(searchText)) {
                                    item.style.display = 'block';
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                        });
                    </script>
                </div>
                <ul id="surah-list"></ul>
                <div id="response"></div>
                <div id="surah-content"></div>
                <div class="surah-nav-btn">
                    <button id="sebelumnya">Surah Sebelumnya</button> 
                    <button id="kembali" onClick="goBack()">Kembali ke Daftar</button> 
                    <button id="selanjutnya">Surah Selanjutnya</button> 
                  </div>
            </div>
            
        </main>
    </div>

    <script src="./js/bac.js"></script>
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