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
  $password = $_POST["password"];
$sql="select usertype, userid from loginpage where username='$username' AND password='$password';";  
}
$result=mysqli_query($conn, $sql);
  if($count=mysqli_fetch_assoc($result)){
    $_SESSION["id"]=$count["userid"];
    if ($count["usertype"]=="s" or $count["usertype"]=="c") {
      $_SESSION["name"]=$username;
     header("location:user.php");
    }
    else{
      header("location:admin.html");
    }
  }
  else{
    header("location:home.html");
  }
?>
</body>
</html>
