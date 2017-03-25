<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Social</title>
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
        <li><a href="user.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="socialques.php">Social</a></li>
        <li class="active"><a href="#">Gadgets</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li id=w>
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
           $sql1="SELECT COUNT(*) as count3 FROM useranswer3 WHERE userid='$id';";
          $result1=mysqli_query($conn, $sql1);
          $row1=mysqli_fetch_assoc($result1);
          $value3=$row1["count3"];
          $value=$value1+$value2+$value3;
          echo"<p><em>Hai i, happens to be the first human here!</em></p><br>
          <p><strong>Stats:</strong></p><br>
          <p>Polls Posted: $val</p>
          <p>Polls Voted: $value</p><br>
        </div>";?>
        <div class="col-sm-7 text-center" >
    <?php
    $id=$_SESSION["id"];
    $sql="SELECT * FROM userquestions WHERE category='g' AND visibility='1';";
    $result=mysqli_query($conn, $sql);
    while ($row=mysqli_fetch_assoc($result)) {
      $question=$row["question"];
        $qid=$row["questionid"];
       $sql1="SELECT userid FROM userquestions WHERE questionid='$qid';";
      $result1=mysqli_query($conn, $sql1);
      $row1=mysqli_fetch_assoc($result1);
      $uid=$row1["userid"];
      $sql2="SELECT username FROM loginpage WHERE userid='$uid';";
      $result2=mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);
      $uname=$row2["username"];
      echo "<blockquote><p><strong>$question</strong><br><cite>$uname</cite></p>";
      switch ($row["questiontype"]) {
        case 'mcq':
        $qid=$row["questionid"];
        $sql1="SELECT optionid, optionvalue FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op=$row1["optionvalue"];
        $val=$row1["optionid"];
        echo" <form class='form-inline' action='anspost.php' method='post'>
        <div class='row'>
        <div class='col-sm-2'>
        <input type='radio' name=ans value='$val'> $op
        </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <input type='radio' name=ans value='$val'> $op
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op=$row1["optionvalue"];
         $val=$row1["optionid"];
         echo"<div class='col-sm-2'>
          <input type='radio' name=ans value='$val'> $op
         </div>
        </div>
        <button class='btn btn-primary' type='submit' name='submit' value='$qid'> submit</button>
       </form>";
          break;
        
        case 'che':$qid=$row["questionid"];
        $sql1="SELECT optionvalue FROM optiontable WHERE questionid='$qid';";
        $result1=mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $op=$row1["optionvalue"];
        echo"<div class='row' action='anspost.php' method='post'>
        <form class='form-inline'>
         <div class='col-sm-2'>
          <div class='checkbox'>
           <label><input type='checkbox' value='1'>$op</label>
          </div>
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op=$row1["optionvalue"];
         echo"<div class='col-sm-2'>
          <div class='checkbox'>
           <label><input type='checkbox' value='2'>$op</label>
          </div>
         </div>";
         $row1=mysqli_fetch_assoc($result1);
         $op=$row1["optionvalue"];
         echo"<div class='col-sm-2'>
          <div class='checkbox'>
           <label><input type='checkbox' value='3'>$op</label>
          </div>
         </div>
         <button class='btn btn-primary' type='submit' name='submit' value='$qid'> submit</button>
         </form>
        </div>";
          break;
        case 'txt':
           echo"<form class='form-inline' action='anspost.php' method='post'>
           <div class='form-group'>
            <input type='text' class='form-control' placeholder='Post Your Answer' name='ans'>
           </div>
           <button class='btn btn-primary' type='submit' name='submit' value='$qid'> submit</button>
           </form>";
           break;
        default: echo"<form class='form-inline' action='anspost.php' method='post'>
          <div class='form-group'>
            <input type='number' class='form-control' placeholder='Rating' name='ans'>
          </div>
          <button class='btn btn-primary' type='submit' name='submit' value='$qid'> submit</button>
           </form>";
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