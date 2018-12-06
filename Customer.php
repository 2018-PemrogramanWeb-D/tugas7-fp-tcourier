<?php  include('config.php');   ?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customer || TCourier</title>
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

<body onload="myFuntion()" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div style="display:none;" id="myDiv" class="intro animate-bottom">
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="Home.php">
                    <i class="fa fa-play-circle"></i> TC<span class="light">ourier</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
             <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">

                <li><a href="Job.php"><span class="glyphicon glyphicon-wrench"></span> Go to job</a></li>
        
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<section id="about" class="container intro">
<br><br><br><br>
<div class="container">
  <div class="page-header align-center">
    <h2 id="signup">Pilih Pesanan Anda</h2>
  </div>
  <div class="left">
  <div class="row">


  
  <div class="container">
  <div class="row">
<div class="center">
    <!-- <div class="center"> -->
    <form method="POST">
      <!-- Pilih Wilayah :  -->
          <select name="wil_cust" class="btn btn-default dropdown-toggle" onchange="this.form.submit();">
            
            <option value="NULL" selected >Select Menu Area...</option>

            <?php
              $result = mysqli_query($mysqli, "SELECT * FROM wilayah ");
              if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "
                        <option value='".$row['id_wilayah']."'>".$row['nama_wilayah']."</option>
                       ";
                }
            }
            ?>
            </select>

        </form>
        </div>
        <!-- </div> -->
  </div>
        

  </div><br>
  
      <div class="row">
    <?php
    $lol = $_SESSION['wil_cust'];
    $result = mysqli_query($mysqli, "SELECT nama_wilayah FROM wilayah WHERE id_wilayah='$lol' ");
    $row = $result->fetch_assoc();
    $lol = $row['nama_wilayah'];
    ?>

  <h3>Daftar Menu <?php echo $lol ?></h3>
          <table width='100%' class="table">
          <thead>
          <tr>
              <th>Nama Makanan</th> <th>Harga</th> <th>Deskripsi Makanan</th> <th class="col-sm-1">Jumlah</th> <th>Pilih Makanan</th>
          </tr>
          </thead>
          <tbody>
          <form id=myForm method="POST">

                    <?php
                      $wil_cust = $_SESSION['wil_cust'];
                      $result = mysqli_query($mysqli, "SELECT * FROM makanan WHERE wilayah_makanan = '$wil_cust' ");
                      if ($result->num_rows > 0) {

                      while($row = $result->fetch_assoc()) {
                          echo '
                        <tr>
                        <form method="POST">

                            <td>'.$row["nama_makanan"].'</td>
                            <td>Rp. '.$row["harga_makanan"].',-</td>
                            <td>'.$row["deskripsi_makanan"].'</td>
                            <td> <input min="1" type="number" class="form-control" value="0" name="jumlah" > </td>
                            <input type="hidden" name="id_makanan" readonly value="'.$row["id_makanan"].'">
                            <td><input type="Submit" class="btn btn-link" value="Pilih" name="pilih"></td>        
                        </form>
                        </tr>';
                        }
                    }
                    ?> 
          </form>
          </tbody>
          </table>
    </div>
    <div class="row">
    <h3>Pesanan</h3>
    <?php
    
    $nrp_cust= $_SESSION['login_user']; 
    $result = mysqli_query($mysqli, "SELECT * FROM  pesanan WHERE nrp_pemesan=$nrp_cust ORDER BY id_pesanan DESC LIMIT 1");
    $row = $result->fetch_assoc();
    echo '<h4>Id : '.$row['id_pesanan'] .'</h4>';  
    ?>

    <form name="pesanan_makanan" method="post">
     <table width='100%' class="table">
        <thead>
          <tr>
              <th>Nama Makanan</th> <th>Jumlah</th> <th>Total Harga</th> <th>Hapus</th>
          </tr>
         </thead>
         <tbody>
              <?php
              $nrp_cust= $_SESSION['login_user'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_pesanan ,makanan.id_makanan, makanan.nama_makanan, list_pesanan.jumlah, makanan.harga_makanan*list_pesanan.jumlah as total FROM list_pesanan, makanan, pesanan WHERE list_pesanan.id_pesanan = pesanan.id_pesanan  AND list_pesanan.id_makanan=makanan.id_makanan AND pesanan.id_pesanan=(SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan = '$nrp_cust' ORDER BY id_pesanan DESC LIMIT 1)");
               while($row = $result->fetch_assoc()) {
                  echo '
                        <tr>
                        <form method="POST">
                            <td>'.$row["nama_makanan"].'</td>
                            <td>'.$row["jumlah"].'</td>
                            <td>Rp. '.$row["total"].',-</td>
                            <input type="hidden" name="id_list" readonly value="'.$row["id_pesanan"].$row["id_makanan"].'">
                            <td><button type="Submit" name="remove" class="btn btn-link"> <span class="glyphicon glyphicon-remove"> </span> </button> </td>
                        </form>
                        </tr>';
               } 
            ?>
         </tbody>
     </table>
     <div class="center">
     <input type="Submit" class="btn btn-default" name="submitpesanancust" value="Pesan">
    </div>
    </form>
    </div>
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
  </div>
</body>
</html>
