<?php 
session_start();
include('functions.php');
if (isset($_POST['pseudo'])) {
	$pseudo=$_POST['pseudo'];
	$prestations = loadPrestationsPrestataire($pseudo);
	$n=count($prestations);
	for ($i=0; $i < $n; $i++) { 
		$p=$prestations[$i];
		updateService($pseudo,$p['prestation'],$p['tarif'],isset($_POST[$p['prestation']])?"true":"false");
	}
}
header("Location:profilPrest.php")
 ?>