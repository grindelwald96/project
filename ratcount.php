<?php
session_start();
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
     $id=$_SESSION["id"];
      $qid=$_SESSION["qid"];
         $sql="SELECT COUNT(answerid) as count FROM useranswer3 WHERE questionid='$qid';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount1=$row["count"];
          $sql1="SELECT SUM(answer) as count1 FROM useranswer3 WHERE questionid='$qid';";
          $result1=mysqli_query($conn, $sql1);
          $row1=mysqli_fetch_assoc($result1);
          $anscount2=$row1["count1"];
          $anscount=$anscount2/$anscount1;
          echo "$anscount";
$sql = "UPDATE mcqresult SET average='$anscount' WHERE questionid='$qid';";
    mysqli_query($conn, $sql);
$sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
         if ($row1["category"]=='g') {
        header("location:gadgetques.php");
        }else{
			header("location:socialques.php");}
?>