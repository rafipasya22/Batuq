<?php
@include '../config.php';
session_start();

if(isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email']; 
} else {
    header("Location: Edit.php?error=Email is not set in the session");

}

if(isset($_POST['submit'])){
    $tanggal_dari = $_POST['tanggal_dari'];
    $tanggal_ke = $_POST['tanggal_ke'];
    if (mysqli_connect_errno()) {
        echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
        exit();
    }
    $query = "SELECT tanggal_baca, COUNT(surah_number) AS total_baca FROM jumlah_bacaan WHERE tanggal_baca BETWEEN '$tanggal_dari' AND '$tanggal_ke' GROUP BY tanggal_baca";
    $result = mysqli_query($conn, $query);
    $data_grafik = array();
    $labels = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tanggal_baca = $row['tanggal_baca'];
        $total_baca = $row['total_baca'];
        $labels[] = $tanggal_baca;
        $data_grafik[] = $total_baca;
    }
}

if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}

$caridata = "SELECT latihan_soal, skor, percobaan, tanggal_latso FROM latso WHERE Email = '$Email'";
$hasilcari = mysqli_query($conn, $caridata);
$jumlahbaca = "SELECT COUNT(DISTINCT surah_number) AS Total_baca, tanggal_baca FROM jumlah_bacaan WHERE Email = '$Email' GROUP BY tanggal_baca ";
$hasill = mysqli_query($conn, $jumlahbaca);
$materi = mysqli_query($conn, "SELECT COUNT(DISTINCT judul_materi) AS total_baca, tanggal_baca, GROUP_CONCAT(DISTINCT judul_materi SEPARATOR ', ') AS nama_materi FROM jumlah_materi WHERE Email = '$Email' GROUP BY tanggal_baca ");
$totalbaca = mysqli_query($conn, "SELECT COUNT(surah_number) AS Total_baca FROM jumlah_bacaan WHERE tanggal_baca = CURRENT_DATE && Email = '$Email'" );
$tanggal = mysqli_query($conn, "SELECT tanggal_baca FROM jumlah_bacaan WHERE tanggal_baca = CURRENT_DATE && Email = '$Email'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/Reports.css"/>
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
                <a href="#" class="link active">
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
                    Reports
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
                <div class="table-latso">
                    <div class="tabel">
                        
                        <table id="tabel2">
                            <thead>
                                <tr>
                                    <th>Jumlah Surah Dibaca</th>
                                    <th>Tanggal Membaca</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    while($row = mysqli_fetch_assoc($hasill)){
                                    ?>
                                        <td><?php echo $row['Total_baca'] ?> Surah</td>
                                        <td><?php echo $row['tanggal_baca'] ?></td>
                                </tr>
                                     
                                    <?php        
                                    }
                                    ?>
                                
                            </tbody>
                        </table>
                        <table id="tabel3">
                            <thead>
                                <tr>
                                    <th>Jumlah Materi</th>
                                    <th>Materi Yang Dipelajari</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    while($row = mysqli_fetch_assoc($materi)){
                                    ?>
                                        <td><?php echo $row['total_baca'] ?></td>
                                        <td><?php echo $row['nama_materi'] ?></td>
                                        <td><?php echo $row['tanggal_baca'] ?></td>
                                </tr>
                                     
                                    <?php        
                                    }
                                    ?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <table id="tabel1">
                            <thead>
                                <tr>
                                    <th>Materi</th>
                                    <th>Nilai</th>
                                    <th>Jumlah Percobaan</th>
                                    <th>Tanggal Mengerjakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    while($row = mysqli_fetch_assoc($hasilcari)){
                                    ?>
                                        <td><?php echo $row['latihan_soal'] ?></td>
                                        <td><?php echo $row['skor'] ?></td>
                                        <td><?php echo $row['percobaan'] ?> Kali</td>
                                        <td><?php echo $row['tanggal_latso'] ?></td>
                                </tr>
                                     
                                    <?php        
                                    }
                                    ?>
                                
                            </tbody>
                        </table>
                </div> 
                
                <div class="graph_surah">
                    <form method="post" action="" class="date">
                        <label for="tanggal_dari">Dari Tanggal:</label>
                        <input type="date" id="tanggal_dari" name="tanggal_dari">
                        <label for="tanggal_ke">Ke Tanggal:</label>
                        <input type="date" id="tanggal_ke" name="tanggal_ke">
                        <button type="submit" name="submit" class="tomsub"><span class="material-symbols-outlined">chevron_right</span></button>
                    </form>
                    <canvas id="myChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var data = <?php echo json_encode($data_grafik); ?>;
                            var labels = <?php echo json_encode($labels); ?>;
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Total Bacaan',
                                        data: data,
                                        backgroundColor: 'rgba(221, 162, 0, 0.938)',
                                        borderColor: 'rgba(221, 162, 0, 0.938)',
                                        borderWidth: 1,
                                        fill: false
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            display: true,
                                            ticks: {
                                                beginAtZero: true,
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>                   
                </div>
                                
            </div>
        </div>
        </main>
    </div>

    <script src="./js/rep.js"></script>
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