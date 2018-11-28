<?php 
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Pesanan</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="5" />
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
          echo '<li class="active" ><a href="pesanan.php">Pesanan</a></li>';
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
    <h3>Pesanan</h3>
    <?php
    $nrp_cust= $_SESSION['login_user']; 
    $result = mysqli_query($mysqli, "SELECT * FROM  pesanan WHERE nrp_pemesan=$nrp_cust ORDER BY id_pesanan DESC LIMIT 1");
    $row = $result->fetch_assoc();
    echo '<h4>Id : '.$row['id_pesanan'].'</h4>';  
    ?>
    </div>
    
     <table width='100%' class="table table-hover">
      <thead>
          <tr>
              <th>Nama Makanan</th> <th>Jumlah</th> <th>Total Harga</th> <th>Kurir</th> <th>Status</th> <th>Diterima</th>
          </tr>
         </thead>
         <tbody>
            <?php
              $nrp_cust= $_SESSION['login_user'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_pesanan ,makanan.id_makanan, makanan.nama_makanan, list_pesanan.jumlah, makanan.harga_makanan*list_pesanan.jumlah as total,list_pesanan.id_courier,list_pesanan.diterima FROM list_pesanan, makanan, pesanan WHERE list_pesanan.id_pesanan = pesanan.id_pesanan  AND list_pesanan.id_makanan=makanan.id_makanan AND pesanan.id_pesanan=(SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan = $nrp_cust ORDER BY id_pesanan DESC LIMIT 1)");
               while($row = $result->fetch_assoc()) {
                  echo '
                        <tr>
                        <form method="POST">
                            <td>'.$row["nama_makanan"].'</td>
                            <td>'.$row["jumlah"].'</td>
                            <td>Rp. '.$row["total"].',-</td>
                            <td>'.$row["id_courier"].'</td>
                            ';

                             
                              if( !$row["diterima"] ) echo "<td>Belum Diterima</td>";
                              else
                              if( $row["diterima"] = 1 ) echo "<td>Diterima Courier</td>";
                              else
                              if( $row["diterima"] = 2 ) echo "<td>Diterima</td>";
                            

                        echo  '
                        </form>
                        </tr>';
               } 
            ?>
            <!-- <?php
              $nrp_cust= $_SESSION['login_user'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_list ,list_pesanan.id_pesanan, makanan.nama_makanan, makanan.harga_makanan, list_pesanan.jumlah, list_pesanan.id_customer, list_pesanan.jumlah*makanan.harga_makanan as Total FROM list_pesanan, makanan WHERE list_pesanan.wilayah = '$wil_cour' AND list_pesanan.id_makanan = makanan.id_makanan AND list_pesanan.id_courier = 0  ORDER BY list_pesanan.id_pesanan ASC");
               while($row = $result->fetch_assoc()) {
                  echo '<tr><td></td><td>Total Bayar :</td><td>Rp. xxx.xxx,-</td><td></td></tr>';
               } 
            ?> -->
            
         </tbody>
     </table>
    </div>
<!--   </div>
  <div class="container">
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
  </div>
</div> -->

</body>
</html>
