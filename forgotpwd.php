<?php 
session_start();
include('functions.php');
include('db_dir/SqlRequests.php');
if(isset($_REQUEST['pseudo'])){
	$pseudo=$_REQUEST['pseudo'];
	$email=recherchePrestataire($pseudo)['email'];	
	$code=ajouterCode($pseudo);
	$request=new SqlRequests();
	$message="<h1>Notification</h1>";
	$message.="<p>Bonjour $pseudo, nous vous envoyons ce mail suite a votre demande de reinitialisation de mot de passe.Veuillez vous conneter sur le site et reinitialiser votre mot de passe en utilisant le code suivant : $code <br> Merci</p>";		
	$request->envoyerMail($email,$pseudo,"Reinitialisation de mot de passe",$message,$message);
	$_SESSION['errcon']="Nous vous avons envoyé un mail contenant votre code de reinitialisation";
	header("Location:index.php#linkPres");
}
else
	header("Location:index.php");
?>