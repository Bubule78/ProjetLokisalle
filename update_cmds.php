<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Mise à jour d'une commandes</title>
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
		if (isset($_GET['id_cmds'])){
			$id_cmds = $_GET['id_cmds'];
			
			global $connexion;

			$sql = "
			SELECT produit.prix, produit.id_produit, commande.id_commande
			FROM produit 
			JOIN commande ON commande.id_produit = produit.id_produit
			WHERE commande.id_commande = '$id_cmds'
			";

			$requete = $connexion->query($sql);
			$result = $requete->fetch(PDO::FETCH_ASSOC);

			$prix = $result["prix"];
			$idCmds = $result["id_commande"];
			$idProduit = $result["id_produit"];

			if($_POST){
				global $connexion;

				$prix = $_POST["prix"];

				$sql = "
				UPDATE produit 
				SET prix = '$prix'
				WHERE produit.id_produit = '$idProduit'";
				$requete = $connexion->exec($sql);


				echo "<h1 style='color:green'>Le prix de la commande N° $idCmds , à bien été modifié ! </h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";
				header("refresh:6;URL=gestion_cmds.php");
			}
		}
	?>

	<table class="table table-striped table-hover table-dark">	
		<tr class='text-center'>
			<th>ID Commande</th>
			<th>ID Membre</th>
			<th>ID Produit</th>
			<th>Prix</th>
			<th>Date D'enregistrement</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
		<?php 
			$listeCmds = readCmdsAll();
			foreach ($listeCmds as $show) {
				if ($show['id_commande'] == $_GET['id_cmds']) {
					
				echo "<tr class='text-center'>";
				echo "<td>" . $show["id_commande"] . "</td>";
				echo "<td>" . $show["id_membre"] . " - " . $show["email"] . "</td>";
				echo "<td><div>" . $show["id_salle"] . " - " . $show["titre"] . "</div><div>" . $show["date_arrivee"] . " au " . $show["date_depart"] . "</div></td>";
				echo "<td>" . $show["prix"] . " €</td>";
				echo "<td>" . $show["date_enregistrement"] . "</td>";
				echo "<td><a href='update_cmds.php?id_cmds=" . $show['id_commande'] . "'>Modifier</a></td>";
				echo "<td><a href='dell_cmds.php?id_cmds=" . $show['id_commande'] . "'>Supprimer</a></td>";
				echo "</tr>";
				}
			}
		?>
	</table>

	<h1 class="my-4 h3">Modifier le <strong>prix</strong> de la commande ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="prix">Prix :</label><br>
					<input class="form-control" type="text" name="prix" value="<?php echo $prix ?>" required>
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