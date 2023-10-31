<?php
    session_start();

    $Messages = "Please Login First";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $email = $_POST['email'];
        $password = $_POST['password'];
        $submitButton = $_POST['submit'];
    
    $fp = fopen("./database/userData.txt","r");

    // arrays
    $roles = [];
    $emails = [];
    $passwords = [];
    $userName = [];

    // while loop for get all data
    while ($line = fgets($fp)){
        $values = explode(",", $line);
        $roles[] = trim($values[0]);
        $emails[] = trim($values[1]);
        $passwords[] = trim($values[2]);
        $userName[] = trim($values[3]);
    }

    fclose($fp);

    for($i = 0; $i < count($roles); $i++){
        if($email == $emails[$i] && $password == $passwords[$i]){
            $_SESSION['role'] = $roles[$i];
            $_SESSION['email'] = $emails[$i];
            $_SESSION['userName'] = $userName[$i];
            header("Location: index.php");
        } else {
            $Messages = "Wrong Password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] , input[type=email]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.Login {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.Login:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form method="post" action="">
  <div class="container">
    <h1>User Login</h1>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <hr>
    <button type="submit" class="Login">Login</button>
  </div>
  <div class="container signin">
    <p>Already have an account? <a href="signup.php">Sign in</a>.</p>
  </div>
  <div class="container signin">
  <center>

    admin login : shafayet@mail.com
    <br>
    admin Password : 12345
    <br>
    User login : user@mail.com
    <br>
    User Password : 12345
    <br>
    <b style="color:red"><?php echo "Massage : {$Messages}"; ?> </b>
    </center>
  </div>
</form>

</body>
</html>
