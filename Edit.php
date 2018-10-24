<?php 
include('config.php');

$nrp = $_SESSION['login_user'];
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE nrp=$nrp");

while ($user_data = mysqli_fetch_array($result)){
	$nrp = $user_data['nrp'];
  $email = $user_data['email'];
  $pwd = $user_data['pwd'];
	$nohp = $user_data['nohp'];
	$idline = $user_data['idline'];
}
?>
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
        <?php
        if (isset($_SESSION['login_user'])){
          echo'<li><a href="Job.php">Job</a></li>';
        }
        ?>
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li class="active" ><a href="SignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
    </div>
  </div>
</nav>
  
<div class="container">
  <h2>Edit Profil </h2>
  <form action="SignUp.php" method="POST" name="form1">
    <div class="form-group">
      <label>NRP:</label>
      <input type="text" class="form-control" name="nrp" value=<?php echo $nrp;?>>
    </div>
    <div class="form-group">
      <label>Email:</label>
      <input type="email" class="form-control" name="email" value=<?php echo $email;?>>
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" class="form-control" name="pwd" value=<?php echo $pwd;?>>
    </div>
    <div class="form-group">
      <label>No HP:</label>
      <input type="text" class="form-control" name="nohp" value=<?php echo $nohp;?>>
    </div>
    <div class="form-group">
      <label>Line ID:</label>
      <input type="text" class="form-control" name="idline" value=<?php echo $idline;?>>
    </div>
    <input type="Submit" class="btn btn-default" name="Update">
  </form>
</div>
</body>
</html>

