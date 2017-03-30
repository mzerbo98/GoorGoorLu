<?php
session_start();
include('functions.php');
include('db_dir/SqlRequests.php');
if (isset($_POST['note']) && rechercheClient($_POST['code'])!=false) {
	$code=$_POST['code'];
	$note=$_POST['note'];
	if (estConfirme($code)) {
		if (estFait($code)) {
			if (!estNote($code)) {
				$client=rechercheClient($code);
				$email=$client['email'];
				$prestataire=$client['service_prestataire'];
				$prestation=$client['service_prestation'];
				$moy=rechercheNote($prestataire,$prestation);
				$nb=nombreClientNote($prestataire,$prestation);
				$moy=($moy*$nb+$note)/($nb+1);
				noterPrestataire($code,$prestataire,$prestation,$moy);
				$request=new SqlRequests();
				$message="<h1>Notification</h1>";
				$message.="<p>Bonjour $prestataire, nous vous envoyons ce mail car vous avez été noté par un client($prenom $nom) qui vous a donné $note sur 5.Votre nouvelle note moyenne pour la categorie $prestation est de $moy. <br> Merci</p>";		
				$request->envoyerMail($email,$prestataire,"Notation de travail",$message,$message);
				$_SESSION['errnote']="Vous avez correctement noté le prestataire";
			}
			else				
				$_SESSION['errnote']="Ce traval a deja été noté";
		}
		else
			$_SESSION['errnote']="Ce traval n'a pas encore été fait par le prestataire";
	}
	else
		$_SESSION['errnote']="Ce traval n'a pas encore été validé par le prestataire";
}
else
	$_SESSION['errnote']="Code incorrect";
header('Location:index.php#notation');
 ?>