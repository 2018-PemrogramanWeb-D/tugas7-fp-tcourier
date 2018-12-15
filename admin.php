<?php include('config.php');   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel Admin</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet"></head>

<body>
	<section id="about" class="container intro">
	<div class="container">
			<div class="page-header left">
			<h3>Tambah Wilayah</h3>
			</div>
	<div class="row left">			
	<form method="POST">	
		<input type="text" name="namawilayah">
		<input type="number" name="ongkoswilayah">
		<input type="Submit" name="tambahwilayah">	
	</form>	
	<div class="page-header left">
	<h3>Edit Wilayah</h3>
	</div>
	<div>
		<input id="wilayah" type="text" placeholder="Search Wilayah" class="form-control">
		<table class="table">
		<thead>
			<tr>
				<th>Id Wilayah</th>
				<th>Nama Wilayah</th>
				<th>Ongkos Wilayah</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody id="TableWilayah">
			<?php 
			$result = mysqli_query($mysqli, "SELECT * FROM wilayah ORDER BY id_wilayah ASC");
			while($row = mysqli_fetch_array($result)) {
			echo '
				<tr>
				<form method="POST">
				<td>'.$row['id_wilayah'].'</td>
				<td>'.$row['nama_wilayah'].'</td>
				<td>Rp. '.$row['ongkos_wilayah'].',-</td>
				<input type="hidden" name="id_wilayah" readonly value="'.$row['id_wilayah'].'">
				<td> <input type="button" class="btn btn-link" name="adminupdatewilayah" value="Update" data-toggle="modal" 
				onclick="admin.php?id_wilayah='.$row['id_wilayah'].'" data-target="#modalwilayah"> | <Input type="submit" class="btn btn-link" name="admindeletewilayah" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	</div>
	</section>
	<section id="about" class="container text-center">
	<div class="page-header left">
	<h3>Tambah Makanan</h3>
	</div>
	<form method="POST">
		<input type="text" name="namamakanan" class="">
		<input type="text" name="wilayahmakanan">
		<input type="number" name="hargamakanan">	
		<input type="text" name="deskripsimakanan">	
		<input type="Submit" name="tambahmakanan" class="btn btn-default">
	</form>
	<br><br>
	<div class="page-header left">
	<h3>Edit Makanan</h3>
	</div>
	<div>
		<input id="makanan" type="text" placeholder="Search Makanan" class="form-control">
		<table class="table">
		<thead>
			<tr>
				<th>Id Makanan</th>
				<th>Nama Makanan</th>
				<th>Wilayah Makanan</th>
				<th>Harga Makanan</th>
				<th>Deskripsi Makanan</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody id="TableMakanan">
			<?php 
			$result = mysqli_query($mysqli, "SELECT * FROM makanan ORDER BY id_makanan ASC");
			while($row = mysqli_fetch_array($result)) {
			echo '
				<tr>
				<form method="POST">
				<td>'.$row['id_makanan'].'</td>
				<td contenteditable="true">'.$row['nama_makanan'].'</td>
				<td>'.$row['wilayah_makanan'].'</td>
				<td>'.$row['harga_makanan'].'</td>
				<td>'.$row['deskripsi_makanan'].'</td>
				<input type="hidden" name="id_makanan" readonly value="'.$row['id_makanan'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdatemakanan" value="Update"> | <Input type="submit" class="btn btn-link" name="admindeletemakanan" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	</div>
	</section>
	<br>
	<section id="download" class="container text-center">
	<div class="page-header left">
	<h3>Tambah User</h3>
	</div>
	<form method="POST">
		<input type="Submit" name="adminadduser" class="btn btn-default" value="Klik Disini">
	</form>
	<div class="page-header left">
	<h3>Cari Users</h3>
	</div>
	<div>
		<input id="users" type="text" placeholder="Search User" class="form-control">
		<table class="table">
		<thead>
			<tr>
				<th>NRP</th>
				<th>Nama</th>
				<th>Email</th>
				<th>No Hp</th>
				<th>Id Line</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody id="TableUsers">
			<?php 
			$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY nrp ASC");
			while($row = mysqli_fetch_array($result)) {
			echo '
				<tr>
				<form method="POST">
				<td>'.$row['nrp'].'</td>
				<td>'.$row['nama'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['nohp'].'</td>
				<td>'.$row['idline'].'</td>
				<input type="hidden" name="nrp" readonly value="'.$row['nrp'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdateuser" value="Update"> | <Input type="submit" class="btn btn-link" name="admindeleteuser" value="Delete"> </td>
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
</body>
  <div class="modal fade" id="modalwilayah">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <form method="post">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Edit Wilayah</h3>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        	<?php 
			$nrp = $_SESSION['login_user'];
			$result = mysqli_query($mysqli, "SELECT * FROM users WHERE nrp=$nrp");
			while ($user_data = mysqli_fetch_array($result)){
			  $nrp = $user_data['nrp'];
			  $nama = $user_data['nama'];
			  $email = $user_data['email'];
			  $pwd = $user_data['pwd'];
			  $nohp = $user_data['nohp'];
			  $idline = $user_data['idline'];
			}
			?>
          <!-- $rowid = $_GET['rowid']; -->
          <input type="text" name="adminnamawilayah" placeholder="Nama Wilayah">
          <input type="number" name="adminongkoswilayah" placeholder="Ongkos Wilayah">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
          <button type="submit" name="adminupdatewilayah" class="btn btn-primary submitBtn">Save</button> 
          </form>
        </div>
        
      </div>
    </div>
  </div>
</html>

<script>
  	$(document).ready(function(){
	  	$("#wilayah").on("keyup", function() {
		    		var value = $(this).val().toLowerCase();
		    		$("#TableWilayah tr").filter(function() {
		      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    		});
	  			});	
	  	})
  	  	$(document).ready(function(){
	  	$("#makanan").on("keyup", function() {
		    		var value = $(this).val().toLowerCase();
		    		$("#TableMakanan tr").filter(function() {
		      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    		});
	  			});	
	  	})
  	  	$(document).ready(function(){
	  	$("#users").on("keyup", function() {
		    		var value = $(this).val().toLowerCase();
		    		$("#TableUsers tr").filter(function() {
		      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    		});
	  			});	
	  	})
</script>

