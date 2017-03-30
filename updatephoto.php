<?php 
session_start();
if (!isset($_SESSION['prestataire'])) {
	header("Location:index.php");
}
$temp = (isset($_FILES['pic'])?$_FILES['pic']['tmp_name']:"uploads/".$_SESSION['prestataire']['pseudo'].".png");
copy($temp, "uploads/".$_SESSION['prestataire']['pseudo'].".png");
header("Location:profilPrest.php");
 ?>