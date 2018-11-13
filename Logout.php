<?php
session_start();
$databaseHost = 'localhost';
$databaseName = 'tcourier';
$databaseUsername = 'root';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

$nrp_user = $_SESSION['login_user'];
    $result = mysqli_query($mysqli,"DELETE FROM customer WHERE nrp_customer = '$nrp_user';");
if(session_destroy()) {
      header("Location: Home.php");
   }
?>