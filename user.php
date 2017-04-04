<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapi s.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .box{
      border-color: #000;
      border-style: solid;
      border-width: 1px;
      box-shadow: 5px 5px 5px grey;
      background-color: #e6e6e6;
    }
    #content{
      border-style: none;
      background-color: white;
    }
    footer{
      background-color: #2f2f2f;
      color: #fff;
      padding-top: 65px;
      padding-bottom: 65px;
      margin-top: 10px;
      margin-left: 0px;
      line-height: 38px;
    }
    .img-float {
    z-index: 1;
    position: fixed;
    box-shadow: 5px 5px 5px grey;
    opacity: 0.8;
    }
     body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
}

.navbar {
  margin-bottom: 2px;
    font-family: Montserrat, sans-serif;
    opacity: 0.8;
    letter-spacing: 3px;
}
cite{
  font-size: 13px;
  font-weight: normal;
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
.progress{
  margin-top: 5px;
}
  </style>
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
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="socialques.php">Social</a></li>
        <li><a href="gadgetques.php">Gadgets</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="form form-inline" action ="tagsearch.php" method="post">
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
    <div class="jumbotron text-center" style="background-image: url(images/feedback1.png); background-repeat: no-repeat; background-color: #ddd; background-position: bottom; color: white;">
      <h1><span><img src="images/user.png" height="70px" width="70px" class="img-circle"></span><?php echo"<h1>Welcome, <small>".$_SESSION["name"]."</small></h1>";?>
      </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 box">
          <img src="images/user.png" 
          class="img-circle" width=120px height=120px style="padding-top: 5px; margin-left: 30px;">
                    <?php echo "<h3>".$_SESSION["name"]."</h3>"; 
          $conn = mysqli_connect("localhost", "root", "", "miniproject");
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
    
          $id=$_SESSION["id"];
          $sql="SELECT COUNT(*) as count FROM userquestions WHERE userid='$id';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
          $val=$row["count"];
          $sql1="SELECT COUNT(*) as count1 FROM useranswer1 WHERE userid='$id';";
          $result1=mysqli_query($conn, $sql1);
          $row1=mysqli_fetch_assoc($result1);
          $value1=$row1["count1"];
           $sql1="SELECT COUNT(*) as count2 FROM useranswer2 WHERE userid='$id';";
          $result1=mysqli_query($conn, $sql1);
          $row1=mysqli_fetch_assoc($result1);
          $value2=$row1["count2"];
           $sql2="SELECT COUNT(*) as count3 FROM useranswer3 WHERE userid='$id';";
          $result2=mysqli_query($conn, $sql2);
          $row1=mysqli_fetch_assoc($result2);
          $value3=$row1["count3"];
          $value=$value1+$value2+$value3;
          $sql="SELECT usertype FROM loginpage where userid='$id';";
          $result=mysqli_query($conn, $sql);
          $row1=mysqli_fetch_assoc($result);
          if ($row1["usertype"]=='c') {
            $utype='Casual';
            $_SESSION["type"]=$utype;
          }
          else{
            $utype='Seller';
            $_SESSION["type"]=$utype;
          }
          echo"<p><img class='img-circle' src='images/user1.png'> $utype</p><br>
          <p><strong>Stats:</strong></p><br>
          <p>Polls Posted: $val</p>
          <p>Polls Voted: $value</p><br>
        </div>";?>
        <div class="col-sm-7" >
          <?php
    if (!$val) {
      echo "<div class='text-center'>
      <h2>Hmm..you seem to be a noobie.<br> click on the pencil icon to post a question.</h2><br>
      <img src='images/noob.jpg' style='opacity: 0.3'> </div>";
    }
    $sql="SELECT * FROM userquestions WHERE userid='$id' ORDER BY questionid DESC;";
    $result=mysqli_query($conn, $sql);
    while ($row=mysqli_fetch_assoc($result)) {
      $question=$row["question"];
      $qid=$row["questionid"];
      $sql1="SELECT tag FROM userquestions WHERE questionid='$qid';";
      $result1=mysqli_query($conn, $sql1);
      $row1=mysqli_fetch_assoc($result1);
      $tag=$row1["tag"];
      if($row["category"]=="s"){
        echo "<blockquote class='social'><p><h3>$question</h3></p>
        <p class='tag'><span class='glyphicon glyphicon-tags'></span> Tags: $tag</p>
      <cite>in Social Issues</cite>";
      echo"<form method='post' action='userremove.php'>
       <button type='submit' name='submit' class='btn btn-danger' value='$qid'> Remove Question</button></form>";
      if (!($row["visibility"])) {
          echo "<br><h4 style='color: red;'>Question Removed by Admin</h4></blockquote>";
          continue;
        }
       }
      else{
      echo "<blockquote class='gadget'><p><h2>$question</h2></p>
      <p class='tag'><span class='glyphicon glyphicon-tags'></span> Tags: $tag</p>
        <cite>in Gadgets</cite>";
        echo"<form method='post' action='userremove.php'>
       <button type='submit' name='submit' class='btn btn-danger' value='$qid'> Remove Question</button></form>";
        if (!($row["visibility"])) {
         echo "<br><h4 style='color: red;'>Question Removed by Admin</h4></blockquote>";
         continue;
        }
      }
      switch ($row["questiontype"]) {
        case 'mcq':
        $qid=$row["questionid"];
        $sql1="SELECT optionid, optionvalue FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op1=$row1["optionvalue"];
         $row1=mysqli_fetch_assoc($result1);
         $op2=$row1["optionvalue"];
         $row1=mysqli_fetch_assoc($result1);
         $op3=$row1["optionvalue"];
           $sql4="SELECT countop1,countop2,countop3 FROM mcqresult WHERE questionid='$qid'";
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
        if (!$count) {
          break;
        }
        else
         { echo"<div class='result'><h4>$count Answered</h4></div>";}
        echo"<div class='result'><br>$op1--$res1%<br>$op2--$res2%<br>$op3--$res3%<br></p></div>";
          break;
        case 'che':$qid=$row["questionid"];
        $sql1="SELECT optionvalue,optionid FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op1=$row1["optionvalue"];
         $row1=mysqli_fetch_assoc($result1);
         $op2=$row1["optionvalue"];
         $row1=mysqli_fetch_assoc($result1);
         $op3=$row1["optionvalue"];
        $sql4="SELECT countop1,countop2,countop3 FROM mcqresult WHERE questionid='$qid'";
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
        if (!$count) {
          break;
        }
        else
         { echo"<div class='result'><h4>$count Answered</h4></div>";}
       echo"<div class='result'><br>$op1--$res1%<br>$op2--$res2%<br>$op3--$res3%<br></p></div>";
          break;
        case 'txt':
           $qid=$row["questionid"];
           $sql4="SELECT answer,userid,ansdate FROM useranswer1 WHERE questionid='$qid' ORDER BY ansdate DESC;";
        $result4=mysqli_query($conn, $sql4);
        $count=mysqli_num_rows($result4);
        echo"<div class='result'><h4>$count Answers</h4></div>";
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
        echo"<br><cite><img class='img-circle' src='images/user1.png'>Posted by $un on $andate</cite></p></div>";
        }echo "<div>";
           break;
        default:
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
       echo"<div class='result'><br>average=$res/5</p></div>";
           break;
       } echo"</blockquote><hr>";
    }
  ?>
        </div>
        <div class="col-sm-3 box" id="rate">
          <h3>Trending Apps:</h3>
          <img src="images/android.png" height="80px" width="80px"><br>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
          <h3>Cinemas:</h3>
          <img src="images\movies.jpeg" height="80px" width="80px"><br>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
          <h3>Songs:</h3>
          <img src="images\music.jpg" class="img-circle" height="80px" width="80px"><br>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
          <p>Some text</p>
        </div>
        <div class="img-float">
         <a href="Questions.html"><img src="images\q.png" height="80px" width="80px"> </a>
        </div>
      </div>
    </div>
    <footer class="container-fluid text-center">
      <h3>CONTACT</h3>
      <div class="row">
        <div class="col-sm-4">
        <p>For further queries and suggestions,</p>
        <span class="glyphicon glyphicon-map-marker"></span> Eranakulam<br>
        <span class="glyphicon glyphicon-envelope"></span> sreekanthps204@gmail.com<br> 
        <span class="glyphicon glyphicon-phone-alt"></span> +91 703 483 3312
        </div>
      </div> 
  </footer>
  </body>
 </html>