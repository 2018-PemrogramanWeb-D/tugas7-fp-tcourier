<?php include('config.php');   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel Admin</title>
</head>

<body>
<h3>Tambah Wilayah</h3>
<form method="POST">
<input type="text" name="namawilayah">
<input type="number" name="ongkoswilayah">
<input type="Submit" name="tambahwilayah">	
</form>

<h3>Tambah Makanan</h3>
<form method="POST">
<input type="text" name="namamakanan">
<input type="text" name="wilayahmakanan">
<input type="number" name="hargamakanan">	
<input type="text" name="deskripsimakanan">	
<input type="Submit" name="tambahmakanan">
</form>

</body>
</html>