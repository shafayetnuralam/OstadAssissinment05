<?php
session_start();

if(!isset($_SESSION['role'])){
  header("Location: login.php");
}

if($_SESSION['role'] == "admin"){
  header("Location: homeAdmin.php");
}

if($_SESSION['role'] == "user"){
  header("Location: homeUser.php");
}

?>