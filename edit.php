
<?php
session_start();
if(!isset($_SESSION['email'])){
  header("Location: login.php");
}

if($_SESSION['role'] == "user"){
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $lineNumber = $_GET["id"];
}

$Messages = "";
$filename = "./database/userData.txt";
$fp = fopen($filename, "r");

if ($fp) {
    $line = false;
    $currentLine = 0;

    while (($currentLine < $lineNumber) && ($line = fgets($fp)) !== false) {
        $currentLine++;
    }

    fclose($fp);
} else {
    echo "Failed to open the file.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $info = $_POST['info'];
    echo $info;

    $lineNumber = $_GET['id'];

    $filename = "./database/userData.txt";
    $fileContents = file($filename);

    if ($fileContents) {
        if ($lineNumber >= 1 && $lineNumber <= count($fileContents)) {
            $fileContents[$lineNumber - 1] = $info . PHP_EOL;
            $fileContents = implode("", $fileContents);

            file_put_contents($filename, $fileContents);
            header("Location: homeAdmin.php");
        } else {
            echo "The specified line does not exist.";
        }
    } else {
        echo "Failed to open the file.";
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
    <h1>User Update</h1>
    <hr>

    <label><b>User Info</b></label>
    <input type="text" name="info" value="<?php if ($line !== false) { echo $line; } else { echo "The specified line does not exist."; } ?>" >
    <hr>
    <button type="submit" class="Login">Update</button>
  </div>

  <div class="container signin">
  <center>
    <b style="color:red"><?php echo "Massage : {$Messages}"; ?> </b>
    </center>
  </div>
</form>

</body>
</html>
