<?php require "lib/loader.php" ; ?>
	<?php
		if (!empty($_POST)) {
			$pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
			$mdp = htmlentities(sha1($_POST['mdp']), ENT_QUOTES);
					
			global $connexion;
			$sql ="
			SELECT *
			FROM membre
			WHERE pseudo = '$pseudo' AND mdp = '$mdp' 
			";
			$requete = $connexion->query($sql);
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			// à completer pour une connexion sécurisé
			if($resultat == false){
				echo "mauvais ID ou Mot de passe";
			}else if ($mdp == $resultat['mdp']){
				foreach ($resultat as $key => $value) {
					$_SESSION['membre'][$key] = $value;
				}
				echo "<p style='color:green'>Bienvenue " . $_SESSION['membre']['pseudo'] . " !! </p><br>";
				header("refresh:1;URL=profil.php");
			}
		}	
		if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
			session_destroy();
		}
	?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta charset="UTF-8">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Bootstrap core CSS -->
  		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  		<!-- Custom styles for this template -->
  		<link href="css/shop-homepage.css" rel="stylesheet">
		<link rel="icon" href="lib/img/favicon.ico">
	</head>
	<?php require "template/header.php" ?>




<div class="formulaire">
	<form action="#" method="POST">
		<h3>Se connecter</h3>
		<!-- Pseudo -->
		<div class="form-row">
			<div class="form-group col-md-3 ">
				<label for="pseudo"></label><br>
				<input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" required>
			<!-- Mot de passe -->
				<label for="mdp"></label><br>
				<input class="form-control" type="password" name="mdp" placeholder="Votre mot de passe" required><br>
				<div class="d-flex justify-content-center">
					<input class="btn btn-outline-primary" type="submit" name="envoyer" value="Connexion" >
				</div>
			</div>
		</div>
	</form>
</div>



	<?php require "template/footer.php" ?>