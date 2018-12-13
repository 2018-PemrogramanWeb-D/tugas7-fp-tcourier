<?php include('config.php'); $_SESSION['page'] = 'job'; ?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Job || TCourier</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">
</head>

<body onload="myFunction()" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="home.php">
                    <i class="fa fa-play-circle"></i> TC<span class="light">ourier</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
        <?php
         if (isset($_SESSION['login_user'])){
          echo '<li><a href="edit.php"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['login_user'].'</a></li>';
          echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
        }
        ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<section id="about" class="container intro">
<br><br><br><br>
<div class="container animate-bottom" style="display:none;" id="myDiv">
  <div class="page-header align-center">
    <h2 id="signup">Pilih Job</h2><br>
        <div class="row">

        <div class="col-sm-"></div>
        <div class="col-sm-5 "><h4>Courier</h4></div> 
        <div class="col-sm-2"></div>
        <div class="col-sm-3 "><h4>Customer</h4></div>
        <div class="col-sm-2"></div>   

        </div>
  </div>
  <div class="left">
  <div class="row">

        <div class="col-sm-1"></div>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-link" value="courier" name="job1"><img src="img/courier.png" class="img-circle img-responsive" alt="Courier" data-toggle="modal" data-target="#myModalcourier"></button>
        </div> 
        <div class="col-sm-2"></div>
        <div class="col-sm-4"> 
          <button type="submit" class="btn btn-link" value="customer" name="job1"><img src="img/food.png" class="img-circle img-responsive" alt="Courier" data-toggle="modal" data-target="#myModalcustomer"></button>
        </div>
        <div class="col-sm-1"></div>   

  </div>

    
</div>
</div>

    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; TCourier 2018</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>
</body>
<div class="tulis">
<div class="modal" id="myModalcustomer">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Alert!!!</h2>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Apakah yakin ingin melanjutkan sebagai customer...???
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" value="customer" name="job" class="btn btn-primary submitBtn">Lanjutkan</button> 
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal" id="myModalcourier">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h2 class="modal-title">Alert!!!</h2>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Apakah yakin ingin melanjutkan sebagai courier ...???
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" value="courier" name="job" class="btn btn-primary submitBtn">Lanjutkan</button> 
          </form>
        </div>
        
      </div>
    </div>
  </div>
  </div>
</html>
