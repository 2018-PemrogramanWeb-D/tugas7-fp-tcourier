<?php include('config.php') ?>

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
<?php
     $nama = $_SESSION['login_user'];
?>
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Edit.php"><span class="glyphicon glyphicon-user"></span> <?php echo "$nama"; ?> </a></li>
        <li><a href="Login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul> 
    </div>
  </div>
</nav>
  
<div class="container">
<h1>Select Job</h1>
</div>

</body>
</html>
