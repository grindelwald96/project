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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
$sql="UPDATE userquestions SET flag='0' WHERE questionid='$qid';";  
mysqli_query($conn, $sql);
}

$sql="SELECT category FROM userquestions WHERE questionid='$qid';";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$category=$row["category"];
if($category='s')
{
  header("location:adminsocial.php");
    }
    else
      { header("location:admingadgets.php");}
}
   
?>
</body>
</html>
