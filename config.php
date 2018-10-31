<?php
session_start();
$errors = array();
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
  //$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
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
     
  }

  if(isset($_POST['SignIn'])) {
       // username dan password didapat dari form
       
       $myusername = mysqli_real_escape_string($mysqli,$_POST['nrp']);
       $mypassword = mysqli_real_escape_string($mysqli,$_POST['pwd']); 
       $sql = "SELECT nrp FROM users WHERE nrp = '$myusername' and pwd = '$mypassword'";
       $result = mysqli_query($mysqli,$sql);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
       $count = mysqli_num_rows($result);
       
       // Jika hasil sesuai $myusername dan $mypassword, table row harus 1	
       if($count == 1) {
          $_SESSION['login_user'] = $myusername;
          header("location: job.php");
       }else {
        header("location: home.php");
       }
    }
 
    if(isset($_POST['job']))
    {
      $_SESSION['job'] = $_POST['job'];

      if($_SESSION['job'] == 'courier') {
        header("location: Courier.php");
     }else {
      header("location: Customer.php");
     }

    }
    
  if(isset($_POST['customerwilayah']))
  {
    $_SESSION['makanan'] = '01';
  }

?>