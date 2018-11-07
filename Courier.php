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
    <h2>Courier [selesaikan customer dahulu]</h2>
  </div>
  setelah submit wilayah ,div pilih wilayah courier di hidden
  <div class="col-sm-4">
        <form method="POST">
          <select name="wil_cust" class="custom-select btn-block">
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
            <input type="submit" name="wil_cour" class="btn btn-primary">
        </form>
  </div>

  <div class="row">
          <table width='100%' class="table table-hover">
          <thead>
          <tr>
              <th>Nama Makanan</th> <th>Harga</th> <th>Deskripsi Makanan</th> <th>Pilih Makanan</th>
          </tr>
          </thead>
          <tbody>
          <form id=myForm method="POST">
              <?php
                $wil_cour = $_SESSION['wil_cour'];
                $result = mysqli_query($mysqli, "SELECT * FROM makanan WHERE wilayah_makanan = '$wil_cour' ");
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                        <tr>
                            <td>'.$row["nama_makanan"].'</td> <td>'.$row["harga_makanan"].'</td> <td>'.$row["deskripsi_makanan"].'</td> <td><input type="submit" name="someName" value="helloworld"><a href="Customer.php" onclick="document.getElementById("myForm").submit();">Pilih</a></td>
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
