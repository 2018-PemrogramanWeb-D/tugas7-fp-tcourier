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
  // $_SESSION['login_user'] = $nrp;
  $result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',email='$email',pwd='$pwd',nohp='$nohp',idline='$idline' WHERE nrp='$nrp'");
	header("Location: Job.php");
}

  if(isset($_POST['SignUp'])) {
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $nohp = $_POST['nohp'];
    $idline = $_POST['idline'];
    $result = mysqli_query($mysqli, "INSERT INTO users(nrp,nama,email,pwd,nohp,idline) VALUES('$nrp','$nama','$email','$pwd','$nohp','$idline')");
    // $_SESSION['page'] = '';
    header("Location: Login.php");
  }

  if(isset($_POST['SignIn'])) {
       // $_SESSION['page'] = 'job';
       $myusername = mysqli_real_escape_string($mysqli,$_POST['nrp']);
       $mypassword = mysqli_real_escape_string($mysqli,$_POST['pwd']); 
       $sql = "SELECT nrp FROM users WHERE nrp = '$myusername' and pwd = '$mypassword'";
       $result = mysqli_query($mysqli,$sql);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       // $_SESSION['current_page'] = '';
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
      // $wil = '';
      $_SESSION['job'] = $_POST['job'];	
      if($_SESSION['job'] == 'courier') {
        $_SESSION['wil_cour'] = '';
        $_SESSION["fix"] = "";
        // $_SESSION['daerah_operasi']  = "";
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
        if(isset($_POST['wil_cour_fix']))
   {
     // $_SESSION['wil_cour'] = $_POST['wil_cour'];
     $_SESSION["fix"] = $_SESSION['wil_cour'];
   }

    if(isset($_POST['pilih'])) {
    $nrp_cust = $_SESSION['login_user'];
    $id_makanan = $_POST['id_makanan'];
     $wilayah = $_SESSION['wil_cust'];
    $result = mysqli_query($mysqli, "SELECT makanan.id_makanan, pesanan.id_pesanan FROM makanan, pesanan WHERE makanan.id_makanan = $id_makanan and pesanan.id_pesanan = (SELECT pesanan.id_pesanan FROM pesanan WHERE pesanan.nrp_pemesan = $nrp_cust ORDER BY id_pesanan DESC LIMIT 1)");

    $row = $result->fetch_assoc();
    $id_makanan = $row['id_makanan'];
    $id_pesanan = $row['id_pesanan'];
    $jumlah = $_POST['jumlah'];
    if($jumlah != "")
{
    $result = mysqli_query($mysqli, "INSERT INTO list_pesanan (id_list,id_pesanan,id_makanan,jumlah,id_customer,wilayah,id_courier) 
    VALUES('$id_pesanan$id_makanan','$id_pesanan','$id_makanan','$jumlah','$nrp_cust', '$wilayah', 'Belum Ada')");

    if (!$result) {
    $result = mysqli_query($mysqli, "SELECT * FROM list_pesanan WHERE list_pesanan.id_list = '$id_pesanan$id_makanan'");
    $row = $result->fetch_assoc();
    $jumlah += $row['jumlah'];
    mysqli_query($mysqli, "UPDATE list_pesanan SET jumlah='$jumlah' WHERE list_pesanan.id_list = '$id_pesanan$id_makanan' ");
    }
}


      header("Location: customer.php");
    }

    if(isset($_POST['remove'])) {
    $id_list = $_POST['id_list'];
    
    $result = mysqli_query($mysqli, "DELETE FROM list_pesanan WHERE id_list = $id_list ;");
    
    header("Location: customer.php");
    }

    if(isset($_POST['kurir'])) {
    $nrp = $_SESSION["login_user"];
    $id_wilayah = $_POST["id_wilayah"];
    $_SESSION["w"] = $_POST["id_wilayah"] ;
    
    $result = mysqli_query($mysqli, "INSERT INTO courier (nrp_courier, wilayah_courier) VALUES ( '$nrp' , '$id_wilayah') ");
    
    header("Location: courier.php");
    }

    if(isset($_POST['acc'])) {
    $nrp = $_SESSION['login_user'];
    $id_list = $_POST['id_list'];
    $result = mysqli_query($mysqli, "UPDATE list_pesanan SET diterima='1',id_courier='$nrp' WHERE id_list='$id_list'");
    header("Location: courier.php");
    }

    if(isset($_POST['drop'])) {
    $id_list = $_POST['id_list'];
    $result = mysqli_query($mysqli, "UPDATE list_pesanan SET diterima='0',id_courier='Belum Ada' WHERE id_list='$id_list'");
    header("Location: courier.php");
    }

    if(isset($_POST['submitpesanancust'])) {
    header("Location: pesanancust.php");
    }

    if(isset($_POST['submitpesanancour'])) {
    header("Location: pesanancour.php");
    }

    if(isset($_POST['selesai'])) {
    $id_list = $_POST['id_list'];
    $result = mysqli_query($mysqli, "UPDATE list_pesanan SET diterima='2' WHERE id_list='$id_list'");
    header("Location: pesanancour.php");
    }

    // if(isset($_POST['daerah_operasi'])) {
    // $_SESSION['daerah_operasi'] = $_SESSION['wil_cour'];
    
    // // header("Location: Courier.php");
    // }
?>