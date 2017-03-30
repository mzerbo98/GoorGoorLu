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
		<script type="text/javascript">
			function envoi () {
				var nom = elt("prest"+slideIndex2).src;
				var d = nom.lastIndexOf("/")+1;
				var f = nom.length-4;
				nom = nom.substring(d, f);
				elt("prestation").value=nom;
				elt("search").submit();
			}
			function valid () {
				if(elt("mdp").value==elt("mdp-repeat").value){
					if (validNumero(elt("tel").value))
						return true;
					else
						alert("Veuillez entrer un numero de telephone valide");}
				else
					alert("Les mots de passe doivent êtrent similaires");
				return false;
			}
			function validreset () {
				if(elt("mdpreset").value==elt("mdp-repeatreset").value)
						return true;
				else
					alert("Les mots de passe doivent êtrent similaires");
				return false;
			}
			function forgot () {
				if (elt("logpseudo").value!="") {
					elt("forgotform").pseudo.value=elt("logpseudo").value;
					elt("forgotform").submit();
				}
				else 
					alert("Veuillez renseigner votre pseudo");
			}
			function changerNote (n) {
				elt("note").value=n;
			}
			function noter () {
				elt("rateform").submit();
			}
		</script>
		<script type="text/javascript" src ="js/goorgoorlu.js">
		</script>
	</head>
	<body  bgcolor="#B0CECA">
		<?php session_start(); 
		if ((isset($_COOKIES['prestataire']) && $_COOKIES['prestataire']!=null)) {
			$_SESSION['prestataire']=$_COOKIES['prestataire'];
		}
			?>
		<div class="logo">
				<a href="index.php"><img src="img/logo.png"></a>
		</div>
		<div class="container">			

			<div class="slideshow-container">
			
				<div class="mySlides fade">
				  <div class="numbertext">1 / 9</div>
				  <img src="img/slides/1.jpg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <div class="numbertext">2 / 9</div>
				  <img src="img/slides/2.jpg" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <div class="numbertext">3 / 9</div>
				  <img src="img/slides/3.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">4 / 9</div>
				  <img src="img/slides/4.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">5 / 9</div>
				  <img src="img/slides/5.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">6 / 9</div>
				  <img src="img/slides/6.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">7 / 9</div>
				  <img src="img/slides/7.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">8 / 9</div>
				  <img src="img/slides/8.jpg" style="width:100%">
				</div>
				<div class="mySlides fade">
				  <div class="numbertext">9 / 9</div>
				  <img src="img/slides/9.jpg" style="width:100%">
				</div>

				</div>
				<br>

				<div style="text-align:center">
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				  <span class="dot"></span> 
				</div>

				<h3 id="linkPres">Vous proposez des services ? </h4>


				<a href="<?php echo isset($_SESSION['prestataire'])?'profilPrest.php':'#logform'; ?>">
					<button style="margin-left: 40%;text-align: center;" onclick="<?php echo isset($_SESSION['prestataire'])?"":"elt('logform').style.display='block'"; ?>">Connexion</button>
				</a>

				 <?php $pseudo=isset($_SESSION['pseudo'])?$_SESSION['pseudo']:""; 
				  		?>
				<div id="logform" class="modal">
  
				  <span onclick="elt('logform').style.display='none'" class="close" title="Fermer">×</span>
				  <form class="modal-content animate" action="login.php" method="POST">
				    <div class="form">
				      <label><b>Pseudo</b></label>
				      <input type="text" placeholder="Pseudo" id="logpseudo" value=<?php echo "'$pseudo'"; ?> name="pseudo" required>

				      <label><b>Mot de Passe</b></label>
				      <input type="password" placeholder="Mot de Passe" value="" name="mdp" required>
				        
				      <button type="submit">Connexion</button>
				      <br>
				      <br>
				      Se souvenir de moi 
				      <label class="switch">
						  <input type="checkbox" name="remember"> 
						  <div class="slider round"></div>
						</label>
				    </div>

				    <div class="form log" style="background-color:#f1f1f1">
				      <button type="button" onclick="elt('logform').style.display='none'" class="cancelbtn">Annuler</button>
				     	 <span class="psw">Mot de passe <a href="#logform" onclick="forgot();">oublié?</a></span>
				    </div>
				  </form>
				</div>
				<form id="forgotform" method="POST" action="forgotpwd.php">
					<input type="hidden" name="pseudo">
				</form>

				  <br><br>
				<button style="margin-left: 40%;<?php if (isset($_SESSION['prestatires'])) {echo "display: none";} ?>" onclick="elt('signform').style.display='block'">Inscription</button>			
				<div id="signform" class="modal">
				<?php 
					$prenom=isset($_SESSION['prenom'])?$_SESSION['prenom']:"";
					$nom=isset($_SESSION['nom'])?$_SESSION['nom']:"";
					$adresse=isset($_SESSION['adresse'])?$_SESSION['adresse']:"";
					$email=isset($_SESSION['email'])?$_SESSION['email']:"";
					$tel=isset($_SESSION['tel'])?$_SESSION['tel']:"";
					$pic=isset($_SESSION['pic'])?$_SESSION['pic']:"";
				 ?>
				  <span onclick="elt('signform').style.display='none'" class="close" title="Fermer">×</span>
				  <form class="modal-content animate" action="signup.php" method="POST" onsubmit="return valid();">
				    <div class="form">
				      <label><b>Pseudo</b></label>
				      <input type="text" placeholder="Pseudo" name="pseudo" value=<?php echo "'$pseudo'"; ?> required>

				      <label><b>Mot de Passe</b></label>
				      <input type="password" placeholder="Mot de Passe" name="mdp" id="mdp" value="" required>

				      <label><b>Repeter le Mot de Passe</b></label>
				      <input type="password" placeholder="Confirmer le Mot de Passe" name="mdp-repeat" id="mdp-repeat" value="" required>
				      <label> <b>Prénom</b> </label>
				      <input type="text" placeholder="Prénom" name="prenom" value=<?php echo "'$prenom'"; ?> required>				      
				      <label> <b>Nom</b> </label>
				      <input type="text" placeholder="Nom" name="nom" value=<?php echo "'$nom'"; ?> required>
				      <label> <b>Adresse</b> </label>
				      <input type="text" placeholder="Adresse" name="adresse" value=<?php echo "'$adresse'"; ?> required>
				      <label> <b>Email</b> </label>
				      <input type="email" placeholder="email" name="email" value="<?php echo "$email"; ?>" required>
				      <label> <b>Téléphone</b> </label>
				      <input type="tel" placeholder="Téléphone" id="tel" name="tel" value=<?php echo "'$tel'"; ?> required>
				      <label> <b>Photo de profil</b> </label>
				      <br>
				      <input type="file" name="pic" value=<?php echo "'$pic'"; ?> accept="image/*">
				      <br>
				      Se souvenir de moi 
				      	<label class="switch">
						  <input type="checkbox" name="remember">
						  <div class="slider round"></div>
						</label>
				      <div class="clearfix">
				        <button type="button" onclick="elt('signform').style.display='none'" class="cancelbtn">Annuler</button>
				        <button type="submit" class="signupbtn">Sign Up</button>
				      </div>
				    </div>
				  </form>
				</div>
				<br>
				<br>
				<br>
				<button style="margin-left: 38%;width: 20%;<?php if (isset($_SESSION['prestatires'])) {echo "display: none;";} ?>" onclick="elt('resetform').style.display='block'">Reinitialisation</button>	

				<div id="resetform" class="modal">
  					<span onclick="elt('logform').style.display='none'" class="close" title="Fermer">×</span>
				  <form class="modal-content animate" action="resetpwd.php" method="POST" onsubmit="return validreset()">
				    <div class="form">
				      <label><b>Code</b></label>
				      <input type="text" placeholder="Veuillez entrer votre code de réinitialisation" name="code" required>
				       <label><b>Nouveau Mot de Passe</b></label>
				      <input type="password" placeholder="Mot de Passe" name="mdp" id="mdpreset" value="" required>
				      <label><b>Repeter le Mot de Passe</b></label>
				      <input type="password" placeholder="Confirmer le Mot de Passe" name="mdp-repeat" id="mdp-repeatreset" value="" required>
				      <button type="submit">Valider</button>
				      <br>
				    </div>

				    <div class="form log" style="background-color:#f1f1f1">
				      <button type="button" onclick="elt('forgotform').style.display='none'" class="cancelbtn">Annuler</button>
				    </div>
				  </form>
				</div>

				<br>
				<?php
					if (isset($_SESSION['errcon']) && $_SESSION['errcon']!="") {
					$message=$_SESSION['errcon'];
					$_SESSION['errcon']="";
					echo "<span style='color : red;'>$message</span>";
					}					
				 ?>
				<br>
				<h3>Vous recherchez un prestataire ?</h4>
				<h4 style="margin-left:5%;">Quel genre de service voulez vous ?</h5>
				<div class="slideshow-container" style="height: 20%">
				<?php 
					include("functions.php");
					$prest=loadPrestations();
					$n=count($prest);
					for($i=0;$i<$n;$i++)
						ajouterslide($prest[$i],$i,$n);				
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
				<br>
				<h4 style="margin-left:5%;">Où habitez vous ?</h5>
				<form name="search" id="search" method="GET" action="resultats.php">
					<input type="hidden" name="prestation" id="prestation">
					<select name="zone" style="width: 20%;margin-left: 40%;font-size: 20px;" >
						<?php 
						$zones=loadZones();
						$n=count($zones);
						for ($i=0; $i < $n; $i++) { 
							echo "<option value='$zones[$i]'>$zones[$i]</option>";
						}
						mysqli_close($con);
						?>
					</select>
				</form>				
				<br>
				<br>
				<button style="width: 20%;margin-left: 40%;" onclick="envoi();">Rechercher</button><br><br>
				<?php if (isset($_SESSION['clsuccess']) && $_SESSION['clsuccess']!="") {
					$message=$_SESSION['clsuccess'];
					$_SESSION['clsuccess']="";
					echo " <br/> <span style='color : lightblue;'>$message</span>";
				} ?>
				<h3  id="notation">Voulez vous noter un service rendu ?</h3>
				<form name="rateform" action="notation.php" method="POST">
					<h4 style="margin-left:5%;">Veuillez entrer le code fourni : </h4>
					<input type="text" name="code" style="width: 50%;margin-left: 25%;margin-top: 0;" placeholder="Code du service" required>
					<?php
						if (isset($_SESSION['errnote']) && $_SESSION['errnote']!="") {
						$message=$_SESSION['errnote'];
						$_SESSION['errnote']="";
						echo " <br/> <span style='color : red;'>$message</span>";
						}					
					 ?>
					<h4 style="margin-left:5%;">Choisissez une note sur 5 : </h4>
					<div class="etoile">
					<a href="#5" onclick="changerNote('5');" title="Donner 5 Etoiles">★</a>
					<a href="#4" onclick="changerNote('4');" title="Donner 4 Etoiles">★</a>
					<a href="#3" onclick="changerNote('3');" title="Donner 3 Etoiles">★</a>
					<a href="#2" onclick="changerNote('2');" title="Donner 2 Etoiles">★</a>
					<a href="#1" onclick="changerNote('1');" title="Donner 1 Etoile">★</a>
					</div>
					<input type="hidden" name="note" id="note" value="0">
					<br>
					<button type="submit" style="margin-left: 45%;">Noter</button>
				</form>
				<br>
				<br>

		</div>
		<script type="text/javascript" src="js/index.js"></script>
	</body>
</html>