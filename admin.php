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
			<div class="page-header center">
			<h3>Admin Panel</h3>
			</div>
	<div class="row left">			
	
        <div class="col-sm-4">
        <h3>Tambah Wilayah</h3>
        <form method="POST">
          <div class="form-group">
            <label for="namawilayah">Nama Wilayah :</label>
                <input type="text" name="namawilayah" class="form-control">
          </div>
          <div class="form-group">
            <label for="ongkoswilayah">Ongkos Wilayah :</label>
                <input type="number" name="ongkoswilayah" class="form-control">
          </div>
          	<input type="Submit" name="tambahwilayah" value="Tambah" class="btn btn-default">

        </form>
        </div>
  </div>
	<hr><hr><br>
	<div class="left">
	<h3>Edit Wilayah</h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
		<input id="wilayah" type="text" placeholder="Search Wilayah" class="form-control"><br>
		</div>
	</div>
	<div>
		<table class="table left">
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
				<form method="POST" id="adminupdatewilayah">
				<td> '.$row['id_wilayah'].'</td>
				<td> <input type="text" class="form-control" value="'.$row['nama_wilayah'].'" name="nama_wilayahadmin" > </td>
				<td> <input type="text" class="form-control" value="'.$row['ongkos_wilayah'].'" name="ongkos_wilayahadmin" > </td>
				<input type="hidden" name="id_wilayah" readonly value="'.$row['id_wilayah'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdatewilayah" value="Update" > | <Input type="submit" class="btn btn-link" name="admindeletewilayah" value="Delete"> </td>
				</form>
				</tr>';
				}      
			?>
		</tbody>
	</table>
	<hr><hr><br>
	</section>
	<section id="about" class="container text-center">
	<div class="left">
	<h3>Tambah Makanan</h3>
	<form method="POST">
	<div class="row">
		<div class="col-sm-4">
          <div class="form-group">
            <label for="namamakanan">Nama Makanan :</label>
                <input type="text" name="namamakanan" class="form-control">
          </div>
          <div class="form-group">
            <label for="wilayahmakanan">Wilayah Makanan :</label>
                <input type="text" name="wilayahmakanan" class="form-control">
          </div>
                    <div class="form-group">
            <label for="hargamakanan">Harga Makanan :</label>
                <input type="number" name="hargamakanan" class="form-control">
          </div>
                    <div class="form-group">
            <label for="deskripsimakanan">Deskripsi Makanan :</label>
                <input type="text-area" name="deskripsimakanan" class="form-control">
          </div>
          	<input type="Submit" name="tambahwilayah" value="Tambah" class="btn btn-default">
        </div>
    </div>
    </form>
	</div>
	<hr><hr><br>
	<div class=" left">
	<h3>Edit Makanan</h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
		<input id="makanan" type="text" placeholder="Search Makanan" class="form-control"><br>
		</div>
	</div>
	<div>
		<table class="table left">
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
				<td> <input type="text" class="form-control" value="'.$row['nama_makanan'].'" name="nama_makananadmin" > </td>
				<td> <input type="text" class="form-control" value="'.$row['wilayah_makanan'].'" name="wilayah_makananadmin" > </td>
				<td> <input type="number" class="form-control" value="'.$row['harga_makanan'].'" name="harga_makananadmin" > </td>
				<td> <input type="text" class="form-control" value="'.$row['deskripsi_makanan'].'" name="deskripsi_makananadmin" > </td>
				<input type="hidden" name="id_makanan" readonly value="'.$row['id_makanan'].'">
				<td> <input type="submit" class="btn btn-link" name="adminupdatemakanan" value="Update"> | <Input type="submit" class="btn btn-link" name="admindeletemakanan" value="Delete"> </td>
				</form>
				</tr>';      
				}      
			?>
		</tbody>
	</table>
	<hr><hr><br>
	</div>
	</div>
	</section>
	<section id="download" class="container text-center">
	<div class="left">
	<h3>Tambah User</h3>
	</div>
	<form method="POST" class="left">
		<input type="Submit" name="adminadduser" class="btn btn-default" value="Klik Disini">
	</form>
	<hr><hr><br>
	<div class="left">
	<h3>Edit Users</h3>
	</div>
	<div class="row">
		<div class="col-sm-4">
		<input id="users" type="text" placeholder="Search User" class="form-control"><br>
		</div>
	</div>
		
	<div>
		<table class="table left">
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
		</div>
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
		$('#updateadminwilayah').on('submit', function(e){
		      $('#modalwilayah').modal('show');
		      return false;
		 });
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

