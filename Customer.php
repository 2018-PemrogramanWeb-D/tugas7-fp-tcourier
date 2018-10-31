<?php 
include('config.php');
$wilayah = mysqli_query($mysqli, "SELECT * FROM wilayah");
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
          if ($_SESSION['job'] ==  'courier') echo '<li class="active" ><a href="Courier.php">Job</a></li>';
          else if ($_SESSION['job'] ==  'customer') echo '<li class="active" ><a href="Customer.php">Job</a></li>';
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
    <h2>Customer</h2>
  </div>
  <div class="container">
      <div class="row">
        <div class="col-sm-12"></div>
        <form method="POST">
          <select name="wil_cust">
          <?php
            while ($row_wilayah = $wilayah->fetch_assoc()) 
            {
              echo '<option value=" '.$row_wilayah['id_wilayah'].' "> '.$row_wilayah['nama_wilayah'].' </option>';
            }
          ?>
          </select>
          <input type="submit" name="customerwilayah">
        </form>
      </div>
      <div class="row">
        <table width='100%' bsorder=1>
 
    <tr>
        <th>Nama Makanan</th> <th>Harga</th> <th>Deskripsi Makanan</th> <th>Pilih Makanan</th>
    </tr>
    <?php  
    $list_makanan = 'NULL';
    $list_makanan = $_SESSION['makanan'];
    $result = mysqli_query($mysqli,"SELECT * FROM makanan WHERE wilayah_makanan = '$list_makanan'");
    while($row_makanan = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$row_makanan['nama_makanan']."</td>";
        echo "<td>".$row_makanan['harga_makanan']."</td>";
        echo "<td>".$row_makanan['deskripsi_makanan']."</td>";
        echo "<td><a href='edit.php?id=$row_makanan[id_makanan]'>Pilih</a></td></tr>"; 
      
    }
    ?>
    </table>
  </div>
</div>
</body>
</html>
