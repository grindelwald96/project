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

    if ($_REQUEST["allow"]) {
$qid=$_POST["allow"];
$sql="UPDATE userquestions SET flag='0' WHERE questionid='$qid';";  
mysqli_query($conn, $sql);
}
else{
  $qid=$_POST["remove"];
  $sql="UPDATE userquestions SET visibility='0' WHERE questionid='$qid';";  
mysqli_query($conn, $sql);
}

$sql="SELECT category FROM userquestions WHERE questionid='$qid';";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$cat=$row["category"];
if($cat=='s')
{
  header("location:adminsocial.php");
    }
    else
      { header("location:admingadgets.php");
  }
   
?>