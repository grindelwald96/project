<?php
session_start();
?>
<?php
   $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
 $uid=$_SESSION["id"];
 $aid=$_REQUEST["Submit"];
 echo "$aid";
            $sql="SELECT * FROM answerlike WHERE userid='$uid' AND answerid='$aid';";
            $result=mysqli_query($conn, $sql);
            if(!($row=mysqli_fetch_assoc($result))){
               $sql2="INSERT INTO answerlike(answerid,userid,likevalue) VALUES('$aid','$uid','1');";
                $result=mysqli_query($conn, $sql2);
            }
            else
               {

              $sql2= "DELETE FROM answerlike WHERE userid='$uid' AND answerid='$aid';";
              $result2=mysqli_query($conn, $sql2);
              }
               $sql3="SELECT questionid FROM useranswer4 WHERE answerid='$aid';";
        $result3=mysqli_query($conn, $sql3);
        $row3=mysqli_fetch_assoc($result3); 
        $qid=$row3["questionid"];

               $sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1); 
        if ($row1["category"]=='g') {
        header("location:gadgetques.php");
        }else{
        header("location:socialques.php");
        }
           
              ?> 