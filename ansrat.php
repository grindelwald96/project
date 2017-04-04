<?php
session_start();
?>
<?php
   $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
 $uid=$_SESSION["id"];
 if ($_POST["Submit"]) {
 	                if (!(isset($_POST["ans"]))) {
                $sql="UPDATE userquestions SET flag='1' WHERE questionid='$qid';";
                $result=mysqli_query($conn, $sql); 
                $sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
                $result1=mysqli_query($conn, $sql1);
                $row1=mysqli_fetch_assoc($result1);
                if ($row1["category"]=='g') {
                    header("location:gadgetques.php");
                }else{
                    header("location:socialques.php");
                }
        }
        else{
         $qid=$_POST["Submit"];
         $answer=$_POST["ans"];
         $_SESSION["qid"]=$qid;
            $sql="SELECT * FROM useranswer4 WHERE questionid='$qid' AND userid='$uid';";
            $result=mysqli_query($conn, $sql);
            if(!($row=mysqli_fetch_assoc($result))){
                $flag=0;
               foreach ($answer as $ans=>$value) {
                 if (!$flag) {
                    switch ($value) {
                        case '1':
                        $sql2="INSERT INTO useranswer4(userid,questionid,op1,op2,op3,ansdate) VALUES('$uid','$qid','1','0','0', SYSDATE());";
                        $result=mysqli_query($conn, $sql2);
                            break;
                        case '2':
                        $sql2="INSERT INTO useranswer4(userid,questionid,op1,op2,op3,ansdate) VALUES('$uid','$qid','0','1','0',SYSDATE());";
                        $result=mysqli_query($conn, $sql2);
                            break;
                        case '3':
                        $sql2="INSERT INTO useranswer4(userid,questionid,op1,op2,op3,ansdate) VALUES('$uid','$qid','0','0','1',SYSDATE());";
                        $result=mysqli_query($conn, $sql2);
                            break;
                    } $flag=1;
                 }
                 else{
                    switch ($value) {
                        case '1':
                        $sql2="UPDATE useranswer4 SET op1='1' WHERE userid='$uid';";
                        $result=mysqli_query($conn, $sql2);
                            break;
                        case '2':
                        $sql2="UPDATE useranswer4 SET op2='1' WHERE userid='$uid';";
                        $result=mysqli_query($conn, $sql2);
                            break;
                        case '3':
                        $sql2="UPDATE useranswer4 SET op3='1' WHERE userid='$uid';";
                        $result=mysqli_query($conn, $sql2);
                            break;
                    }
                 }
               }
            }header("location:checount.php");exit();
        }
   }