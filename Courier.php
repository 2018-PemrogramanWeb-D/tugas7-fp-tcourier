<?php 
include('config.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Courier</title>
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
          if ($_SESSION['job'] ==  'courier') echo '<li class="active" ><a href="Courier.php">Courier</a></li>';
          else if ($_SESSION['job'] ==  'customer') echo '<li class="active" ><a href="Customer.php">Customer</a></li>';
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
  
<div class="container">
  <div class="page-header align-center">
    <h2>Courier</h2>
  </div>

  <div class="row">
  
  <div class="col-sm-2">

        <form method="POST">
<!-- Pilih Wilayah :  -->
          <select name="wil_cour" class="btn btn-default dropdown-toggle" onchange="this.form.submit();">
            <option value="NULL" selected >Select Area...</option>
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
            
        
    </div>
    <div class="col-sm-3"><input type="submit" name="kurir" class="btn btn-default"></div>
    </form>
  </div>

   <h3>Daftar Pesanan</h3>
      <div class="row">
            <form name="pesanan_makanan" method="post">
     <table width='100%' class="table table-hover">
      <thead>
          <tr>
              <th>Pemesan</th> <th>Nama Makanan</th> <th>Jumlah</th>  <th>Total Harga</th> <th>Pilih</th>
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
                        <td><input type="Submit" class="btn btn-link" value="Pilih" name="acc"></td> 
                        
                            
                    </tr>';
               } 
            ?>
         </tbody>
     </table>
    </form>
  <div>
</div>

<h3>Pesanan di ACC</h3>
    
    </div>
    <form name="pesanan_makanan" method="post">
     <table width='100%' class="table table-hover">
      <thead>
          <tr>
              <th>Pemesan</th> <th>Nama Makanan</th> <th>Jumlah</th>  <th>Total Harga</th> <th>Hapus</th>
          </tr>
         </thead>
         <tbody>
            <?php
              $nrp_cour= $_SESSION['login_user'];

              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_list ,list_pesanan.id_pesanan, makanan.nama_makanan, makanan.harga_makanan, list_pesanan.jumlah, list_pesanan.id_customer, list_pesanan.jumlah*makanan.harga_makanan as Total FROM list_pesanan, makanan WHERE list_pesanan.wilayah = '$wil_cour' AND list_pesanan.id_makanan = makanan.id_makanan AND list_pesanan.id_courier = '$nrp_cour'  ORDER BY list_pesanan.id_pesanan ASC");
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
            ?>
         </tbody>
     </table>
     <input type="Submit" class="btn btn-default" name="submitpesanan" value="Mangkat">
    </form>
    </div>


</body>
</html>
