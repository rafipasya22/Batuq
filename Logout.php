<?php
@include 'config.php';

session_start();
session_unset();
session_destroy();
header('location:./Login_Signup/Login.php');

?>