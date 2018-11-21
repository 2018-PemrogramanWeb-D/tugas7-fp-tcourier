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
        <form method="POST" class="form-inline">
          <select name="id_wilayah" class="btn btn-default dropdown-toggle">
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
    <div class="col-sm-10"><input type="submit" name="wil_cour" class="btn btn-default"></div>
    </form>
  </div>

   <h3>Daftar Menu</h3>
      <div class="row">
          <table width='100%' class="table table-hover">
          <thead>
          <tr>
              <th>Id Pesanan</th><th>Nama Makanan</th> <th>Jumlah</th> <th>Total</th>
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
                            <td> <input min="1" type="number" class="col-sm-3" value="1" name="jumlah" > </td>
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
  <div>
</div>

</body>
</html>
