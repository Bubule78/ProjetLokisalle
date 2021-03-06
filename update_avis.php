<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Gestion d'Avis</title>
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
		if (isset($_GET['id_avis'])){
			$id_avis = $_GET['id_avis'];
			
			global $connexion;

			$sql = "SELECT * FROM avis WHERE avis.id_avis = $id_avis";

			$requete = $connexion->query($sql);
			$result = $requete->fetch(PDO::FETCH_ASSOC);

			$commentaire = $result["commentaire"];
			$note = $result["note"];

			if($_POST){
				global $connexion;

				$commentaire = $_POST["commentaire"];
				$note = $_POST["note"];

				$sql = "
				UPDATE avis 
				SET commentaire = '$commentaire', note = '$note' 
				WHERE avis.id_avis = '$id_avis'";
				$requete = $connexion->exec($sql);


			echo "<h1 style='color:green'>L'Avis ayant pour id : $id_avis , à bien été modifié ! <small> C'est pas bien de modifié les avis des gens ... !</small></h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";
			header("refresh:6;URL=gestion_avis.php");
			}
		}
	?>

	<table class="table table-striped table-hover table-dark">	
		<tr>
			<th>ID Avis</th>
			<th>ID Membre</th>
			<th>ID Salle</th>
			<th>Commentaire</th>
			<th>note</th>
			<th>Date D'enregistrement</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
		<?php 
			$listeAvis = readAvisJoinedAll();
			foreach ($listeAvis as $show) {
				if($show["id_avis"] == $_GET['id_avis']){
					echo "<tr>";
					echo "<td>" . $show["id_avis"] . "</td>";
					echo "<td>" . $show["id_membre"] . " - " . $show["email"] . "</td>";
					echo "<td>" . $show["id_salle"] . " - " . $show["titre"] . "</td>";
					echo "<td>" . $show["commentaire"] . "</td>";
					echo "<td>" . $show["note"] . "/10</td>";
					echo "<td>" . $show["date_enregistrement"] . "</td>";
					echo "<td>" . "<a href='update_avis.php?id_avis=" . $show['id_avis'] . "'>Modifier</a></td>";
					echo "<td>" . "<a href='dell_avis.php?id_avis=" . $show['id_avis'] . "'>Supprimer</a></td>";
					echo "</tr>";
				}
			}
		?>
	</table>

	<h1 class="my-4 h3">modifier l'<strong>avis</strong> ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="commentaire">Commentaire :</label><br>
					<input class="form-control" type="text" name="commentaire" value="<?php echo $commentaire ?>" required>
				</p>
				<p>
					<label for="commentaire">Note <small>(0 à 10)</small>:</label><br>
					<input class="form-control" type="number" name="note" min="0" max="10" value="<?php echo $note ?>" required>/10
				</p>
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-5">
				<div class="d-flex justify-content-center">
					<input class="btn btn-outline-primary" type="submit" name="envoyer" value="Modifier" >
				</div>
			</div>
		</div>
	</form>
	<?php require "template/footer.php" ?>
	<?php }else{
		echo "<h1 style='color:red'>Vous n'êtes pas Admin ou vous avez oublier de vous connecter<br> Connectez-vous !</h1>";
		echo "<p>Redirection...</p>";
		header("refresh:2;URL=connexion.php");
	} ?>
