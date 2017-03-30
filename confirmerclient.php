<?php 
	session_start();
	include('functions.php');
	include('db_dir/SqlRequests.php');
	if (isset($_POST['code'])) {
		$code=$_POST['code'];
		confirmerClient($code);
		$client=rechercheClient($code);
		$prestataire=$client['service_prestataire'];
		$email=$client['email'];
		$nom=$client['prenom'].' '.$client['nom'];
		$request=new SqlRequests();
		$message="<h1>Confirmation</h1>";
		$message.="<p>Bonjour $nom, nous vous envoyons ce mail pour vous signaler que $prestataire a confirmé travailler avec vous.<br>Nous vous enverrons un mail contenant le code de notation lorsqu'il declarera avoir fini. <br> Merci</p>";		
		$request->envoyerMail($email,$prestataire,"Confirmation de travail",$message,$message);
		header('Location:profilPrest.php');
	}
	else
		header("Location:profilPrest.php");
 ?>