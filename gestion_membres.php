<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Gestion des membres</title>
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
	<?php require "template/header.php"; ?>
	<?php 
		if($_POST){
			global $connexion;

			$pseudo = $_POST["pseudo"];
			$mdp = $_POST["mdp"];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$email = $_POST['email'];
			$civilite = $_POST['civilite'];
			$statut = $_POST['statut'];

			$sql = "INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (NULL, '$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', '$statut', current_timestamp())";
			$requete = $connexion->exec($sql);


		echo "<h1 style='color:green'>L'utilisateur ayant pour <strong>Pseudo</strong> : " . $_POST['pseudo'] . " à bien été ajouté </h1><br>";
		}

	?>
	<table class="table table-dark">	
		<tr>
			<th>ID</th>
			<th>Pseudo</th>
			<th>Mdp</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>E-mail</th>
			<th>Civilité</th>
			<th>Statut</th>
			<th>date_enregistrement</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	<?php 
		$listeMembres = readMembreAll();
		foreach ($listeMembres as $show){
			
			echo "<tr>";
			echo "<td>" . $show["id"] . "</td>";
			echo "<td>" . $show["pseudo"] . "</td>";
			echo "<td>" . $show["mdp"] . "</td>";
			echo "<td>" . $show["nom"] . "</td>";
			echo "<td>" . $show["prenom"] . "</td>";
			echo "<td>" . $show["email"] . "</td>";
			echo "<td>" . $show["civilite"] . "</td>";
			echo "<td>" . $show["statut"] . "</td>";
			echo "<td>" . $show["date_enregistrement"] . "</td>";
			echo "<td>" . "<a href='update_membre.php?id_membre=" . $show['id'] . "'>Modifier</a></td>";
			echo "<td>" . "<a href='dell_membre.php?id_membre=" . $show['id'] . "'>Supprimer</a></td>";
			echo "</tr>";
		}
	
	?>
	</table>
	<h1 class="my-4 h3">Ajouter un contact à la liste ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="pseudo">Pseudo</label><br>
					<input class="form-control" type="text" name="pseudo" placeholder="Le pseudo" required>
				</p>
				<p>
					<label for="mdp">Mot de passe</label><br>
					<input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required>
				</p>
				<p>
					<label for="nom">Nom*</label><br>
					<input class="form-control" type="text" name="nom" placeholder="Le nom" required>
				</p>
				<p>
					<label for="prenom">Prenom*</label><br>
					<input class="form-control" type="text" name="prenom" placeholder="Le prénom" required>
				</p>
				<p>
					<label for="email">E-mail</label><br>
					<input class="form-control" type="email" name="email" placeholder="l'E-mail" required>
				</p>
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-5">
				<p>
					<label for="civilite">Civilité : </label><br>
					<select class="form-control" name="civilite">
						<option value="m">Homme</option>
						<option value="f">Femme</option>
					</select>
				</p>
				<p>
					<label for="statut">Statut : </label>
					<select class="form-control" name="statut" >
						<option value="Membre">Membre</option>
						<option value="Admin">Admin</option>
					</select>
					
				</p><br>
				<div class="d-flex justify-content-center">
					<input class="btn btn-outline-primary" type="submit" name="envoyer" value="Enregistrer" >
				</div>
			</div>
		</div>
	</form>


	<?php require "template/footer.php"; ?>

	<?php }else{
		echo "<h1 style='color:red'>Vous n'êtes pas Admin ou vous avez oublier de vous connecter<br> Connectez-vous !</h1>";
		echo "<p>Redirection...</p>";
		header("refresh:2;URL=connexion.php");
	} ?>