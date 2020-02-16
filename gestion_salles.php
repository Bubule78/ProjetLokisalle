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

			$sql = "INSERT INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES (NULL, '$titre', '$description', '$photo', '$pays', '$ville', '$adresse', '$cp', '$capacite', '$categorie')";
			$requete = $connexion->exec($sql);


		
		echo "<h2 style='color:green'>La salle ayant pour <strong>titre</strong> : " . $_POST['titre'] . " à bien été ajouté </h2><br>";
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
	
	?>
	</table>
	<h1 class="my-4 h3">Ajouter une <strong>salle</strong> à la liste ci-dessus : </h1>
	<form action="#" method="POST">
		<div class="form-row">
			<div class="form-group col-md-5">	
				<p>
					<label for="titre">Titre</label><br>
					<input class="form-control" type="text" name="titre" placeholder="Titre de la salle" required>
				</p>
				<p>
					<label for="description">Description</label><br>
					<textarea class="form-control" type="text" name="description" placeholder="Description de la salle" style="max-height: 250px;" maxlength="300" required></textarea>
				</p>
				<p>
					<label for="photo">Photo de la salle</label><br>
					<input class="form-control" type="file" name="photo" accept=".img,.png,.jpg,.jpeg,.gif" required>
				</p><br>
				<label for='capacite'>Capacité <br><span class="small"> Supérieur ou égale à :</span></label>
		        <select class="form-control" name="capacite">
		          	<?php 
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
						<option value="marseile">Marseille</option>
						<option value="lyon">Lyon</option>
					</select>
				</p><br>
				<p>
					<label for="adresse">Adresse</label><br>
					<textarea class="form-control" type="text" name="adresse" placeholder="Adresse de la salle" style="max-height: 250px;" maxlength="100" required></textarea>
				</p>
				<p>
					<label for="cp">Code Postal</label><br>
					<input class="form-control" type="number" name="cp" placeholder="ex : 75000" required>
				</p>
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