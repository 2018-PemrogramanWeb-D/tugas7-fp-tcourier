<?php  include('config.php');  $_SESSION['page'] = 'pesanancust'; 
if($_SESSION['login_admin']!=NULL){
  header("Location: admin.php");
}
else if($_SESSION['login_user']!=NULL){
  if ($_SESSION['job'] == NULL) {
  header("Location: job.php");
  }
}else if($_SESSION['login_user']==NULL){
  header("Location: login.php");
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="refresh" content="10" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pesanan || TCourier</title>
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


        </div>
        <!-- /.container -->
    </nav>

<section id="about" class="container intro">
<br><br><br><br>
<div class="container">
  <div class="page-header align-center">
    <h2 id="signup">Pesanan</h2>
  </div>
  <div class="left">
    <?php
    $nrp_cust= $_SESSION['login_user']; 
    $result = mysqli_query($mysqli, "SELECT * FROM  pesanan WHERE nrp_pemesan=$nrp_cust ORDER BY id_pesanan DESC LIMIT 1");
    $row = $result->fetch_assoc();
    echo '<h4>Id : '.$row['id_pesanan'].'</h4>';  
    ?>
    
     <table width='100%' class="table">
      <thead>
          <tr>
              <th>Nama Makanan</th> <th>Jumlah</th> <th>Total Harga</th> <th>Kurir</th><th>Status</th>
          </tr>
         </thead>
         <tbody>

            <?php
              $nrp_cust= $_SESSION['login_user'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_pesanan , makanan.nama_makanan, list_pesanan.jumlah, makanan.harga_makanan*list_pesanan.jumlah as total,list_pesanan.id_courier,list_pesanan.diterima FROM list_pesanan, makanan, pesanan WHERE list_pesanan.id_pesanan = pesanan.id_pesanan  AND list_pesanan.id_makanan=makanan.id_makanan AND pesanan.id_pesanan=(SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan = $nrp_cust ORDER BY id_pesanan DESC LIMIT 1)");
               
              $Totalharga = "0";
              $id_pesanan = $row["id_pesanan"];
              $flag = true;
               while($row = $result->fetch_assoc()) {
                if( $row["diterima"] !=2 ){
                  $flag = false;
                }
                $Totalharga += $row["total"];
                  echo '
                        <tr>
                        <form method="POST">
                            <td>'.$row["nama_makanan"].'</td>
                            <td>'.$row["jumlah"].'</td>
                            <td>Rp. '.$row["total"].',-</td>
                            <td>'.$row["id_courier"].'</td>
                            ';

                             
                              if( $row["diterima"] ==0 ) {echo "<td>Belum Diproses</td>";}
                              else
                              if( $row["diterima"] == 1 ) {echo "<td>Sedang Diproses</td>";}
                              else
                              if( $row["diterima"] == 2 ) {echo "<td>Diterima <span class='glyphicon glyphicon-ok'></span></td>";}
                            

                        echo  '
                        </form>
                        </tr>';
               } 
            ?>

            <tr>
              <th>Total</th><th></th> <th>RP. <?php echo $Totalharga; ?>,-</th><th></th> <th></th>
            </tr>
            
         </tbody>
     </table>
     <div class="center">
            <?php 
              if ($flag) {
                echo '<a href="job.php" class="btn btn-default" >Back To Job</a>';
              }
            ?>
     </div>
    <h4>Info Courier</h4>
        <table width='50%' class="table">
      <thead>
          <tr>
              <th>NRP</th> <th>Nama Courier</th> <th>No. WA</th> <th>ID Line</th> <th>Fee</th><th>Total per Courier</th>
          </tr>
         </thead>
         <tbody>

            <?php
              $result = mysqli_query($mysqli, "SELECT DISTINCT list_pesanan.id_courier, users.nama, users.nohp, users.idline, wilayah.ongkos_wilayah  FROM list_pesanan, users, wilayah WHERE list_pesanan.id_pesanan = '$id_pesanan' AND list_pesanan.id_courier = users.nrp AND list_pesanan.wilayah = wilayah.id_wilayah ");
              
              while($row = $result->fetch_assoc()) {
                  echo '
                        <tr>
                        <form method="POST">
                            <td>'.$row["id_courier"].'</td>
                            <td>'.$row["nama"].'</td>
                            <td>'.$row["nohp"].'</td>
                            <td>'.$row["idline"].'</td>
                            <td>Rp. '.$row["ongkos_wilayah"].',-</td>';
                            $id_courier = $row["id_courier"];
                 $cour = mysqli_query($mysqli, "SELECT SUM(list_pesanan.jumlah*makanan.harga_makanan) AS Totalcour FROM list_pesanan, makanan WHERE list_pesanan.id_courier = '$id_courier' AND list_pesanan.id_pesanan = '$id_pesanan' AND makanan.id_makanan = list_pesanan.id_makanan ");
                 $list = $cour->fetch_assoc();
                 $bayaran = $list["Totalcour"] + $row["ongkos_wilayah"];
                  echo '<td>Rp. '.$bayaran.',-</td>
                        </form>
                        </tr>';
               } 
            ?>
         </tbody>
     </table>

    </div>



</div>
</div>

    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <h5>Copyright &copy; TCourier 2018</h5>
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
