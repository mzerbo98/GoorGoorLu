<?php 
include("functions.php");
if (isset($_POST['pseudo'])) {
	$prestataire=$_POST['pseudo'];
	$prestation=$_POST['prestation'];
	$tarif=$_POST['tarif'];
	$dispo=isset($_POST['disponible'])?"true":"false";
	addPretationPrestataire($prestataire,$prestation,$tarif,$dispo);
}
header("Location:profilPrest.php")
 ?>