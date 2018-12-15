<?php include('config.php');   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel Admin</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row">
			<h3>Tambah Wilayah</h3>
	<form method="POST">
		<input type="text" name="namawilayah">
		<input type="number" name="ongkoswilayah">
		<input type="Submit" name="tambahwilayah">	
	</form>

	<h3>Edit Wilayah</h3>
	<div>
		<input id="myInput" type="text" placeholder="Search Wilayah" class="sch">
		<table class="table">
		<thead>
			<tr>
				<th>Id Wilayah</th>
				<th>Nama Wilayah</th>
				<th>Ongkos Wilayah</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php 
			$result = mysqli_query($mysqli, "SELECT * FROM wilayah ORDER BY id_wilayah ASC");
			while($row = mysqli_fetch_array($result)) {
			echo '
				<tr>
				<form method="POST">
				<td>'.$row['id_wilayah'].'</td>
				<td>'.$row['nama_wilayah'].'</td>
				<td>Rp. '.$row['ongkos_wilayah'].',-</td>
				<input type="hidden" name="nrp" readonly value="'.$row['id_wilayah'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdate" value="Update"> | <Input type="submit" class="btn btn-link" name="admindelete" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	</div>

	<br>

	<h3>Tambah Makanan</h3>
	<form method="POST">
		<input type="text" name="namamakanan">
		<input type="text" name="wilayahmakanan">
		<input type="number" name="hargamakanan">	
		<input type="text" name="deskripsimakanan">	
		<input type="Submit" name="tambahmakanan">
	</form>
	<h3>Edit Makanan</h3>
	<div>
		<input id="myInput" type="text" placeholder="Search Makanan" class="sch">
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
		<tbody id="myTable">
			<?php 
			$result = mysqli_query($mysqli, "SELECT * FROM makanan ORDER BY id_makanan ASC");
			while($row = mysqli_fetch_array($result)) {
			echo '
				<tr>
				<form method="POST">
				<td>'.$row['id_makanan'].'</td>
				<td>'.$row['nama_makanan'].'</td>
				<td>'.$row['wilayah_makanan'].'</td>
				<td>'.$row['harga_makanan'].'</td>
				<td>'.$row['deskripsi_makanan'].'</td>
				<input type="hidden" name="nrp" readonly value="'.$row['id_makanan'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdate" value="Update"> | <Input type="submit" class="btn btn-link" name="admindelete" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	</div>

	<br>

	<h3>Tambah User</h3>
	<form method="POST">
		<input type="Submit" name="adminadduser" value="Klik Disini">
	</form>
	<h3>Cari Users</h3>
	<div>
		<input id="myInput" type="text" placeholder="Search User" class="sch">
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
		<tbody id="myTable">
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
				<td> <input type="submit" class="btn btn-link" name="adminupdate" value="Update"> | <Input type="submit" class="btn btn-link" name="admindelete" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	</div>
		</div>
	</div>
	
</body>
</html>

<script>
  	$(document).ready(function(){
	  	$("#myInput").on("keyup", function() {
		    		var value = $(this).val().toLowerCase();
		    		$("#myTable tr").filter(function() {
		      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    		});
	  			});	
	  	})
</script>