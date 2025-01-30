<?php
session_start();
@include '../config.php';
if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}
if(isset($_POST['submit'])) {
    if(isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email']; 
    } else {
        header("Location: Edit.php?error=Email is not set in the session");
 
    }
    $Nama_Depan = mysqli_real_escape_string($conn, $_POST['namadepan']);
    $Nama_Belakang = mysqli_real_escape_string($conn, $_POST['namabelakang']);
    $Email_Baru = mysqli_real_escape_string($conn, $_POST['Email_Baru']);
    
    if(!empty($Nama_Depan) || !empty($Nama_Belakang)){
        if(empty($Nama_Depan)){
            $update = "UPDATE akun_batuq SET Nama_Belakang = '$Nama_Belakang' WHERE Email = '$Email'";
            $_SESSION['NamaBelakang'] = $Nama_Belakang;
        } else if(empty($Nama_Belakang)){
            $update = "UPDATE akun_batuq SET Nama_Depan = '$Nama_Depan' WHERE Email = '$Email'";
            $_SESSION['NamaDepan'] = $Nama_Depan;
        } else {
            $update = "UPDATE akun_batuq SET Nama_Depan = '$Nama_Depan', Nama_Belakang = '$Nama_Belakang' WHERE Email = '$Email'";
            $_SESSION['NamaDepan'] = $Nama_Depan;
            $_SESSION['NamaBelakang'] = $Nama_Belakang;
        }
        mysqli_query($conn, $update);
    }

    if(!empty($Email_Baru)) {
        $update_email = "UPDATE akun_batuq SET Email = '$Email_Baru' WHERE Email = '$Email'";
        mysqli_query($conn, $update_email);

        
        $_SESSION['Email'] = $Email_Baru;
        session_unset();
        session_destroy();

        header('location:Login_Signup/Login.php');
    }

    if(isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] === 0) {
        $img_name = $_FILES['profile-photo']['name'];
        $size = $_FILES['profile-photo']['size'];
        $tmp_name = $_FILES['profile-photo']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_ex = array("jpg", "jpeg", "png");

        if(in_array($img_ex_lc, $allowed_ex)) {
            if($size <= 825000) {
                $new_img_name = uniqid("Profile-Picture-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $foto = "UPDATE akun_batuq SET Foto_Profil = '$new_img_name' WHERE Email = '$Email'";
                mysqli_query($conn, $foto);
            } else {
                $em = "Terlalu Besar Mase!";
                header("Location: Edit.php?error=$em");
            }
        } else {
            $em = "Ganti Tipe File Bos!";
            header("Location: Edit.php?error=$em");
        }
    }
    header("Location: Edit.php");
} else {
    header("Location: Edit.php");
}
?>
