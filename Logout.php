<?php
// Initialize the session
session_start();
if(session_destroy()) {
      header("Location: Home.php");
   }

?>