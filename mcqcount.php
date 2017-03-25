<?php
session_start();
?>

<?php
         $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
     $id=$_SESSION["id"];
      $qid=$_SESSION["qid"];
          $sql="SELECT COUNT(*) as count1 FROM useranswer2 WHERE questionid='$qid' AND answer='1';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount1=$row["count1"];

          $sql="SELECT COUNT(*) as count2 FROM useranswer2 WHERE questionid='$qid' AND answer='2';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount2=$row["count2"];

          $sql="SELECT COUNT(*) as count3 FROM useranswer2 WHERE questionid='$qid' AND answer='3';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount3=$row["count3"];

$anscount=$anscount1+$anscount2+$anscount3;
$fin1=$anscount1/$anscount;
$final1=$fin1*100;
$fin2=$anscount2/$anscount;
$final2=$fin2*100;
$fin3=$anscount3/$anscount;
$final3=$fin3*100;
$sql = "UPDATE mcqresult SET countop1='$final1', countop2='$final2', countop3='$final3' WHERE questionid='$qid';";
    mysqli_query($conn, $sql);
$sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
         if ($row1["category"]=='g') {
        header("location:gadgetques.php");
        }else{
			header("location:socialques.php");}
?>