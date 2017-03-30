<?php 
	session_start();
	include('functions.php');
	include('db_dir/SqlRequests.php');
	if (isset($_POST['pseudo'])) {
		if (inscrire($_REQUEST['pseudo'],$_REQUEST['mdp'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['adresse'],$_REQUEST['tel'],$_REQUEST['email'])==true) {
			$temp = (isset($_FILES['pic'])?$_FILES['pic']['tmp_name']:"uploads/default.png");
			copy($temp, "uploads/".$_REQUEST['pseudo'].".png");
			$_SESSION['errcon']="";
			$_SESSION['pseudo']="";
			$_SESSION['mdp']="";
			$_SESSION['nom']="";
			$_SESSION['prenom']="";
			$_SESSION['adresse']="";
			$_SESSION['tel']="";
			$_SESSION['email']="";
			$request=new SqlRequests();
			$prestataire=$_REQUEST['pseudo'];
			$message="<h1>Notification</h1>";
			$message.="<p>Bonjour $prestataire, nous vous envoyons ce mail pour confirmer votre inscription sur notre site. <br> Merci</p>";		
			$request->envoyerMail($_REQUEST['email'],$prestataire,"Inscription",$message,$message);
			$_SESSION['prestataire']=recherchePrestataire($_REQUEST['pseudo']);
			if (isset($_REQUEST['remember'])) {
				$_COOKIES['prestataire']=$_SESSION['prestataire'];
			}
			header("Location:profilPrest.php");
		}
		else{
				$_SESSION['errcon']="Pseudo deja utilisé ! ";
				$_SESSION['pseudo']=$_REQUEST['pseudo'];
				$_SESSION['mdp']=$_REQUEST['mdp'];
				$_SESSION['nom']=$_REQUEST['nom'];
				$_SESSION['prenom']=$_REQUEST['prenom'];
				$_SESSION['adresse']=$_REQUEST['adresse'];
				$_SESSION['tel']=$_REQUEST['tel'];
				$_SESSION['email']=$_REQUEST['email'];
				header("Location:index.php#linkPres");}
		}
	else
		echo "Probleme";
 ?>