<?php 
session_start();
include('functions.php');
include('db_dir/SqlRequests.php');
if (isset($_POST['code'])) {
	$pseudo=rechercheCode($_POST['code']);
	if ($pseudo!=false) {
		$mdp=$_POST['mdp'];
		changerMDP($pseudo,$mdp);
		deleteCode($pseudo);
		$email=recherchePrestataire($pseudo)['email'];	
		$_SESSION['errcon']="Votre mot de passe a été changé avec succes";		
		$request=new SqlRequests();
		$message="<h1>Notification</h1>";
		$message.="<p>Bonjour $pseudo, nous vous envoyons ce mail pour vous signaler la reinitialisation de mot de passe suite a votre demande.<br> Merci</p>";	
		$request->envoyerMail($email,$pseudo,"Reinitialisation de mot de passe",$message,$message);
		header("Location:index.php#linkPres");
	}
	else{
		$_SESSION['errcon']="Ce code n'existe pas";
	}
		header("Location:index.php#linkPres");
}
else
	header("Location:index.php");
 ?>