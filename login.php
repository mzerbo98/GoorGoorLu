<?php
session_start();
include('functions.php');
if( !isset($_REQUEST['pseudo']) || !isset($_REQUEST['mdp']) || !connection($_REQUEST['pseudo'],$_REQUEST['mdp']))
{
	$_SESSION['errcon']="Pseudo ou mot de passe incorrect";
	$_SESSION['pseudo']=$_REQUEST['pseudo'];
	header("Location:index.php#linkPres");}
	else{
		$_SESSION['prestataire']=recherchePrestataire($_REQUEST['pseudo']);
		$_SESSION['pseudo']="";
		if (isset($_REQUEST['remember'])) {
			$_COOKIES['prestataire']=$_SESSION['prestataire'];
		}
		deleteCode($_REQUEST['pseudo']);
		header("Location:profilPrest.php");
	 }?>	
