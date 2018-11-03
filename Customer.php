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
  <div class="page-header align-center">
    <h1>Customer</h1>
  </div>
  <div class="container">
  <div class="row">
  <div class="col-sm-4"></div>
        <div class="col-sm-4">
        <form method="POST">
          <select name="wil_cust" class="custom-select btn-block" onchange="this.form.submit();">
            <option value="NULL" selected >Select Area...</option>
            <option value="01">Gebang</option>
            <option value="02">Keputih</option>
            <option value="03">Mulyosari</option>
          </select>
        </form>
        </div>
  <div class="col-sm-4"></div>
  </div>
  
      <div class="row">
          <table width='100%' class="table table-hover">
          <thead>
          <tr>
              <th>Nama Makanan</th> <th>Harga</th> <th>Deskripsi Makanan</th> <th>Pilih Makanan</th>
          </tr>
          </thead>
          <tbody>
			<?php
			  $wil_cust = $_SESSION['wil_cust'];
			  $result = mysqli_query($mysqli, "SELECT * FROM makanan WHERE wilayah_makanan = '$wil_cust' ");
			  if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc()) {
			      echo "
			          <tr>
			              <td>".$row["nama_makanan"]."</td> <td>".$row["harga_makanan"]."</td> <td>".$row["deskripsi_makanan"]."</td> <td>Pilih</td>
			          </tr>";
			    }
			}
			?>
          </tbody>
          </table>
      </div>
    <div class="page-header align-center">
    	<h3>Pesanan</h3>
  	</div>
  	<form name="pesanan_makanan" method="post">
  	 <table width='100%' class="table table-hover">
  		<thead>
          <tr>
              <th>Nama Makanan</th> <th>Harga</th> <th>Jumlah</th>
          </tr>
         </thead>
         <tbody>
         	
         </tbody>
     </table>
     <input type="Submit" class="btn btn-default" name="submitpesanan">
  	</form>
</div>
</body>
</html>
