<?php 
include('config.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCourier : Customer</title>
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
  <div class="page-header">
    <h1>Customer</h1>
  </div>
  <h3>Daftar Menu</h3>
  <div class="container">
  <div class="row">
  <div class="col-sm-4"></div>
        <div class="col-sm-4">
        <form method="POST">
          <select name="wil_cust" class="custom-select btn-block" onchange="this.form.submit();">
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
        </form>
        </div>
  <div class="col-sm-4"></div>
  </div>
  
      <div class="row">
          <table width='100%' class="table table-hover">
          <thead>
          <tr>
              <th>Nama Makanan</th> <th>Harga</th> <th>Deskripsi Makanan</th><th>Jumlah</th><th>Pilih Makanan</th>
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
                            <td>'.$row["nama_makanan"].'</td> <td>'.$row["harga_makanan"].'</td> <td>'.$row["deskripsi_makanan"].'</td> <td><input type="text" name="jumlah" value=""></td> <td><input type="hidden" name="pilihmakanan" value=""><a href="Customer.php" onclick="document.getElementById("myForm").submit();">Pilih</a></td>
                        </tr>';
        			    }
        			}
        			?> 
          </form>
          </tbody>
          </table>
      
    <h3>Pesanan</h3>
    <?php
    $nrp_cust= $_SESSION['login_user']; 
    $result = mysqli_query($mysqli, "SELECT * FROM  pesanan WHERE nrp_pemesan=$nrp_cust ORDER BY id_pesanan DESC LIMIT 1");
    $row = $result->fetch_assoc();
    echo '<h4>Id : '.$row['id_pesanan'].'</h4>';  
    ?>
  	</div>
  	<form name="pesanan_makanan" method="post">
  	 <table width='100%' class="table table-hover">
  		<thead>
          <tr>
              <th>Nama Makanan</th> <th>Jumlah</th> <th>Total Harga</th>
          </tr>
         </thead>
         <tbody>
         	  <?php
              $nrp_cust= $_SESSION['login_user'];
              $result = mysqli_query($mysqli, "SELECT list_pesanan.id_pesanan , makanan.nama_makanan, list_pesanan.jumlah, makanan.harga_makanan*list_pesanan.jumlah as total FROM list_pesanan, makanan, pesanan WHERE list_pesanan.id_pesanan = pesanan.id_pesanan  AND list_pesanan.id_makanan=makanan.id_makanan AND pesanan.id_pesanan=(SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan =$nrp_cust ORDER BY id_pesanan DESC LIMIT 1)");
               while($row = $result->fetch_assoc()) {
                  echo '
                        <tr>
                            <td>'.$row["nama_makanan"].'</td> <td>'.$row["jumlah"].'</td> <td>'.$row["total"].'</td>
                        </tr>';
               } 
            ?>
         </tbody>
     </table>
     <input type="Submit" class="btn btn-default" name="submitpesanan">
  	</form>
  	</div>
</body>
</html>
