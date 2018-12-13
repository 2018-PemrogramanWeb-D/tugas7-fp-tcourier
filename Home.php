<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home || TCourier</title>

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
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> TC<span class="light">ourier</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
 
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a  class="page-scroll" href="#download">Contact Us</a>
                    </li>

        <?php
        if (isset($_SESSION['login_user'])){
           echo '
                        <li>
                        <a class="page-scroll" href="'.$_SESSION["page"].'.php" >Continue</a>
                        </li>
                        ';
        }
        else 
        {    echo '
                        <li>
                        <a class="page-scroll" href="login.php" >Start</a>
                        </li>
                        ';
        }
        ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container animate-bottom" style="display:none;" id="myDiv">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <br><br>
                        <h1 class="brand-heading">TCourier</h1>
                        <p class="intro-text">Go-Food Nya anak TC
                            <!-- <br> Sekaligus merekatkan diri antar mahasiswa TC -->
                            <br>LOL :D</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section  <div style="display:none;" id="myDiv" class="animate-bottom">-->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About TCourier</h2>
                <p>TCourier adalah sebuah website pelayanan makan antar Online bagi mahasiswa TC. Selain itu kita juga bisa saling merekatkan ukhuwah antar mahasiswa TC. Kalian bisa dapet uang jajan tambahan juga Gan.</p>
                <p>Sistem Pengantarannya COD ya biar bisa saling kenal juga. Kalo beruntung bisa dapet gandengan Gan. <br> <strong>ASEEEEKKK</strong></p>
                <P>NO JOMBLO LYFE</P>
                        <a href="#download" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                </div>
            </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Contact US</h2>

                    <p>Mahasiswa Pweb GG</p>
                    <ul class="list-inline banner-social-buttons">
                        <li>05111740000025</li>
                        <li>05111740000051</li>
                        <li>05111740000055</li>
                    </ul>
                    <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://github.com/2018-PemrogramanWeb-D/tugas7-fp-tcourier" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                </ul>
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

</html>
