<?php include('config.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Sign Up</title>
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
      <a class="navbar-brand" href="#">TCourier</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="Home.php">Home</a></li>
        <li><a href="About.php">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active" ><a href="SignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="page-header align-center">
    <h2>SignUp TCourier</h2>
  </div>
  <div class="row">
        <div class="col-sm-3"></div> 
        <div class="col-sm-6">
        <form method="POST" name="form1">
            <div class="form-group">
              <label>NRP:</label>
              <input type="number" class="form-control" placeholder="Enter NRP" name="nrp">
            </div>
            <div class="form-group">
              <label>Nama:</label>
              <input type="text" class="form-control" placeholder="Enter your name" name="email">
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input type="email" class="form-control" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label>Password:</label>
              <input type="password" class="form-control" placeholder="Enter password" name="pwd">
            </div>
            <div class="form-group">
              <label>No HP:</label>
              <input type="number" class="form-control" placeholder="Enter No HP" name="nohp">
            </div>
            <div class="form-group">
              <label>Line ID:</label>
              <input type="text" class="form-control" placeholder="Enter Line ID" name="idline">
            </div>
            <input type="Submit" class="btn btn-default" name="SignUp">
        </form>
        </div>
        <div class="col-sm-3"></div>
  </div>
    
</div>
</body>
</html>

