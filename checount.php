<?php
session_start();
?>

<?php
         $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
     $id=$_SESSION["id"];
      $qid=$_SESSION["qid"];
      
          $sql="SELECT SUM(op1) as count1 FROM useranswer4 WHERE questionid='$qid';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount1=$row["count1"];

         $sql="SELECT SUM(op2) as count2 FROM useranswer4 WHERE questionid='$qid';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount2=$row["count2"];
           $sql="SELECT SUM(op3) as count3 FROM useranswer4 WHERE questionid='$qid';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount3=$row["count3"];
           $sql="SELECT COUNT(*) as count4 FROM useranswer4 WHERE questionid='$qid';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $anscount4=$row["count4"];
          $ans1=($anscount1/$anscount4)*100;
			$ans2=($anscount2/$anscount4)*100;
          $ans3=($anscount3/$anscount4)*100;

$sql = "UPDATE mcqresult SET countop1='$ans1', countop2='$ans2', countop3='$ans3' WHERE questionid='$qid';";
    mysqli_query($conn, $sql);
$sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
         if ($row1["category"]=='g') {
        header("location:gadgetques.php");
        }else{
			header("location:socialques.php");}
?>