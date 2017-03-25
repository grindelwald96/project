<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>welcome</title>
</head>
<body>
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username =$_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $type = $_POST["type"];
  $sql = "INSERT INTO loginpage(username, password, email, usertype)VALUES ('$username', '$password', '$email', '$type')";
}


if (mysqli_query($conn, $sql)) {
  $sql="select userid from loginpage where username='$username' AND password='$password';";
  $result=mysqli_query($conn, $sql);
  $count=mysqli_fetch_assoc($result);
  $id=$count["userid"];
  $_SESSION["id"]=$id;
  $_SESSION["name"]=$username;
    header("location:user.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>
