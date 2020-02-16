<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin gestion des produits</title>
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
	<?php require "template/header.php" ;?>
<?php 

	if(isset($_GET['id_produit'])){
		$id_produit = $_GET['id_produit'];
		global $connexion;

		$sql = "SELECT * FROM produit WHERE produit.id_produit = $id_produit";
		$requete = $connexion->query($sql);
		$result = $requete->fetch(PDO::FETCH_ASSOC);

		$id_salle = $result["id_salle"];
		$date_arrivee = $result["date_arrivee"];
		$date_depart = $result['date_depart'];
		$prix = $result['prix'];
		$etat = $result['etat'];
	}

	if($_POST){
		global $connexion;
		$id_produit = $_GET['id_produit'];
		$date_arrivee = $_POST["date_arrivee"];
		$date_depart = $_POST["date_depart"];
		$id_salle = $_POST['id_salle'];
		$tarif = $_POST['prix'];
		$etat = $_POST['etat'];


		$sql = "
		UPDATE `produit` 
		SET `id_salle` = '$id_salle', `date_arrivee` = '$date_arrivee', `date_depart` = '$date_depart', `prix` = '$tarif', `etat` = '$etat'
		WHERE produit.id_produit = $id_produit
		";
		$requete = $connexion->exec($sql);


		echo "<h1 style='color:green'>Le produit ayant pour nouvel <strong>ID</strong> : $id_produit à bien été <u>modifié</u> </h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";
		header("refresh:5;URL=gestion_produits.php");
	}

	?>
	<table class="table table-dark">	
		<tr>
			<th>ID produit</th>
			<th>Date d'arrivée</th>
			<th>Date de départ</th>
			<th>ID de la Salle</th>
			<th>Prix</th>
			<th>Etat</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	<?php 
		$listeSallesEtProduit = readSalleEtProduitAll();
		foreach ($listeSallesEtProduit as $show) {
			if ($show["id_produit"] == $_GET["id_produit"]){
				echo "<tr>";
				echo "<td>" . $show["id_produit"] . "</td>";
				echo "<td>" . $show["date_arrivee"] . "</td>";
				echo "<td>" . $show["date_depart"] . "</td>";
				echo "<td class='d-flex justify-content-center flex-column'><div>" . $show["id_salle"] . " - " . $show['titre'] . "</div><br><div><img src='lib/img/" . $show['photo'] . "' alt='' width='120px' height='100px'></div></td>";
				echo "<td>" . $show["prix"] . " €</td>";
				echo "<td>" . $show["etat"] . "</td>";
				echo "<td>" . "<a href='update_produit.php?id_produit=" . $show['id_produit'] . "'>Modifier</a></td>";
				echo "<td>" . "<a href='dell_produit.php?id_produit=" . $show['id_produit'] . "'>Supprimer</a></td>";
				echo "</tr>";
			}
		}
	
	?>
	</table>
	<h1 class="my-4 h3">Modifier le produit ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="date_arrivee"><strong>Date d'arrivée</strong></label><br>
					<input class="form-control" type="datetime-local" name="date_arrivee" placeholder="00/00/0000 00:00" value="<?php echo $date_arrivee ?>" required>
				</p>
				<p>
					<label for="date_depart"><strong>Date de départ</strong></label><br>
					<input class="form-control" type="datetime-local" name="date_depart" placeholder="00/00/0000 00:00" value="<?php echo $date_depart ?>" required>
				</p>
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-5">
				<p>
					<label for="salle"><strong>salle</strong><br>
					<span class="small">Attention à bien vérifier la salle avant de valider la modification !!*</span></label><br>
					<select class="form-control" type="text" name="id_salle" required>
						<?php 
							$listeSalles = readSalleAll();
							foreach ($listeSalles as $show) {
								echo "<option value='" . $show['id'] . "'>" . $show['id'] . " - " . $show['titre'] . " - " . $show['adresse'] . ", " . $show['cp'] . ", " . $show['ville'] . " - " . $show['capacite'] . " - " . $show['categorie'] . "</option>";
							}
						?>
					</select>
				</p>
				<label for="prix"><strong>Tarif</strong></label><br>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">€</span>
					</div>
					<input type="number" class="form-control" name="prix" min="0" placeholder="Prix en euros" value="<?php echo $prix ?>" required>	
				</div><br>
				<div>
					<label for='etat'>Catégorie <br><span class="small">(Libre/Réservé)</span></label>
			  		<select class="form-control" name="etat">	
			       		<option value="libre">Libre</a>
			        	<option value="reservation">Reservé</a>
					</select><br>
				</div>
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


