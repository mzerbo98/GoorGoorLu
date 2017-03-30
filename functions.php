<?php
	include('database.php');

	//Fonction qui permet d'ajouter un slide à la liste des categories prestatons dans la page d'acceuil
	function ajouterslide($prestation,$index,$nombre){
		$nom = $prestation['libelle'];
		$desc = $prestation['description'];?>
		<div class="mySlides2 fade">
			<div class="numbertext"><?php echo ($index+1)." / $nombre"; ?></div>
			<img src=<?php echo "'img/Prestations/$nom.png' id='prest".($index+1)."'"; ?> style="width:50%; height : auto;margin-left : 25%;">
			<div class="text"><?php echo "<h1>$nom</h1>$desc"; ?></div>
		</div>	
 <?php }

 	//Fonction qui permet d'ajouter un slide à la liste des resultats de recherche
 	function ajouterResultat($prestataire,$index,$nombre){
 		$pseudo = $prestataire['pseudo'];
		$nom = $prestataire['prenom']." ".$prestataire['nom'];
		$note = $prestataire['satisfaction'];
		$tarif = $prestataire['tarif'];
		$tel = $prestataire['tel']; 
		$email = $prestataire['email']; ?>
		<div class="mySlides2 fade">
			<div class="numbertext"><?php echo ($index+1)." / $nombre"; ?></div>
			<div class="card">
				<img src=<?php echo "'uploads/$pseudo.png'"; ?> alt="Avatar" style="width:100%">
				<div class="cardcontainer">
				    <h4><b><?php echo $nom; ?></b></h4> 
				    <p>Satisfaction moyenne : <?php echo $note*20; ?>%</p> 
				    <button onclick="elt('<?php echo "details$index"; ?>').style.display='block';" style="width: 40%; margin-left: 30%;">Details</button>
				</div>
			</div>
		</div>	
		<div id="<?php echo "details$index"; ?>" class="modal">
			 <div class="modal-content animate" action="login.php" method="POST">
			    <div class="form">
			    	<img style="width: 15%;height: 100%;left:0;top: 0;margin: 0;" src=<?php echo "'uploads/$pseudo.png'"; ?>>				<h3><b><?php echo $nom; ?></b></h3> 
			    	<h4>Satisfaction Moyenne : <?php echo $note*20; ?>%</h4>
			    	<h4>Tarifs : <?php echo $tarif; ?> FCFA</h4>
			    	<h4><b>Contacts</b></h4>
			    	<h5 style="margin-left: 10%;">N° de Téléphone : <?php echo $tel; ?></h5>
			    	<h5 style="margin-left: 10%;">Adresse Email : <?php echo $email; ?></h5>
			      <br>
			      	<form id='<?php echo "form$index"; ?>'>
			   			<input type="hidden" name="pseudo" value="<?php echo $pseudo; ?>">
					</form>
			    </div>

			    <div class="form log" style="background-color:#f1f1f1">
			      	<button type="button" onclick="elt('<?php echo "details$index"; ?>').style.display='none'" class="cancelbtn" style="width: 20%;">Annuler</button>
			      	<button type="button" onclick="afficheEnvoi('<?php echo "$index"; ?>');" style="width: 40%;margin-left: 35%;" >Je travaille avec lui</button>
			    </div>
			  </div>
		</div>			     
 <?php }

 	//Fonction qui ajoute un slide a la liste des travaux non confirmes par un prestataire

 	function ajouterClientNonConfirme($client,$index,$nombre){
 		$code=$client['code'];
		$nom = $client['prenom']." ".$client['nom'];
		$prestation = $client['service_prestation'];
		$tel = $client['tel']; 
		$email = $client['email']; ?>
		<div class="mySlides2 fade">
			<div class="numbertext"><?php echo ($index+1)." / $nombre"; ?></div>
			<div class="card">
				<h4>Client : <?php echo $nom; ?></h4>
				<h4>N° Telephone : <?php echo $tel; ?></h4>
				<h4>Email : <?php echo $email; ?></h4>
				<h4>Type de prestation : <?php echo $prestation; ?></h4>
				<div class="cardcontainer">
				    <button onclick="elt('<?php echo "cancel$index"; ?>').submit();" style="width: 30%; margin-left: 20%;">Annuler</button>
				    <button onclick="elt('<?php echo "confirm$index"; ?>').submit();" style="width: 30%; margin-left: 20%;">Coonfirmer</button>
				</div>
			</div>
		</div>
		<form id="<?php echo "confirm$index"; ?>" method="POST" action="confirmerClient.php"  >
			<input type="hidden" name="code" value="<?php echo $code; ?>">
		</form>	  
		<form id="<?php echo "cancel$index"; ?>" method="POST" action="annulerClient.php"  >
			<input type="hidden" name="code" value="<?php echo $code; ?>">
		</form>	  
 <?php }

  	function ajouterTravalNonFait($client,$index,$nombre){
 		$code=$client['code'];
		$nom = $client['prenom']." ".$client['nom'];
		$prestation = $client['service_prestation'];
		$tel = $client['tel']; 
		$email = $client['email']; ?>
		<div class="mySlides2 fade">
			<div class="numbertext"><?php echo ($index+1)." / $nombre"; ?></div>
			<div class="card">
				<h4>Client : <?php echo $nom; ?></h4>
				<h4>N° Telephone : <?php echo $tel; ?></h4>
				<h4>Email : <?php echo $email; ?></h4>
				<h4>Type de prestation : <?php echo $prestation; ?></h4>
				<div class="cardcontainer">
				    <button onclick="elt('<?php echo "fait$index"; ?>').submit();" style="width: 40%; margin-left: 30%;">Declarer fait</button>
				</div>
			</div>
		</div>
		<form id="<?php echo "fait$index"; ?>" method="POST" action="confirmertravail.php"  >
			<input type="hidden" name="code" value="<?php echo $code; ?>">
		</form>	  
 <?php }

 function ajouterTravalFait($client,$index,$nombre){
 		$code=$client['code'];
		$nom = $client['prenom']." ".$client['nom'];
		$prestation = $client['service_prestation'];
		$tel = $client['tel']; 
		$email = $client['email']; ?>
		<div class="mySlides2 fade">
			<div class="numbertext"><?php echo ($index+1)." / $nombre"; ?></div>
			<div class="card">
				<h4>Client : <?php echo $nom; ?></h4>
				<h4>N° Telephone : <?php echo $tel; ?></h4>
				<h4>Email : <?php echo $email; ?></h4>
				<h4>Type de prestation : <?php echo $prestation; ?></h4>
			</div>
		</div>
 <?php }

 	//Fonction qui inscrit un prestataire dans le site
 	function inscrire($pseudo,$mdp,$nom,$prenom,$adresse,$tel,$email){
 		if(recherchePrestataire($pseudo)!=false)
 			return false;
 		$mdp=md5($mdp);
 		addPrestataire($pseudo,$mdp,$nom,$prenom,$adresse,$tel,$email);
 			return true;
 	}

 	//Fonction qui ajoute un travail de client dans le site
 	function ajouterClient($prestataire,$prestation,$prenom,$nom,$email,$tel){
 		$n1=nombreClientPrestation($prestation)%100;
 		$n2=nombreClientPrestataire($prestation)%100;
 		$n3=nombreClient($prestataire,$prestation)%100;
 		$n1=(nombreClientPrestation($prestation)<10)?"0".$n1:$n1;
 		$n2=(nombreClientPrestation($prestation)<10)?"0".$n2:$n2;
 		$n3=(nombreClientPrestation($prestation)<10)?"0".$n3:$n3;
 		$code="P".$prestation[0].$prestataire[0].$n1.$n2.$n3.rand(0,9);
 		while (rechercheClient($code!=false))
 		{
 			substr_replace($code, rand(0,9), 9,1);
 		} 
 		$code=strtoupper($code);
 		addClient($code,$prestataire,$prestation,$prenom,$nom,$email,$tel);
 	}

 	function ajouterCode($prestataire){
 		$code="C";
 		for ($i=0; $i < 9; $i++) { 
 			$code.=rand(0,9);
 		}
 		while (rechercheCode($code)!=false) {
 			substr_replace($code, rand(0,9), rand(0,9),1);
 		}
 		deleteCode($prestataire);
 		addCode($code,$prestataire);
 		return $code;
 	}

 	//Fonction qui permet de verifier les identifiants d'un prestataire lors de la connection
 	function connection($pseudo,$mdp){
 		if (recherchePrestataire($pseudo)) {
 			$pres=recherchePrestataire($pseudo);
 			$mdp=md5($mdp);
 			if($pres['mdp']==$mdp)
 				return $pres;
 		} else 
 			return false; 		
 	}

 	//Fonction qui permet de declarer le travail d'un client comme faite
 	function validerTravailClient($code){
 		if (estConfirme($code)) {
 			updateClient($code,true,true,false);
 			return true;
 		}
 		return false;
 	}

 	//Fonction qui permet au prestataire de confirmer qu'il travaille avec un client
 	function confirmerClient($code){
 		if (rechercheClient($code)) {
 			updateClient($code,true,false,false);
 			return true;
 		}
 			return false;
 	}

 	//Fonction permettant de noter un prestataire
 	function noterPrestataire($code,$prestataire,$prestation,$note){
 		updateClient($code,true,true,true);
		updateNote($prestataire,$prestation,$note);
 	}

 	//Fonction qui met a jour le mot de passe d'un prestataire
 	function changerMDP($pseudo,$mdp){
 		$prestataire=recherchePrestataire($pseudo);
 		$mdp=md5($mdp);
 		updatePrestataire($pseudo,$mdp,$prestataire['nom'],$prestataire['prenom'],$prestataire['adresse'],$prestataire['tel'],$prestataire['email']);
 	}
 ?>