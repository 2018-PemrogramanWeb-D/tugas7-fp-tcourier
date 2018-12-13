<?php  include('config.php');  $_SESSION['page'] = 'courier';?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Courier || TCourier</title>
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

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
if (!$_SESSION['fix']) {
  echo '<li><a href="job.php"><span class="glyphicon glyphicon-wrench"></span> Go to job</a></li>';
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
<div class="container">
  <div class="page-header align-center">
    <h2 id="signup">Courier</h2>
  </div>
  <div ></div>
<?php
if (!$_SESSION['fix']) {
  echo '
  <form method="POST">
<!-- Pilih Wilayah :  -->

          <select name="wil_cour" class="btn btn-default dropdown-toggle" onchange="this.form.submit();">
            <option value="NULL" selected >Tinjau Daerah Operasi.....</option>';
            
              $result = mysqli_query($mysqli, "SELECT * FROM wilayah ");
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <option value='".$row['id_wilayah']."'>".$row['nama_wilayah']."</option>
                         ";
                  }
              }
    echo '
            </select>
        
    </div>
    </form>
      <form method="POST">
<!-- Pilih Wilayah :  -->
<input type="submit" class="btn btn-default" value="Pilih" name="wil_cour_fix">
';

}
?>     
    </div>
    </form>
  <div class="left">

<div class="container">
        <?php
    $lol = $_SESSION['wil_cour'];
    $result = mysqli_query($mysqli, "SELECT nama_wilayah FROM wilayah WHERE id_wilayah='$lol' ");
    $row = $result->fetch_assoc();
    $lol = $row['nama_wilayah'];
    ?>
  <h3>Daftar Pesanan <?php echo $lol ?></h3>
 


  
    <div class="row">
    <form name="pesanan_makanan" method="post">
     <table width='100%' class="table ">
      <thead>
          <tr>
              <th>Pemesan</th> <th>Nama Makanan</th> <th>Jumlah</th>  <th>Total Harga</th> <?php if ($_SESSION['fix']) {
                echo "<th>Pilih</th>";
              } ?>
          </tr>
         </thead>
         <tbody>
            <?php
              // $nrp_cust= $_SESSION['login_user'];
              $wil_cour = $_SESSION['wil_cour'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_list ,list_pesanan.id_pesanan, makanan.nama_makanan, makanan.harga_makanan, list_pesanan.jumlah, list_pesanan.id_customer, list_pesanan.jumlah*makanan.harga_makanan as Total FROM list_pesanan, makanan WHERE list_pesanan.wilayah = '$wil_cour' AND list_pesanan.id_makanan = makanan.id_makanan AND list_pesanan.id_courier = 0  ORDER BY list_pesanan.id_pesanan ASC");
               while($row = $result->fetch_assoc()) {
                  echo '
                    <tr>
                        <td>'.$row["id_customer"].'</td>
                        <td>'.$row["nama_makanan"].'</td>
                        <td>'.$row["jumlah"].'</td>
                        <td>Rp. '.$row["Total"].',-</td>
                        <input type="hidden" name="id_list" readonly value="'.$row["id_list"].'">
                        ';
              if ($_SESSION['fix']) {echo '<td><input type="Submit" class="btn btn-link" value="Pilih" name="acc"></td>';}  
              echo "</tr>";                          
               } 
            ?>
         </tbody>
     </table>
    </form>
  <div>
<br><br>
<?php if ($_SESSION['fix']) {
echo '
  <div>
<h3>Pesanan di ACC</h3>
</div>
    <form name="pesanan_makanan" method="post">
     <table width="100%"" class="table">
      <thead>
          <tr>
              <th>Pemesan</th> <th>Nama Makanan</th> <th>Jumlah</th>  <th>Total Harga</th> <th>Hapus</th>
          </tr>
         </thead>
         <tbody>';
            
              $nrp_cour= $_SESSION['login_user'];

              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_list ,list_pesanan.id_pesanan, makanan.nama_makanan, makanan.harga_makanan, list_pesanan.jumlah, list_pesanan.id_customer, list_pesanan.jumlah*makanan.harga_makanan as Total FROM list_pesanan, makanan WHERE list_pesanan.diterima != 2 AND list_pesanan.wilayah = '$wil_cour' AND list_pesanan.id_makanan = makanan.id_makanan AND list_pesanan.id_courier = '$nrp_cour'  ORDER BY list_pesanan.id_pesanan ASC");
               while($row = $result->fetch_assoc()) {
                  echo '
                        <tr>
                        <form method="POST">
                            <td>'.$row["id_customer"].'</td>
                            <td>'.$row["nama_makanan"].'</td>
                            <td>'.$row["jumlah"].'</td>
                            <td>RP. '.$row["Total"].',-</td>
                            <input type="hidden" name="id_list" readonly value="'.$row["id_list"].'">
                            <td><button type="Submit" name="drop" class="btn btn-link"> <span class="glyphicon glyphicon-remove"> </span> </button> </td>
                        </form>
                        </tr>';
               } 
      echo '
         </tbody>
     </table>
  
    <div class="center">
     <input type="Submit" class="btn btn-default" name="submitpesanancour" value="Berangkat">
    </div>
    </form>
    </div>
    ';
} ?>
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
