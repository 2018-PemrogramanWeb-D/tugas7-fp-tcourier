<?php
session_start(); 
$databaseHost = 'localhost';
$databaseName = 'tcourier';
$databaseUsername = 'root';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
$Err = "";

if(isset($_POST['Update'])){
  $nrp = $_POST['nrp'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $nohp = $_POST['nohp'];
  $idline = $_POST['idline'];
  $result = mysqli_query($mysqli, "UPDATE users SET nama='$nama',email='$email',pwd='$pwd',nohp='$nohp',idline='$idline' WHERE nrp='$nrp'");

  if($_SESSION['update'] == "admin"){
      header("Location: admin.php");
  }
  else if($_SESSION['update'] == "users"){
      header("Location: job.php");
  }
	$_SESSION['update'] = "";
}

if(isset($_POST['SignUp'])) {
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $nohp = $_POST['nohp'];
    $idline = $_POST['idline'];

    if(strlen($nrp) != 14 ){
      $Err = '<div class="alert alert-danger">NRP tidak valid.</div>';
    }
    else if(strlen($pwd) < 6){
     $Err = '<div class="alert alert-danger">Password harus lebih dari 6 karakter.</div>'; 
    }
    else{

    $result = mysqli_query($mysqli, "INSERT INTO users(nrp,nama,email,pwd,nohp,idline) VALUES('$nrp','$nama','$email','$pwd','$nohp','$idline')");



  if($_SESSION['update'] == "admin"){
    if ($result) {
        header("Location: admin.php");
      }
      else $Err = '<div class="alert alert-danger">User telah terdaftar.</div>';
    }
  else{
      if ($result) {
        header("Location: login.php");
      }
      else $Err = '<div class="alert alert-danger">User telah terdaftar.</div>';
      }
    }
    $_SESSION['update'] = "";
  }

    

  if(isset($_POST['SignIn'])) {
      $_SESSION['update'] = 'users';
       $nrp = mysqli_real_escape_string($mysqli,$_POST['nrp']);
       $pwd = mysqli_real_escape_string($mysqli,$_POST['pwd']); 
       $result = mysqli_query($mysqli,"SELECT * FROM users WHERE nrp = '$nrp' and pwd = '$pwd'");
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       if($row['nrp'] == $nrp && $row['pwd'] == $pwd){
        if($nrp=="05111040000000" && $row['nrp'] == $nrp && $row['pwd'] == $pwd){
          header("Location: admin.php");
        }else
        {
          header("Location: job.php");
        $_SESSION['job'] = '';
        $_SESSION['login_user'] = $nrp; 
        }
        
       }
       else if ($row['pwd'] != $pwd && $row['nrp'] != $nrp) {
                 $Err = '<div class="alert alert-danger"> NRP dan Password salah. </div>';
       }
       // else if ($row['nrp'] != $nrp) {
       //           $Err = '<div class="alert alert-danger"> NRP salah. </div>';
       // }
       
       // else{
       //  $Err = '<div class="alert alert-danger"> NRP atau Password salah. </div>';
       // }

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
        header("location: courier.php");
     }else {
      $result = mysqli_query($mysqli, "INSERT INTO customer(nrp_customer) VALUES((SELECT nrp FROM users WHERE nrp= '$nrpjob'))");
      $result = mysqli_query($mysqli, "INSERT INTO pesanan(nrp_pemesan) VALUES((SELECT nrp_customer FROM customer WHERE nrp_customer= '$nrpjob'))");
      $_SESSION["no"] = true;
      header("location: customer.php");
     }

    }
    

   if(isset($_POST['start']))
   {
     $_SESSION['Err'] = "";
      header("Location: login.php");
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
     $_SESSION["fix"] = $_SESSION['wil_cour'];
   }

    if(isset($_POST['pilih'])) {
    $_SESSION["no"] = false;
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

    //ADMIN--
  if(isset($_POST['tambahwilayah'])) {
    $namawilayah = $_POST['namawilayah'];
    $ongkoswilayah = $_POST['ongkoswilayah'];
    $result = mysqli_query($mysqli, "INSERT INTO wilayah(id_wilayah,nama_wilayah,ongkos_wilayah) VALUES('NULL','$namawilayah','$ongkoswilayah')");
  }

    if(isset($_POST['tambahmakanan'])) {
    $namamakanan = $_POST['namamakanan'];
    $wilayahmakanan = $_POST['wilayahmakanan'];
    $hargamakanan = $_POST['hargamakanan'];
    $deskripsimakanan = $_POST['deskripsimakanan'];
    $result = mysqli_query($mysqli, "INSERT INTO makanan(id_makanan,nama_makanan,wilayah_makanan,harga_makanan,deskripsi_makanan) VALUES('NULL','$namamakanan','$wilayahmakanan','$hargamakanan','$deskripsimakanan')");
  }

  if(isset($_POST['admindeleteuser'])) {
    $nrpdelete = $_POST['nrp'];
    $result = mysqli_query($mysqli,"DELETE FROM users WHERE nrp = '$nrpdelete';");
    header("Location: admin.php");
  }

  if(isset($_POST['adminupdateuser'])) {
    $nrpupdate= $_POST['nrp'];
    $_SESSION['login_user'] = $nrpupdate;
    $_SESSION['update'] = "admin";
    header("Location: edit.php");
  }

  if(isset($_POST['adminadduser'])) {
    $_SESSION['update'] = "admin";
    header("Location: signup.php");
  }

    if(isset($_POST['admindeletemakanan'])) {
    $makanandelete = $_POST['id_makanan'];
    $result = mysqli_query($mysqli,"DELETE FROM makanan WHERE id_makanan = '$makanandelete';");
    header("Location: admin.php");
  }
      if(isset($_POST['admindeletewilayah'])) {
    $wilayahdelete = $_POST['id_wilayah'];
    $result = mysqli_query($mysqli,"DELETE FROM wilayah WHERE id_wilayah = '$wilayahdelete';");
    header("Location: admin.php");
  }

  if(isset($_POST['adminupdatewilayah'])){
    $id_wilayahupdate = $_POST['id_wilayah'];
    $namawilayahupdate = $_POST['nama_wilayahadmin'];
    $ongkoswilayahupdate = $_POST['ongkos_wilayahadmin'];

    $result = mysqli_query($mysqli, "UPDATE wilayah SET nama_wilayah='$namawilayahupdate', ongkos_wilayah='$ongkoswilayahupdate' WHERE id_wilayah='$id_wilayahupdate'");
    header("Location: admin.php");
  }
  
    if(isset($_POST['adminupdatemakanan'])){
    $id_makananupdate = $_POST['id_makanan'];
    $namamakananupdate = $_POST['nama_makananadmin'];
    $hargamakananupdate = $_POST['harga_makananadmin'];
    $deskripsimakananupdate = $_POST['deskripsi_makananadmin'];
    $wilayahmakananupdate = $_POST['wilayah_makananadmin'];
    $result = mysqli_query($mysqli, "UPDATE makanan SET nama_makanan='$namamakananupdate', harga_makanan='$hargamakananupdate', wilayah_makanan='$wilayahmakananupdate', deskripsi_makanan='$deskripsimakananupdate' WHERE id_makanan='$id_makananupdate'");
    header("Location: admin.php");
  }
  ///---ADMIN
?>