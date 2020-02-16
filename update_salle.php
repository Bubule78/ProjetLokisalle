<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Gestion des salles</title>
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

		if(isset($_GET['id_salle'])){
			$id_salle = $_GET['id_salle'];
			global $connexion;

			$sql = "SELECT * FROM salle WHERE salle.id_salle = $id_salle";
			$requete = $connexion->query($sql);
			$result = $requete->fetch(PDO::FETCH_ASSOC);

			$titre = $result["titre"];
			$description = $result["description"];
			$photo = $result['photo'];
			$pays = $result['pays'];
			$ville = $result['ville'];
			$adresse = $result['adresse'];
			$cp = $result['cp'];
			$capacite = $result['capacite'];
			$categorie = $result['categorie'];
		}

		if($_POST){
			global $connexion;

			$titre = $_POST["titre"];
			$description = $_POST["description"];
			$photo = $_POST['photo'];
			$pays = $_POST['pays'];
			$ville = $_POST['ville'];
			$adresse = $_POST['adresse'];
			$cp = $_POST['cp'];
			$capacite = $_POST['capacite'];
			$categorie = $_POST['categorie'];

			$sql = "UPDATE `salle` SET `titre` = '$titre', `description` = '$description', `photo` = '$photo', `ville` = '$ville', `adresse` = '$adresse', `cp` = '$cp', `capacite` = '$capacite', `categorie` = '$categorie' WHERE salle.id_salle = $id_salle";
			$requete = $connexion->exec($sql);


		echo "<h1 style='color:green'>La salle ayant pour titre : $titre et pour id : $id_salle , à bien été modifié </h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";
		header("refresh:6;URL=gestion_salles.php");
		}

	?>
	<table class="table table-dark">	
		<tr>
			<th>ID</th>
			<th>titre</th>
			<th>Description</th>
			<th>photo</th>
			<th>pays</th>
			<th>ville</th>
			<th>adresse</th>
			<th>cp</th>
			<th>capacite</th>
			<th>categorie</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	<?php 
		$listeSalles = readSalleAll();
		foreach ($listeSalles as $show){
			if ($show["id"] == $_GET["id_salle"]){
			echo "<tr>";
			echo "<td>" . $show["id"] . "</td>";
			echo "<td>" . $show["titre"] . "</td>";
			echo "<td>" . $show["description"] . "</td>";
			echo "<td class='d-flex justify-content-center flex-column'><img src='lib/img/" . $show['photo'] . "' alt='' width='120px' height='100px'> </td>";
			echo "<td>" . $show["pays"] . "</td>";
			echo "<td>" . $show["ville"] . "</td>";
			echo "<td>" . $show["adresse"] . "</td>";
			echo "<td>" . $show["cp"] . "</td>";
			echo "<td>" . $show["capacite"] . "</td>";
			echo "<td>" . $show["categorie"] . "</td>";
			echo "<td>" . "<a href='update_salle.php?id_salle=" . $show['id'] . "'>Modifier</a></td>";
			echo "<td>" . "<a href='dell_salle.php?id_salle=" . $show['id'] . "'>Supprimer</a></td>";
			echo "</tr>";
			}
		}
	
	?>
	</table>
	<h1 class="my-4 h3">modifier la <strong>salle</strong> ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="titre">Titre</label><br>
					<input class="form-control" type="text" name="titre" placeholder="Titre de la salle" value="<?php echo $titre ?>" required>
				</p>
				<p>
					<label for="description">Description</label><br>
					<textarea class="form-control" type="text" name="description" placeholder="Description de la salle" style="max-height: 250px;" maxlength="300" required><?php echo $description ?></textarea>
				</p>
				<p>
					<label for="photo">Photo de la salle</label><br>
					<input class="form-control" type="file" name="photo" accept=".img,.png,.jpg,.jpeg,.gif">
				</p><br>
				<label for='capacite'>Capacité <br><span class="small"> Supérieur ou égale à :</span></label>
		        	<select class="form-control" name="capacite">
		          		<?php 
		          			echo "<option value='$capacite' selected>$capacite</option>";
		          			for ($i=1; $i <= 100 ; $i++) { 
		          				echo "<option value='$i'>$i</option>";
		          			}
		          		?>
		          </select><br>
		        <label for='capacite'>Catégorie <br><span class="small"> (Réunion/Bureau/Formation)</span></label>
			    <select class="form-control" name="categorie">	
			        <option value="reunion">Réunion</a>
			        <option value="bureau">Bureau</a>
			        <option value="formation">Formation</a>
			    </select>
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-5">
				<p>
					<label for="pays">Pays</label><br>
					<select class="form-control" name="pays">
						<option value="france">France</option>
					</select>
				</p>
				<p>
					<label for="ville">Ville : </label>
					<select class="form-control" name="ville">
						<option value="paris">Paris</option>
						<option value="marseille">Marseille</option>
						<option value="lyon">Lyon</option>
					</select>
				</p><br>
				<p>
					<label for="adresse">Adresse</label><br>
					<textarea class="form-control" type="text" name="adresse" placeholder="Adresse de la salle" style="max-height: 250px;" maxlength="100" required><?php echo $adresse ?></textarea>

				</p>
				<p>
					<label for="cp">Code Postal</label><br>
					<input class="form-control" type="number" name="cp" placeholder="ex : 75000" value="<?php echo $cp ?>" required>
				</p>
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