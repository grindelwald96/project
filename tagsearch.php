<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search results</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapi s.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style>
 .navbar {
  margin-bottom: 2px;
    font-family: Montserrat, sans-serif;
    letter-spacing: 3px;
    opacity: 0.8
  }
cite{
  font-size: 13px;
}
    footer{
      background-color: #2f2f2f;
      color: #fff;
      padding-top: 65px;
      padding-bottom: 65px;
      margin-top: 30%;
      margin-left: 0px;
      line-height: 38px;
    }
    body {
     font: 400 15px/1.8 Lato, sans-serif;
     color: #777;
    }
    .social{
  border-left: 4px solid red;
  box-shadow: 5px 5px 5px grey;
  border-radius: 4px;
}
.gadget{
  border-left: 4px solid #0000ff;
  box-shadow: 5px 5px 5px grey;
  border-radius: 4px;
}
label{
  color: #e60000;
}
.result{
  font-size: 14px;
  color: black;
  font-weight: bold;
}
.result-scroll{
  font-size: 14px;
  color: black;
  font-weight: bold;
  text-align: center;
  overflow-y: scroll;
  height: 150px;
}
.img-circle{
    max-width: 50px;
    max-height: 50px;
      }
 </style>
}
</head>
<body>
 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-target="#myNav" data-toggle="collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a style="color: #1a1aff" class="navbar-brand" href="home.html">websiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNav">
      <ul class="nav navbar-nav" style="margin-left: 35px">
        <li><a href="user.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="socialques.php">Social</a></li>
        <li><a href="gadgetques.php">Gadgets</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li>
          <form class="form form-inline" method="post">
      <input type="text" name="search" placeholder="  Search.." style="border-style: none;">
      <button type="submit" name="submit" class="btn btn-default" style="border-style: none;"><span class="glyphicon glyphicon-search"></span></button>
      </form>
        </li>
        <li>
          <a href="logout.php">
           <span class="glyphicon glyphicon-off"></span> Log Out
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container" style="padding-top: 30px;">
<?php
$conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$query=$_POST["search"];
	$sql="SELECT * FROM userquestions WHERE tag LIKE '%$query%' AND visibility='1';";
     $result=mysqli_query($conn, $sql);
 echo"<h2> Showing results for '$query'</h2>
  <div class='row'>
  	<div class='col-sm-3'>
  		
  	</div>
  	<div class='col-sm-7'>";
  	 while ($row=mysqli_fetch_assoc($result)) {
      $question=$row["question"];
      $qid=$row["questionid"];
      $_SESSION["qid"]=$qid;
      $uid=$row["userid"];
      $sql2="SELECT username FROM loginpage WHERE userid='$uid';";
      $result2=mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);
      $uname=$row2["username"];
      $sql1="SELECT tag FROM userquestions WHERE questionid='$qid';";
      $result1=mysqli_query($conn, $sql1);
      $row1=mysqli_fetch_assoc($result1);
      $tag=$row1["tag"];
  		if($row["category"]=="s"){
        echo "<blockquote class='social'><p><strong>$question</strong></p>
        <p class='tag'><span class='glyphicon glyphicon-tags'></span> Tags: $tag</p>
      <cite>Posted by $uname</cite>";
       }
      else{
      echo "<blockquote class='gadget'><p><strong>$question</strong></p>
      <p><span class='glyphicon glyphicon-tags'></span> Tags: $tag</p>
        <cite>Posted by $uname</cite>";
      }
  	     switch ($row["questiontype"]) {
        case 'mcq':
         $qid=$row["questionid"];
        $sql1="SELECT optionid, optionvalue FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op1=$row1["optionvalue"];
        $val=$row1["optionid"];
        echo" <form class='form-inline' action='anspost.php' method='post'>
        <div class='row'>
        <div class='col-sm-2'>
        <input type='radio' name=ans value='$val'> $op1
        </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op2=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <input type='radio' name=ans value='$val'> $op2
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op3=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <input type='radio' name=ans value='$val'> $op3
         </div>
        </div>
        <div class='checkbox'>
        <label><input type='checkbox' value='$qid' name='flag'><span class='glyphicon glyphicon-flag'></span> Flag as inappropriate</label>
        </div>
        <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Submit</button>
       </form>";
             $sql4="SELECT countop1,countop2,countop3 FROM mcqresult WHERE questionid='$qid';";
        $result4=mysqli_query($conn, $sql4);
        $row4=mysqli_fetch_assoc($result4);
       $res1=$row4["countop1"];
       $res2=$row4["countop2"];
       $res3=$row4["countop3"];
        echo "<div class='progress'>
  <div class='progress-bar progress-bar-success' role='progressbar' style='width:$res1%'>
    $op1 $res1 %
  </div>
  <div class='progress-bar progress-bar-warning' role='progressbar' style='width:$res2%'>
    $op2 $res2 %
  </div>
  <div class='progress-bar progress-bar-danger' role='progressbar' style='width:$res3%'>
    $op3 $res3 %
  </div>
</div>";
    $sql4="SELECT answerid FROM useranswer2 WHERE questionid='$qid';";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        echo"<form class='form-inline' action='txtpost.php' method='post'>
           <div class='form-group'>
            <input type='text' class='form-control' placeholder='Comment' name='comment'>
           </div>
           <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Comment</button>
           </form>";
        if (!$count) {
          break;
        }
        else
         { echo"<div class='result'><h4>$count Voted</h4></div>";}

            $sql4="SELECT answer,userid,ansdate FROM useranswer1 WHERE questionid='$qid' ORDER BY answerid DESC;";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        echo"<div class='result'><h4>$count Comments</h4></div>";
        if (!$count) {
          break;
        }
        else{
        echo "<div class='result-scroll'>";
        while($row4=mysqli_fetch_assoc($result4)){
       $res=$row4["answer"];
       $uid=$row4["userid"];
       $andate=$row4["ansdate"];
          $sql5="SELECT username FROM loginpage WHERE userid='$uid';";
        $result5=mysqli_query($conn, $sql5);
        $row5=mysqli_fetch_assoc($result5);
        $un=$row5["username"];
        echo "<div class='result'><br>$res";
        echo"<br><img class='img-circle' src='images/user1.png'><cite>Posted by $un on $andate</cite></p></div>";
        }echo "<div>";
        

          break;}
        
        case 'che':$qid=$row["questionid"];
        $sql1="SELECT optionvalue, optionid FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op1=$row1["optionvalue"];
        $val=$row1["optionid"];
        echo"<div class='row'>
        <form class='form form-inline' action='ansrat.php' method='post'>
         <div class='col-sm-2'>
          <div class='checkbox'>
           <input type='checkbox' value='$val' name='ans[]'> $op1
          </div>
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op2=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <div class='checkbox'>
           <input type='checkbox' value='$val' name='ans[]'> $op2
          </div>
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op3=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <div class='checkbox'>
           <input type='checkbox' value='$val' name='ans[]'> $op3
          </div>
         </div>
         <div class='checkbox'>
        <label><input type='checkbox' value='$qid' name='flag'> <span class='glyphicon glyphicon-flag'></span> Flag as inappropriate</label>
        </div>
         <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Submit</button>
         </form>
        </div>";
        $sql4="SELECT countop1,countop2,countop3 FROM mcqresult WHERE questionid='$qid';";
        $result4=mysqli_query($conn, $sql4);
        $row4=mysqli_fetch_assoc($result4);
       $res1=$row4["countop1"];
       $res2=$row4["countop2"];
       $res3=$row4["countop3"];
       echo "<div class='progress'>
  <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='res1'
  aria-valuemin='0' aria-valuemax='100' style='width:$res1%'>
    $op1  $res1 %
  </div>
</div>
<div class='progress'>
  <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='res2'
  aria-valuemin='0' aria-valuemax='100' style='width:$res2%'>
    $op2  $res2 %
  </div>
</div>
<div class='progress'>
  <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='res3'
  aria-valuemin='0' aria-valuemax='100' style='width:$res3%'>
    $op3  $res3 %
  </div>
</div>";
    $sql4="SELECT answerid FROM useranswer4 WHERE questionid='$qid';";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        echo"<form class='form-inline' action='txtpost.php' method='post'>
           <div class='form-group'>
            <input type='text' class='form-control' placeholder='Comment' name='comment'>
           </div>
           <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Comment</button>
           </form>";
        if (!$count) {
          break;
        }
        else
         { echo"<div class='result'><h4>$count Voted</h4></div>";}

            $sql4="SELECT answer,userid,ansdate FROM useranswer1 WHERE questionid='$qid' ORDER BY answerid DESC;";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        echo"<div class='result'><h4>$count Comments</h4></div>";
        if (!$count) {
          break;
        }
        else{
        echo "<div class='result-scroll'>";
        while($row4=mysqli_fetch_assoc($result4)){
       $res=$row4["answer"];
       $uid=$row4["userid"];
       $andate=$row4["ansdate"];
          $sql5="SELECT username FROM loginpage WHERE userid='$uid';";
        $result5=mysqli_query($conn, $sql5);
        $row5=mysqli_fetch_assoc($result5);
        $un=$row5["username"];
        echo "<div class='result'><br>$res";
        echo"<br><img class='img-circle' src='images/user1.png'><cite>Posted by $un on $andate</cite></p></div>";
        }echo "<div>";
        

          break;}
        case 'txt':
           echo"<form class='form-inline' action='anspost.php' method='post'>
           <div class='form-group'>
            <input type='text' class='form-control' placeholder='Post Your Answer' name='ans'>
           </div>
           <div class='checkbox'>
        <label><input type='checkbox' value='$qid' name='flag'><span class='glyphicon glyphicon-flag'></span> Flag as inappropriate</label>
        </div>
           <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Submit</button>
           </form>";
                  $qid=$row["questionid"];
           $sql4="SELECT answer,userid,ansdate FROM useranswer1 WHERE questionid='$qid' ORDER BY answerid DESC;";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        if (!$count) {
          break;
        }
        else{
          echo"<div class='result'><h4>$count Answered</h4></div>";
        echo "<div class='result-scroll'>";
        while($row4=mysqli_fetch_assoc($result4)){
       $res=$row4["answer"];
       $uid=$row4["userid"];
       $andate=$row4["ansdate"];
          $sql5="SELECT username FROM loginpage WHERE userid='$uid';";
        $result5=mysqli_query($conn, $sql5);
        $row5=mysqli_fetch_assoc($result5);
        $un=$row5["username"];
        echo "<div class='result'><br>$res";
        echo"<br><img class='img-circle' src='images/user1.png'><cite>Posted by $un on $andate</cite></p></div>";
        }echo "<div>";
           break;
        }
        default: echo"<form class='form form-inline' action='anspost.php' method='post'>
          <div class='form-group'>
            <input type='number' class='form-control' placeholder='Rating' name='ans' min='1' max='5'>
          </div>
          <div class='checkbox'>
        <label><input type='checkbox' value='$qid' name='flag'> <span class='glyphicon glyphicon-flag'></span> Flag as inappropriate</label>
        </div>
          <button class='btn btn-primary' type='Submit' name='Submit' value='$qid'> Submit</button>
           </form>";
            $qid=$row["questionid"];
                $sql4="SELECT answerid FROM useranswer3 WHERE questionid='$qid';";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        if (!$count) {
          break;
        }
        else
         { echo"<div class='result'><h4>$count Answered</h4></div>";}
            $sql4="SELECT average FROM mcqresult WHERE questionid='$qid'";
        $result4=mysqli_query($conn, $sql4);
        $row4=mysqli_fetch_assoc($result4);
       $res=$row4["average"];
       echo"<div class='result'><br>Average = $res/5</p></div>";
       }echo "</blockquote>";
     }}
       ?>
    </div>
  	<div class='col-sm-2'>
  		
  	</div>
  </div>
</div>
  <footer class='container-fluid text-center'>
      <h3>CONTACT</h3>
      <div class='row'>
        <div class='col-sm-4'>
        <p>For further queries and suggestions,</p>
        <span class='glyphicon glyphicon-map-marker'></span> Eranakulam<br>
        <span class='glyphicon glyphicon-envelope'></span> sreekanthps204@gmail.com<br> 
        <span class='glyphicon glyphicon-phone-alt'></span> +91 703 483 3312
        </div>
      </div> 
  </footer>
</body>
</html>