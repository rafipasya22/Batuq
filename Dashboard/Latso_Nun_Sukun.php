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
    $judul = $_POST['judulatso'];
    $skor = $_POST['skor'];
    $carilatso = "SELECT latihan_soal FROM latso WHERE latihan_soal = '$judul' && Email = '$Email' && tanggal_latso = CURRENT_DATE";
    $hasilcarilatso = mysqli_query($conn, $carilatso);
    if(mysqli_num_rows($hasilcarilatso)>0){
        $stmt = mysqli_query($conn,"UPDATE latso SET skor = '$skor', percobaan = percobaan + 1 WHERE latihan_soal = '$judul' && Email = '$Email' && tanggal_latso = CURRENT_DATE");
    }else{
        $stmt = mysqli_query($conn,"INSERT INTO latso (latihan_soal, skor, Email, tanggal_latso, percobaan) VALUES ('$judul', '$skor', '$Email', CURRENT_DATE, 1)");
    }
    
}

$soal1 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 1";
$hasilcarisoal1 = mysqli_query($conn, $soal1);
$row = mysqli_fetch_array($hasilcarisoal1);
$soal = $row['pertanyaan'];

$soal2 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 2";
$hasilcarisoal2 = mysqli_query($conn, $soal2);
$row = mysqli_fetch_array($hasilcarisoal2);
$soal2 = $row['pertanyaan'];

$soal3 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 3";
$hasilcarisoal3 = mysqli_query($conn, $soal3);
$row = mysqli_fetch_array($hasilcarisoal3);
$soal3 = $row['pertanyaan'];

$soal4 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 4";
$hasilcarisoal4 = mysqli_query($conn, $soal4);
$row = mysqli_fetch_array($hasilcarisoal4);
$soal4 = $row['pertanyaan'];

$soal5 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 5";
$hasilcarisoal5 = mysqli_query($conn, $soal5);
$row = mysqli_fetch_array($hasilcarisoal5);
$soal5 = $row['pertanyaan'];

$soal6 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 6";
$hasilcarisoal6 = mysqli_query($conn, $soal6);
$row = mysqli_fetch_array($hasilcarisoal6);
$soal6 = $row['pertanyaan'];

$soal7 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 7";
$hasilcarisoal7 = mysqli_query($conn, $soal7);
$row = mysqli_fetch_array($hasilcarisoal7);
$soal7 = $row['pertanyaan'];

$soal8 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 8";
$hasilcarisoal8 = mysqli_query($conn, $soal8);
$row = mysqli_fetch_array($hasilcarisoal8);
$soal8 = $row['pertanyaan'];

$soal9 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 9";
$hasilcarisoal9 = mysqli_query($conn, $soal9);
$row = mysqli_fetch_array($hasilcarisoal9);
$soal9 = $row['pertanyaan'];

$soal10 = "SELECT * FROM pertanyaan_latso_nun_sukun WHERE id = 10";
$hasilcarisoal10 = mysqli_query($conn, $soal10);
$row = mysqli_fetch_array($hasilcarisoal10);
$soal10 = $row['pertanyaan'];
?>

<script>
 function sendData(SkorAkhir) {
            var judul = "Hukum Nun Sukun dan Tanwin";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Optional: Handle the response here
                }
            };
            xhttp.open("POST", "Latso_Nun_Sukun.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Mengirim kedua data dalam satu permintaan
            var params = "skor=" + encodeURIComponent(SkorAkhir) + "&judulatso=" + encodeURIComponent(judul);
            xhttp.send(params);
        }
        

function showScore(){
    SkorAkhir = (Score/questions.length)*100;
    skor.innerHTML = SkorAkhir;
    resetState();
    sendData(SkorAkhir);
    header.style.display = "none";
    quiz.style.display = "none";
    hasil.style.display = "block";
    if(SkorAkhir > 80){
        selesai.style.display = "none";
        lanjut.innerHTML = "Selesai";
    }else{
        lanjut.innerHTML = "Ulangi";
    }
}

