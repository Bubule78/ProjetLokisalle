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
		if(isset($_GET['id_membre'])){
			$id_membre = $_GET['id_membre'];
			global $connexion;

			$sql = "SELECT * FROM membre WHERE membre.id_membre = $id_membre";
			$requete = $connexion->query($sql);
			$result = $requete->fetch(PDO::FETCH_ASSOC);

			$pseudo = $result['pseudo'];
			$mdp = $result['mdp'];
			$nom = $result['nom'];
			$prenom = $result['prenom'];
			$email = $result['email'];
			$civilite = $result['civilite'];
			$statut = $result['statut'];
		}
	
		if($_POST){
			global $connexion;

			$pseudo = $_POST["pseudo"];
			$mdp = $_POST["mdp"];
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$email = $_POST['email'];
			$civilite = $_POST['civilite'];
			$statut = $_POST['statut'];

			$sql = "UPDATE `membre` SET `pseudo` = '$pseudo', `mdp` = '$mdp', `nom` = '$nom', `prenom` = '$prenom', `email` = '$email', `civilite` = '$civilite', `statut` = '$statut' WHERE membre.id_membre = '$id_membre'";
			$requete = $connexion->exec($sql);


		echo "<h1 style='color:green'>L'utilisateur ayant pour ID : " . $id_membre . " à bien été modifié </h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";
		header("refresh:6;URL=gestion_membres.php");
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
			if ($show["id"] == $_GET["id_membre"]){
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
		}
	
	?>
	</table>

	<h1 class="my-4 h3">Modifier le contact qui possède l'ID : <?php echo $_GET['id_membre']; ?> ci-dessus.</h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="pseudo">Pseudo</label><br>
					<input class="form-control" type="text" name="pseudo" value="<?php echo $pseudo ?>">
				</p>
				<p>
					<label for="mdp">Mot de passe</label><br>
					<input class="form-control" type="password" name="mdp" value="<?php echo $mdp ?>">
				</p>
				<p>
					<label for="nom">Nom</label><br>
					<input class="form-control" type="text" name="nom" value="<?php echo $nom ?>">
				</p>
				<p>
					<label for="prenom">Prenom</label><br>
					<input class="form-control" type="text" name="prenom" value="<?php echo $prenom ?>">
				</p>
				<p>
					<label for="email">E-mail</label><br>
					<input class="form-control" type="email" name="email" value="<?php echo $email ?>">
				</p>
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-5">
				<p>
					<?php if($civilite == 'm'){
						echo '<label for="civilite">Civilité : </label><br>
					<select class="form-control" name="civilite">
						<option value="m">Homme</option>
						<option value="f">Femme</option>
					</select>';
					}else{
						echo '<label for="civilite">Civilité : </label><br>
						<select class="form-control" name="civilite">
							<option value="f">Femme</option>
							<option value="m">Homme</option>
						</select>';
					}
					?>
				</p>
				<p>
					<?php if($statut == 'Membre'){
						echo '<label for="statut">Statut : </label>
					<select class="form-control" name="statut" >
						<option value="Membre">Membre</option>
						<option value="Admin">Admin</option>
					</select>';
					}else{
						echo '<label for="statut">Statut : </label>
					<select class="form-control" name="statut" >
						<option value="Admin">Admin</option>
						<option value="Membre">Membre</option>
					</select>';
					}
					?>
				</p><br>
				<div class="d-flex justify-content-center">
					<input class="btn btn-outline-primary" type="submit" name="envoyer" value="Modifier" >
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