<?php
session_start();
if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
    header("Location: login.php");
}

if($_SESSION['role'] == "admin"){
    header("Location: homeAdmin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User Details</h1>
    <p>User Name : <?php echo $_SESSION['userName']; ?></p>
    <p>Email Address is : <?php echo $_SESSION['email']; ?></p>
    <p>Role : <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
