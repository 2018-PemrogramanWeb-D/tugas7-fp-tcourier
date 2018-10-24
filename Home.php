<?php 
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">TCourier</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active" ><a href="Home.php">Home</a></li>
        <li><a href="About.php">About</a></li>
        <?php
        if (isset($_SESSION['login_user'])){
          echo'<li><a href="Job.php">Job</a></li>';
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if (isset($_SESSION['login_user'])){
          echo '<li><a href="Edit.php"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['login_user'].'</a></li>';
          echo '<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
        }
        else {
          echo'<li><a href="SignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
          echo'<li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
        } 
        ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="page-header align-center">
    <h2>Home</h2>
  </div>
  <div class="container">
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
  </div>
</div>

</body>
</html>
