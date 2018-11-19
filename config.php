<?php
session_start();
$databaseHost = 'localhost';
$databaseName = 'tcourier';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

if(isset($_POST['Update'])){
  $nrp = $_POST['nrp'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $nohp = $_POST['nohp'];
  $idline = $_POST['idline'];
  $result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',email='$email',pwd='$pwd',nohp='$nohp',idline='$idline' WHERE nrp='$nrp'");
	header("Location: Home.php");
}

  if(isset($_POST['SignUp'])) {
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $nohp = $_POST['nohp'];
    $idline = $_POST['idline'];
    $result = mysqli_query($mysqli, "INSERT INTO users(nrp,nama,email,pwd,nohp,idline) VALUES('$nrp','$nama','$email','$pwd','$nohp','$idline')");
    header("Location: Login.php");
  }

  if(isset($_POST['SignIn'])) {
       
       $myusername = mysqli_real_escape_string($mysqli,$_POST['nrp']);
       $mypassword = mysqli_real_escape_string($mysqli,$_POST['pwd']); 
       $sql = "SELECT nrp FROM users WHERE nrp = '$myusername' and pwd = '$mypassword'";
       $result = mysqli_query($mysqli,$sql);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
       $count = mysqli_num_rows($result);
       $_SESSION['job'] = '';	
       if($count == 1) {
          $_SESSION['login_user'] = $myusername;
          header("location: job.php");
       }else {
        $Err = "Username atau Password anda salah";
        header("location: Login.php");
       }
    }
 
    if(isset($_POST['job']))
    {
      $nrpjob = $_SESSION['login_user'];
      $_SESSION['wil_cust'] ='';
      $_SESSION['wil_cour'] = '';
      $_SESSION['job'] = $_POST['job'];	
      if($_SESSION['job'] == 'courier') {
        $result = mysqli_query($mysqli, "INSERT INTO courier(nrp_courier) VALUES((SELECT nrp FROM users WHERE nrp= '$nrpjob'))");
        header("location: Courier.php");
     }else {
      $result = mysqli_query($mysqli, "INSERT INTO customer(nrp_customer) VALUES((SELECT nrp FROM users WHERE nrp= '$nrpjob'))");
      $result = mysqli_query($mysqli, "INSERT INTO pesanan(nrp_pemesan) VALUES((SELECT nrp_customer FROM customer WHERE nrp_customer= '$nrpjob'))");
      header("location: Customer.php");
     }

    }
    
	 if(isset($_POST['wil_cust']))
	 {
	   $_SESSION['wil_cust'] = $_POST['wil_cust'];
	 }

    if(isset($_POST['wil_cour']))
   {
     $_SESSION['wil_cour'] = $_POST['wil_cour'];
   }

    if(isset($_POST['pilih'])) {
    $nrp = $_SESSION['login_user'];
    $id_makanan = $_POST['id_makanan'];
    
    $result = mysqli_query($mysqli, "SELECT makanan.id_makanan, pesanan.id_pesanan FROM makanan, pesanan WHERE makanan.id_makanan = $id_makanan and pesanan.id_pesanan = (SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan = $nrp ORDER BY id_pesanan DESC LIMIT 1)");

    $row = $result->fetch_assoc();
    $id_makanan = $row['id_makanan'];
    $id_pesanan = $row['id_pesanan'];
    $jumlah = $_POST['jumlah'];
    $result = mysqli_query($mysqli, "INSERT INTO list_pesanan (id_list,id_pesanan,id_makanan,jumlah) 
      VALUES('$id_pesanan$id_makanan','$id_pesanan','$id_makanan','$jumlah')");
      header("Location: customer.php");
    }

    if(isset($_POST['remove'])) {
    $id_makanan = $_POST['id_makanan'];
    
    $result = mysqli_query($mysqli, "DELETE FROM list_pesanan WHERE id_makanan = $id_makanan ;");
    
    header("Location: customer.php");
    }

?>