const questions = [
    {
        question: "<?php echo $soal?>",
        anwers: [
            {
                text: "ا ح خ ع غ ه", correct: true
            },
            {
                text: "ب", correct: false
            },
            {
                text: "ي ن م و", correct: false
            },
            {
                text: "ل ر", correct: false
            },
            {
                text: "ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal2?>",
        anwers: [
            {
                text: "ي ن م و", correct: false
            },
            {
                text: "ب", correct: true
            },
            {
                text: "ل ر", correct: false
            },
            {
                text: "ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق", correct: false
            },
            {
                text: "ا ح خ ع غ ه", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal3?>",
        anwers: [
            {
                text: "ي ن م و", correct: true
            },
            {
                text: "ب", correct: false
            },
            {
                text: "ل ر", correct: false
            },
            {
                text: "ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق", correct: false
            },
            {
                text: "ا ح خ ع غ ه", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal4?>",
        anwers: [
            {
                text: "ي ن م و", correct: false
            },
            {
                text: "ب", correct: false
            },
            {
                text: "ل ر", correct: true
            },
            {
                text: "ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق", correct: false
            },
            {
                text: "ا ح خ ع غ ه", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal5?>",
        anwers: [
            {
                text: "ي ن م و", correct: false
            },
            {
                text: "ب", correct: false
            },
            {
                text: "ل ر", correct: false
            },
            {
                text: "ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق", correct: true
            },
            {
                text: "ا ح خ ع غ ه", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal6?>",
        anwers: [
            {
                text: "Jelas", correct: false
            },
            {
                text: "Merubah", correct: false
            },
            {
                text: "Dimasukan tanpa disertai dengung", correct: false
            },
            {
                text: "Samar", correct: true
            },
            {
                text: "Dimasukan disertai dengung", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal7?>",
        anwers: [
            {
                text: "Jelas", correct: true
            },
            {
                text: "Merubah", correct: false
            },
            {
                text: "Dimasukan tanpa disertai dengung", correct: false
            },
            {
                text: "Samar", correct: false
            },
            {
                text: "Dimasukan disertai dengung", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal8?>",
        anwers: [
            {
                text: "Dibaca dengung", correct: true
            },
            {
                text: "Memasukkan huruf yang ber-nun mati atau tanwin ke dalam huruf setelahnya", correct: false
            },
            {
                text: "Hurufnya ل dan ر", correct: false
            },
            {
                text: "Dibaca tanpa dengung", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal9?>",
        anwers: [
            {
                text: "Jelas", correct: false
            },
            {
                text: "Merubah", correct: true
            },
            {
                text: "Dimasukan tanpa disertai dengung", correct: false
            },
            {
                text: "Samar", correct: false
            },
            {
                text: "Dimasukan disertai dengung", correct: false
            },
        ]
    },
    {
        question: "<?php echo $soal10?>",
        anwers: [
            {
                text: "Mengganti huruf yang ber nun mati atau tanwin dengan huruf م", correct: false
            },
            {
                text: "Apabila ada nun mati atau tanwin bertemu dengan huruf tersebut maka dibaca memasukkan tanpa dengung", correct: true
            },
            {
                text: "Apabila ada nun mati atu tanwin bertemu dengan huruf-huruf tersebut maka di baca jelas", correct: false
            },
            {
                text: "Apabila ada nun mati atau tanwin bertemu dengan huruf-huruf tersebut dibaca samar", correct: false
            },
            {
                text: "Apabila ada nun mati atau tanwin bertemu dengan huruf tersebut maka dibaca memasukkan dengan mendengungkan", correct: false
            },
        ]
    }
];
</script>


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
    <link rel="stylesheet" href="css/Latso_Nun_Sukun.css"/>
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
                <a href="../Dashboard/Latihan_Soal.php" class="link active">
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
                <div class="main-content">
                <div class="awal">
                    <div class="infoo" id="awal">    
                        <div class="info_title">
                            <h1>Peraturan:</h1>
                        </div>  
                        <div class="info-list">
                            <div class="info">1. Waktu yang diberikan 10 Menit</div>
                            <div class="info">2. Nilai Minimal 80% untuk Lulus</div>
                        </div>
                            <div class="button" id="mulai">
                                <button class="Start"> Mulai </button>
                        </div>
                    </div>
                <div class="header-quiz">
                    <Header id = head>
                                    <div class="title">Latihan Soal Nun Sukun dan Tanwin</div>
                                    <div class="timer">
                                        <div class="time_text">Sisa Waktu:</div>
                                        <div class="time_sec"><span id="minutes">10</span> : <span id="seconds">00</span></div>
                                    </div>
                    </Header>
                </div>
                    <div class="isi" id="quiz">
                        <div class="middle">
                            <div class="left">
                                
                                <section>
                                    <div id="question" class="que_text">
                                    Question disini
                                    </div>
                                    <div id = "answer-button" class="option-list">
                                        <div class="btn">
                                            <span>ا ح خ ع غ ه</span>
                                            <div class="icon tick">
                                            <span class="material-symbols-outlined">check</span>
                                            </div>
                                            
                                        </div>
                                        <div class="btn">
                                            <span>ب</span>
                                            <div class="icon cross">
                                            <span class="material-symbols-outlined">close</span>
                                            </div>      
                                        </div>
                                        <div class="btn">
                                            <span>ي ن م و</span>
                                        </div>
                                        <div class="btn">
                                            <span>ل ر</span>
                                        </div>
                                        <div class="btn">
                                            <span>ت ث ج د ذ ز س ش ف ك ص ض ط ظ ق</span>
                                        </div>
                                    </div>
                                </section>
                                <footer>
                                    <div class="total_que">
                                        <span><p id="Now">2</p> dari <p id="Total">5</p></span>
                                    </div>
                                    <div id = "next-btn" class="button">
                                    <button class="nxt">Lanjut</button>
                                    </div>
                                    
                                </footer>
                            </div>
                            
                        </div>
                    </div>
                    <div class="hasil" id="score">
                                <div class="tex">Selamat, Latihan Soal Telah Dikerjakan!</div>
                                <div class="score">
                                    <span>Nilai Kamu: <p id="scoreakhir">50</p></span>
                                </div>
                                <div class="button">
                                    <a href="#" class="Lnjt" id="lanjut">Lanjut</a>
                                    <a href="../Dashboard/Latso_Nun_Sukun.php" class="Lnjt" id="udahan">Selesai</a>
                                </div>
                    </div>
                </div>
         </div>
        </main>
    </div>

    <script src="./js/Latso_Nun_Sukun.js"></script>
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
<script>
    function updateCountdown() {
    if (seconds === 0 && minutes === 0 && hours === 0) {
      stopCountdown();
      swal({
        title: "Waktu Habis",
        text: "Latihan Soal Selesai!",
        icon: "warning",
        button: "Ok",
        }).then(showScore());;
      return;
    }
  
    if (seconds === 0) {
      if (minutes > 0) {
        seconds = 59;
        minutes--;
      } else if (hours > 0) {
        minutes = 59;
        seconds = 59;
        hours--;
      }
    } else {
      seconds--;
    }
    menit.innerText = formatTime(minutes);
    detik.innerText = formatTime(seconds);
  }
</script>
</body>
</html>