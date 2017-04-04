<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
  $question =$_POST["question"];
  $category = $_POST["category"];
  $tag=$_POST["tags"];
  $type = $_POST["type"];
  $sql1="SELECT questionid from userquestions where question='$question' AND category='$category';";
   $result=mysqli_query($conn, $sql1);
   if($count=mysqli_fetch_assoc($result)){
    echo"question already exists.";
    exit;
   }
  $uid=$_SESSION["id"];
  $sql = "INSERT INTO userquestions(category, question, questiontype, visibility, userid, questiondate,tag)VALUES ('$category', '$question', '$type', 1, '$uid', SYSDATE(),'$tag');";
   if ($type=="rat") {
    mysqli_query($conn, $sql);
    $sql1="SELECT questionid from userquestions where question='$question' AND category='$category';";
   $result=mysqli_query($conn, $sql1);
   $count=mysqli_fetch_assoc($result);
   $id=$count["questionid"];
    $sql = "INSERT INTO mcqresult(questionid)VALUES ('$id');";
   }
  elseif($type=="mcq" or $type=="che"){
    mysqli_query($conn, $sql);
    $sql1="SELECT questionid from userquestions where question='$question' AND category='$category';";
   $result=mysqli_query($conn, $sql1);
   $count=mysqli_fetch_assoc($result);
   $id=$count["questionid"];
    $sql = "INSERT INTO mcqresult(questionid)VALUES ('$id');";
    mysqli_query($conn, $sql);
  $op1=$_POST["option1"];
  $op2=$_POST["option2"];
  $op3=$_POST["option3"];
    $sql = "INSERT INTO optiontable(questionid, optionid, optionvalue)VALUES ('$id', '1', '$op1')";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO optiontable(questionid, optionid, optionvalue)VALUES ('$id', '2', '$op2')";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO optiontable(questionid, optionid, optionvalue)VALUES ('$id', '3', '$op3')";
  }
}
if (mysqli_query($conn, $sql)) {
  
  if ($uid==2 or $uid==3) {
   header("location:admin.html");
  }
  else{
   header("location:user.php");
  }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>
