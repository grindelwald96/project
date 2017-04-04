<?php
session_start();
?>
<?php
   $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
 $uid=$_SESSION["id"];
 if ($_REQUEST["Submit"])
    {	$qid=$_REQUEST['Submit'];
        $sql1="SELECT questiontype,category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op=$row1["questiontype"];
     if ($_REQUEST["ans"])
     {	$answer=$_POST["ans"];
        switch ($op) {
            case 'mcq':
                 $_SESSION["qid"]=$qid;
            $sql="SELECT * FROM useranswer2 WHERE userid='$uid' AND questionid='$qid';";
            $result=mysqli_query($conn, $sql);
            if(!($row=mysqli_fetch_assoc($result))){
               $sql2="INSERT INTO useranswer2(userid,questionid,answer,ansdate) VALUES('$uid','$qid','$answer',SYSDATE());";
                $result=mysqli_query($conn, $sql2);
            }header("location:mcqcount.php");exit();
                break;
            case 'txt':
                $sql2="INSERT INTO useranswer1(userid,questionid,answer,ansdate) VALUES('$uid','$qid','$answer',SYSDATE());";
                     $result=mysqli_query($conn, $sql2);
                     if ($row1["category"]=='g') {
                        header("location:gadgetques.php");
                    }else{
                        header("location:socialques.php");
                    }
                break;
            case 'rat':
                $_SESSION["qid"]=$qid;
            $sql="SELECT * FROM useranswer3 WHERE userid='$uid' AND questionid='$qid';";
            $result=mysqli_query($conn, $sql);
            if(!($row=mysqli_fetch_assoc($result))){
                $sql2="INSERT INTO useranswer3(userid,questionid,answer,ansdate) VALUES('$uid','$qid','$answer',SYSDATE());";
                $result=mysqli_query($conn, $sql2); 
            }   echo"redrirecting...";header("location:ratcount.php");
                break;
        }
     }
    else{
        $qid=$_POST['flag'];
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
    }}

        mysqli_close($conn);
 ?>