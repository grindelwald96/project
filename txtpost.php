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
		echo "$qid";
        $sql1="SELECT category FROM userquestions WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        
     if ($_REQUEST["comment"])
     {	$answer=$_POST["comment"];
 $sql2="INSERT INTO useranswer1(userid,questionid,answer,ansdate) VALUES('$uid','$qid','$answer',SYSDATE());";
                     $result=mysqli_query($conn, $sql2);
                    if ($row1["category"]=='g') {
                        header("location:gadgetques.php");
                    }else{
                        header("location:socialques.php");
                    }
              }}
              ?> 