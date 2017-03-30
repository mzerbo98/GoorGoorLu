<?php 
	session_start();
	include('functions.php');
	if (isset($_POST['code'])) {
		$code=$_POST['code'];
		deleteClient($code);
		$client=rechercheClient($code);
		$prestataire=$client['service_prestataire'];
		$tel=recherchePrestataire($prestataire)['tel'];
		$email=$client['email'];
		$nom=$client['prenom'].' '.$client['nom'];
		$request=new SqlRequests();
		$message="<h1>Confirmation</h1>";
		$message.="<p>Bonjour $nom, nous vous envoyons ce mail pour vous signaler que $prestataire a declarer ne pas travailler avec vous.<br>Pour plus de detail veuillez le contacter au $tel. <br> Merci</p>";		
		$request->envoyerMail($email,$prestataire,"Confirmation de travail",$message,$message);
		header('Location:profilPrest.php');
	}
	else
		header("Location:profilPrest.php");
 ?>