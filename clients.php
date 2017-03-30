<?php 
	session_start();
	include('db_dir/SqlRequests.php');
	include('functions.php');
	if (isset($_POST['email'])) {
		ajouterClient($_POST['pseudo'],$_POST['prestation'],$_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['tel']);
		$pseudo=$_POST['pseudo'];
		$prenom=$_POST['prenom'];
		$email=recherchePrestataire($pseudo)['email'];
		$nom=$_POST['nom'];
		$request=new SqlRequests();
		$message="<h1>Notification</h1>";
		$message.="<p>Bonjour $pseudo, nous vous envoyons ce mail suite à la demande d'un client($prenom $nom) qui a déclarer travailler avec vous.Veuillez vous connecter pour confirmer. <br> Merci</p>";		
		if ($request->envoyerMail($email,$pseudo,"Confirmation de travail",$message,$message)) {
			$_SESSION['clsuccess']="Nous avons avertit le prestataire";
		}
		else
			$_SESSION['clsuccess']="Une erreur est survenue";
		header('Location:index.php#search');
	}
	else
		header("Location:index.php");
 ?>