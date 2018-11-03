<?php 
include('config.php'); 
// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Select Job</title>
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
        <li><a href="Home.php">Home</a></li>
        <li><a href="About.php">About</a></li>
        <?php
        if (isset($_SESSION['login_user'])){
          if ($_SESSION['job'] ==  'courier') echo '<li><a href="Courier.php">Job</a></li>';
          else if ($_SESSION['job'] ==  'customer') echo '<li><a href="Customer.php">Job</a></li>';
          else  echo'<li><a href="Job.php">Job</a></li>';
      }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
         if (isset($_SESSION['login_user'])){
          echo '<li><a href="Edit.php"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['login_user'].'</a></li>';
          echo '<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
        }
        ?>
      </ul> 
    </div>
  </div>
</nav>
<!-- .......... -->
<div class="container">
  <div class="page-header align-center">
    <h2>Pilih Job</h2>
  </div>
  <div action='config.php' class="container">
  <form method="POST">
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-link" value="courier" name="job"><img src="img/courier.png" class="img-circle img-responsive" alt="Courier"></button>
        </div> 
        <div class="col-sm-2"></div>
        <div class="col-sm-4"> 
          <button type="submit" class="btn btn-link" value="customer" name="job"><img src="img/courier.png" class="img-circle img-responsive" alt="Courier"></button>
        </div>
        <div class="col-sm-1"></div>   
      </div>
  </form>
  </div>
</div>

    
</body>
</html>
