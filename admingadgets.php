<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .box{
      border-color: #000;
      border-style: solid;
      border-width: 1px;
      box-shadow: 5px 5px 5px grey;
      background-color: #e6e6e6;
    }
    .btn-success{
      margin-bottom: 8px;
    }
    .btn-danger{
      margin-bottom: 8px;
    }
    #content{
      border-style: none;
      background-color: #eee;
    }
    .img-float {
    box-shadow: 5px 5px 5px grey;
    z-index: 1;
    position: fixed;
    opacity: 0.8;
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
    .navbar{
      margin-bottom: 2px;
      opacity: 0.8;
      letter-spacing: 3px;
    }
     body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
}
.navbar {
    font-family: Montserrat, sans-serif;
}
blockquote{
  box-shadow: 5px 5px 5px grey;
  border-radius: 4px;
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
        <li><a href="admin.html"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="adminsocial.php">Social</a></li>
        <li class="active"><a href="#">Gadgets</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="home.html"><span class="glyphicon glyphicon-off"></span>Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="jumbotron text-center" style="background-image: url(images/admin1.png); color: white;">
      <h1><span>Welcome,<small>Admin!</small></h1>
      </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 box">
        </div>
        <div class="col-sm-7 text-center">
        <?php
      $conn = mysqli_connect("localhost", "root", "", "miniproject");
      if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
    $id=$_SESSION["id"];
    $sql="SELECT * FROM userquestions WHERE category='g' AND flag='1' AND visibility='1';";
    $result=mysqli_query($conn, $sql);$flag=0;
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
      echo "<blockquote><p><strong>$question</strong><br><cite>Posted by $uname</cite></p>";
      $flag=1;
      echo "<form class='form form-inline'>
      <button class='btn btn-success' name='allow' type='submit' value='$qid'><span class='glyphicon glyphicon-ok'></span> Allow</button>
      <button class='btn btn-danger' name='remove' type='submit' value='$qid'><span class='glyphicon glyphicon-remove'></span> Remove</button><br>
       </form>";
       echo"</blockquote><hr>";
    }
    if (!$flag) {
         echo "<div class='text-center'>
      <h2>Set back and relax.<br> Everything seems to be in order.</h2><br>
      <img src='images/relax.jpg' style='opacity: 0.3'> </div>";
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