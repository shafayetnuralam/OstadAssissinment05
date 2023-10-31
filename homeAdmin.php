<?php
session_start();
if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
  header("Location: login.php");
}

if($_SESSION['role'] == "user"){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

<h1>User Details</h1>
    <p>User Name : <?php echo $_SESSION['userName']; ?></p>
    <p>Email Address is : <?php echo $_SESSION['email']; ?></p>
    <p>Role : <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Logout</a>
<h2> List Of Users</h2>
<table style="width: 100%;">

<tr>
    <th>SL</th>
    <th>User Name</th>
    <th>Role</th>
    <th>Email</th>
    <th>Action</th>
</tr>
<tr>
<?php
                          $serial = 1;
                          $fp = fopen("./database/userData.txt","r");
                          while ($line = fgets($fp)){
                            $values = explode(",", $line);
                            $adRoles = trim($values[0]);
                            $email = trim($values[1]);
                            $userName = trim($values[3]);
                            $info = "$adRoles, $email, $userName";

                            echo "<tr>
                            <th scope='row'>{$serial}</th>
                            <td> {$userName} </td>
                            <td> {$adRoles} </td>
                            <td>{$email}</td>
                            <td>
                            <a href='delete.php?id=$serial' >Delete</a> ||
                            <a href='edit.php?id=$serial' >Edit</a> ||
                            <a href='makeAdmin.php?id=$serial' >Make Admin</a> </td>
                            </tr>";
                            $serial++;
                          }
                        ?>
</tr>
</table>
</body>
</html>


