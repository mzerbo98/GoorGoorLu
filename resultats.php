<!DOCTYPE html>
<html>
	<head>
		<title>GoorGoorlu</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="img/icon.png">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/slides.css">
		<link rel="stylesheet" type="text/css" href="css/forms.css">
		<script type="text/javascript" src ="js/goorgoorlu.js"></script>
	</head>
	<body>
		<?php session_start();
		include("functions.php") ;?>
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="img/logo.png"></a>
			</div>
			<div>
				<h1>Résultats de recherche : </h1>
				<?php 
					if (isset($_REQUEST['zone'])) {
						$zone=$_REQUEST['zone'];
						$prestation=$_REQUEST['prestation'];
						$prestataires=recherchePrestataires($zone,$prestation);
						if ($prestataires!=false) {?>
							<h5 style="margin-left: 10%;">Veuillez utiliser les flèches pour naviguer entre les résultats : </h5>
							<div class="slideshow-container" style="height: 20%">
							<?php 								
								$n=count($prestataires);
								for($i=0;$i<$n;$i++)
									ajouterResultat($prestataires[$i],$i,$n);				
							 ?>
								<a class="prev" onclick="plusSlides(-1)">❮</a>
								<a class="next" onclick="plusSlides(1)">❯</a>
							</div>
							<br>
							<div style="text-align:center">
							  <?php for ($i=0; $i < $n; $i++) { 
							  echo '<span class="dot2" onclick="currentSlide('.($i+1).')"></span> ';
							  } ?>
							</div>

							<div id="senddiv" class="modal">
								<span onclick="elt('senddiv').style.display='none'" class="close" title="Fermer">×</span>
								<form id="sendform" class="modal-content animate" action="clients.php" method="POST" onsubmit="return validNumero(elt('numtel').value);">						   	
								   	<input type="hidden" name="pseudo">
								   	<input type="hidden" name="prestation" value="<?php echo $prestation; ?>">
								   	<div class="form">
								   		<input type="text" name="prenom" placeholder="Veuillez entrer votre prenom" required>
								   		<input type="text" name="nom" placeholder="Veuillez entrer votre nom" required>
								   		<input type="email" name="email" placeholder="Veuillez entrer votre adresse email" required>
								   		<input type="tel" id="numtel" name="tel" placeholder="Veuillez entrer votre numero de téléphone" required>
								   	</div>
								   	<div class="form log" style="background-color:#f1f1f1">
								      	<button type="button" onclick="elt('senddiv').style.display='none'" class="cancelbtn" style="width: 40%;margin-left: 5%;">Annuler</button>
								      	<button type="submit" style="width: 40%;margin-left: 10%;">Valider</button>
								    </div>
								</form>
							</div>	
							<br>
							<?php
						}
						else
							echo "<h3 style='margin-left : 30%'>Aucun résultat</h3>";
					}
					else
						header("Location:index.php")
				 ?>
			</div>
		</div>
		<script type="text/javascript" src="js/resultats.js"></script>
		<script type="text/javascript">
			function afficheEnvoi(id){
				elt("details"+id).style.display='none';
				elt("sendform").pseudo.value=elt('form'+id).pseudo.value;
				elt("senddiv").style.display='block';
			}
		</script>
	</body>
</html>