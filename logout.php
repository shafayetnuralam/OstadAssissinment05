<?php 
session_start();
session_unset();
session_destroy(); //optional
header("Location: login.php");