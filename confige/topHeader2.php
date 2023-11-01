<?php
$Confige = new Confige;
if(!isset($_COOKIE['Username'])){
  header("location: ../login.php");
}
?>