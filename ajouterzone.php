<?php session_start();
include("functions.php");
if (isset($_POST['pseudo'])) {
	$pseudo=$_POST['pseudo'];
	$zones=loadZoneNonCouvertesPrestataire($pseudo);
	$n=count($zones);
	for ($i=0; $i < $n; $i++) { 
		if (isset($_POST[$zones[$i]])) {
			addZonePrestataire($pseudo,$zones[$i]);
		}
	}
}
header("Location:profilPrest.php");
 ?>