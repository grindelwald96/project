<?php
session_start();
?>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}

   
  $qid=$_REQUEST['submit'];
echo "$qid";
  $sql="DELETE FROM userquestions WHERE questionid='$qid';";  
mysqli_query($conn, $sql);

header("location:user.php");
?>
  
