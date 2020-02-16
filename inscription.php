<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Inscription</title>
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

<?php
	
    if(isset($_POST['envoyer'])) {
    	session_destroy();
    	$pseudo = htmlspecialchars($_POST['pseudo']);
    	$email = htmlspecialchars($_POST['email']);
    	$mdp = sha1($_POST['mdp']);
    	$mdp2 = sha1($_POST['mdp2']);
    	$nom = htmlspecialchars($_POST['nom']);
    	$prenom = htmlspecialchars($_POST['prenom']);
    	$civilite = htmlspecialchars($_POST['civilite']);
           

		if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){

			$pseudolength = strlen($pseudo);
			if($pseudolength <= 20){

				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

					$reqmail = $connexion->prepare("SELECT * FROM membre WHERE email = ?");
					$reqmail->execute(array($email));
					$mailexist = $reqmail->rowCount();
					
					if($mailexist == 0) {

						if($mdp == $mdp2) {
							$reqpseudo = $connexion->prepare("SELECT * FROM membre WHERE pseudo = ?");
							$reqpseudo->execute(array($pseudo));
							$pseudoexist = $reqpseudo->rowCount();

							if($pseudoexist == 0){
								
								$sql = "
								INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut) 
								VALUES('$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', 'Membre')";
								$requete = $connexion->exec($sql);
								$message = "<h3>Votre compte a bien été créé ! <h3><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 3 secondes</p>";
								echo $message;
								header("refresh:3;URL=connexion.php");

							} else {
								$message = "Ce pseudo est déjà utilisé";
								echo $message;
							}
                        } else {
							$message = "Vos mots de passe ne correspondent pas !";
							echo $message;
						}
                    } else {
						$message = "Votre adresse mail déjà utilisée !";
						echo $message;
					}
				} else {
					$message = "Votre adresse mail n'est pas valide !";
					echo $message;
				}
			} else {
				$message = "Votre pseudo ne doit pas dépasser 20 caractères !";
				echo $message;
			}
		} else {
			$message = "Tous les champs doivent être complétés !";
			echo $message;
		}
	}


?>

	<div class="formulaire">
		<form action="#" method="POST">
			<div class="form-row">
				<div class="form-group col-md-3 ">	
					<h3>S'inscrire</h3>
					<!-- Pseudo -->
						<label for="pseudo"></label><br>
						<input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required>
					<!-- Mot de passe -->
						<label for="mdp"></label><br>
						<input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required>
					<!-- Mot de passe Verif -->
						<label for="mdp2"></label><br>
						<input type="password" name="mdp2" placeholder="Confirmer votre mot de passe" class="form-control" required>
					<!-- Nom -->
						<label for="nom"></label><br>
						<input type="text" name="nom" placeholder="Votre nom" class="form-control" required>
					<!-- Prénom -->
						<label for="prenom"></label><br>
						<input type="text" name="prenom" placeholder="Votre prénom" class="form-control" required>
					<!-- Adresse Mail -->
						<label for="mail"></label><br>
						<input type="mail" name="email" placeholder="Votre E-mail" class="form-control" required><br>
					<!-- Civilité (m/f) -->
						<select class="form-control" name="civilite">
							<option value="m">Homme</option>
							<option value="f">Femme</option>
						</select><br>
						<div class="d-flex justify-content-center">
							<input class="btn btn-outline-primary" type="submit" name="envoyer" value="Inscription">
						</div>
				</div>
			</div>
		</form>
	</div>

	<?php require "template/footer.php" ?>