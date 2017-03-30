<?php
	$con=mysqli_connect('localhost','root','','goorgoorlu') or die("erreur de connexion a la base");

	//Fonction qui permet de charger la liste des categories de prestation de la base de données
	function loadPrestations(){
		global $con;
		$result=mysqli_query($con,'select * from prestation_t');
		if (mysqli_num_rows($result)>=1) {
		while ($p=mysqli_fetch_array($result)) {
			$prestations[]=$p;
		}
		return $prestations;
		}
		else
			return false;
	}

	//Fonction qui permet de charger la liste des zones de la base de données
	function loadZones(){
		global $con;
		$result=mysqli_query($con,'select * from zone_t');
		if (mysqli_num_rows($result)>=1) {
		while ($z=mysqli_fetch_array($result)) {
			$zones[]=$z['nom'];
		}
		return $zones;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les travaux de client non confirmes par un prestataire
	function loadClientNonConfirme($prestataire){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire' and not confirme ");
		if (mysqli_num_rows($result)>=1) {
		while ($c=mysqli_fetch_array($result)) {
			$clients[]=$c;
		}
		return $clients;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les travaux de client confirmes mais non faits par un prestataire
	function loadClientNonFaits($prestataire){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire' and confirme and not fait");
		if (mysqli_num_rows($result)>=1) {
		while ($c=mysqli_fetch_array($result)) {
			$clients[]=$c;
		}
		return $clients;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les travaux de client faits par un prestataire
	function loadClientFaits($prestataire){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire' and fait");
		if (mysqli_num_rows($result)>=1) {
		while ($c=mysqli_fetch_array($result)) {
			$clients[]=$c;
		}
		return $clients;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les types de service proposés par un prestataire
	function loadPrestationsPrestataire($prestataire){
		global $con;
		$result=mysqli_query($con,"select * from service_t where prestataire like '$prestataire' ");
		if (mysqli_num_rows($result)>=1) {
		while ($s=mysqli_fetch_array($result)) {
			$p[]=$s;
		}
		return $p;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les types de service non proposés par un prestataire
	function loadPrestationsNonPrestataire($prestataire){
		global $con;
		$result=mysqli_query($con,"select libelle from prestation_t where libelle not in (select prestation from service_t where prestataire like '$prestataire') ");
		if (mysqli_num_rows($result)>=1) {
		while ($s=mysqli_fetch_array($result)) {
			$p[]=$s['libelle'];
		}
		return $p;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les zones couvertes par un prestataire
	function loadZonePrestataire($prestataire){
		global $con;
		$result=mysqli_query($con,"select zone from couverture_t where prestataire like '$prestataire' ");
		if (mysqli_num_rows($result)>=1) {
		while ($z=mysqli_fetch_array($result)) {
			$zones[]=$z['zone'];
		}
		return $zones;
		}
		else
			return false;
	}

	//Fonction qui permet de charger les zones non couvertes par un prestataire
	function loadZoneNonCouvertesPrestataire($prestataire){
		global $con;
		$result=mysqli_query($con,"select nom from zone_t where nom not in (select zone from couverture_t where prestataire like '$prestataire') ");
		if (mysqli_num_rows($result)>=1) {
		while ($z=mysqli_fetch_array($result)) {
			$zones[]=$z['nom'];
		}
		return $zones;
		}
		else
			return false;
	}

	//Fonction qui permet de rechercher l'ensemble des prestatires effectuant une categorie de prestation dans une zone donnée
	function recherchePrestataires($zone,$prestation){
		global $con;
		$result=mysqli_query($con,"select pseudo,nom,prenom,adresse,tel,email,tarif,satisfaction from prestataire_t join service_t on prestataire_t.pseudo=service_t.prestataire where pseudo in (select service_t.prestataire from couverture_t join service_t on couverture_t.prestataire=service_t.prestataire where zone like '$zone' and prestation like '$prestation' and disponible) order by satisfaction DESC" );
		if (mysqli_num_rows($result)>=1) {
			while ($p=mysqli_fetch_array($result)) {
			$prestataires[]=$p;
			}
			return $prestataires;
		}
		else
			return false;
	}

	//Focntion qui permet de rechercher un prestataire en fonction de son pseudo
	function recherchePrestataire($pseudo){
		global $con;
		$result=mysqli_query($con,"select * from prestataire_t where pseudo like '$pseudo'");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result);
		}
		else
			return false;
	}

	//Focntion qui permet de rechercher un travail de client en fonction de son code
	function rechercheClient($code){
		global $con;
		$result=mysqli_query($con,"select * from client_t where code like '$code'");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result);
		}
		else
			return false;
	}

	//Focntion qui permet de rechercher la note d'un prestataire pour une categorie de prestation donnée
	function rechercheNote($prestataire,$prestation){
		global $con;
		$result=mysqli_query($con,"select satisfaction from service_t where prestataire like '$prestataire' and '$prestation' ");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result)['satisfaction'];
		}
	}

	//Fonction qui permet de rechercher le prestataire coorespondant à un code de réinitialisation
	function rechercheCode($code){
		global $con;
		$result=mysqli_query($con,"select pseudo from reinitialisation_t where code like '$code'");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result)['pseudo'];
		}
		else
			return false;
	}

	//Fonction qui renvoie le nombre de client d'un prestataire pour une categorie de prestation donnée
	function nombreClient($prestataire,$prestation){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire' and service_prestation like '$prestation' ");
		return mysqli_num_rows($result);
	}

	//Fonction renvoyant le nombre de client ayant noté une categorie de prestation d'un prestataire
	function nombreClientNote($prestataire,$prestation){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire' and service_prestation like '$prestation' and note");
		return mysqli_num_rows($result);
	}

	//Fonction qui renvoie le nombre de client d'un prestataire donné
	function nombreClientPrestataire($prestataire){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestataire like '$prestataire'");
		return mysqli_num_rows($result);
	}

	//Fonction qui renvoie le nombre de client d'une categorie de prestation donnée
	function nombreClientPrestation($prestation){
		global $con;
		$result=mysqli_query($con,"select * from client_t where service_prestation like '$prestation' ");
		return mysqli_num_rows($result);
	}

	//Fonction qui permet de savoir si un travail de client a été confirmé par un prestataire
	function estConfirme($code){
		global $con;
		$result=mysqli_query($con,"select confirme from client_t where code like '$code' ");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result)['confirme']==1;
		}
		return false;
	}

	//Fonction qui permet de savoir si un travail de client a été fait par un prestataire
	function estFait($code){
		global $con;
		$result=mysqli_query($con,"select fait from client_t where code like '$code' ");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result)['fait']==1;
		}
		return false;
	}

	//Fonction qui permet de savoir si un travail a deja été noté
	function estNote($code){
		global $con;
		$result=mysqli_query($con,"select note from client_t where code like '$code' ");
		if (mysqli_num_rows($result)==1) {
			return mysqli_fetch_array($result)['note']==1;
		}
		return false;
	}

	//Fonction qui ajoute un prestataire à la base de donnée
	function addPrestataire($pseudo,$mdp,$nom,$prenom,$adresse,$tel,$email){
		global $con;
		mysqli_query($con,"insert into prestataire_t values('$pseudo','$mdp','$nom','$prenom','$adresse','$tel','$email')");
	}

	//Fonction qui ajoute un client à la base de donnée
	function addClient($code,$prestataire,$prestation,$prenom,$nom,$email,$tel){
		global $con;
		mysqli_query($con,"insert into client_t values('$code','$prestataire','$prestation','$prenom','$nom','$email',0,'$tel',0)");
	}

	//Fonction qui ajoute une categorie de prestation à la base de données
	function addPrestation($lib,$desc){
		global $con;
		mysqli_query($con,"insert into prestation_t values('$lib','$desc') ");
	}

	//Fonction qui ajoute une  zone a la base de données
	function addZone($nom){
		global $con;
		mysqli_query($con,"insert into zone_t values('$nom') ");
	}

	//Fonction qui ajoute une zone a la couverture d'un prestataire dans la base de donnée
	function addZonePrestataire($prestataire,$zone){
		global $con;
		mysqli_query($con,"insert into couverture_t values('$prestataire','$zone') ");
		echo "insert into couverture_t values('$prestataire','$zone') ";
	}

	//Fonction qui ajoute un servvice a la liste des servies offerts par un prestataire
	function addPretationPrestataire($prestataire,$prestation,$tarif,$dispo){
		global $con;
		mysqli_query($con,"insert into service_t values('$prestataire','$prestation',$tarif,$dispo,0) ");
	}

	//Fonction qui ajoute un code de réinitialisation à la base de donnée
	function addCode($code,$prestataire){
		global $con;
		mysqli_query($con,"insert into reinitialisation_t values('$code','$prestataire')");
	}

	//Fonction qui permet de mettre a jour la note d'un prestataire pour une categorie de prestation donnée
	function updateNote($prestataire,$prestation,$note){
		global $con;
		mysqli_query($con,"update service_t set satisfaction=$note where prestataire like '$prestataire' and prestation like '$prestation' ");
	}

	//Fonction qui permet de mettre a jour le tarif ou la disponibilité d'une prestation donnée par un prestataire

	function updateService($prestataire,$prestation,$tarif,$dispo){
		global $con;
		mysqli_query($con," update service_t set tarif=$tarif,disponible=$dispo where prestataire like '$prestataire' and prestation like '$prestation' ");
	}

	//Fonction qui permet de mettre a jour je statut de confirmation ou de travail effectué d'un travail de client dans la baSe de données
	function updateClient($code,$confirme,$fait,$note){
		global $con;		
		mysqli_query($con,"update client_t set fait=$fait, confirme=$confirme,note=$note where code like '$code' ");
		mysqli_query($con,"update client_t set fait=$fait, confirme=$confirme,note=$note where code like '$code' ");
	}

	//Fonction qui permet de mettre a jour le mot de passe, le nom, le prenom, l'adresse, le numero de telephone ou l'adresse email d'un prestataire
	function updatePrestataire($pseudo,$mdp,$nom,$prenom,$adresse,$tel,$email){
		global $con;
		mysqli_query($con,"update prestataire_t set mdp='$mdp',nom='$nom',prenom='$prenom',adresse='$adresse',tel='$tel',email='$email' where pseudo like '$pseudo'");
	}

	//Fonction qui permet de mettre a jour une categorie de prestation
	function updatePrestation($lib,$desc){
		global $con;
		mysqli_query($con," update prestation_t set libelle='$lib',description='$desc' where libelle like '$lib' ");
	}

	//Fonction qui supprime un travail de client de la base de donnée
	function deleteClient($code){
		global $con;
		mysqli_query($con,"delete from client_t where code like '$code'");
	}

	//Fonction qui supprime un code de réinitialisation de la base de donnée
	function deleteCode($prestataire){
		global $con;
		mysqli_query($con,"delete from reinitialisation_t where pseudo like '$prestataire'");
	}

	//Fonction qui supprime une zone de la couverture d'un prestataire
	function deleteZonePrestataire($prestataire,$zone){
		global $con;
		mysqli_query($con," delete from couverture_t where prestataire like '$prestataire' and zone like '$zone' ");
	}

	//Fonction qui supprime une prestation de la liste des prestations offertes par un prestataire
	function deletePrestationPrestataire($prestataire,$prestation){
		global $con;
		mysqli_query($con," delete from service_t where prestataire like '$prestataire' and prestation like '$prestation' ");
	}

	//Fonction qui supprime un prestataire de la base de données
	function deletePrestataire($prestataire){
		global $con;
		mysqli_query($con," delete from prestataire_t where pseudo like '$prestataire' ");
	}

	//Fonction qui supprime une categorie de prestation de la base de données
	function deletePrestation($lib){
		global $con;
		mysqli_query($con," delete from prestation_t where libelle like '$lib' ");
	}

	//Fonction qui supprime une zone de la base de données
	function deleteZone($nom){
		global $con;
		mysqli_query($con," delete from zone_t where nom like '$nom' ");
	}

 ?>