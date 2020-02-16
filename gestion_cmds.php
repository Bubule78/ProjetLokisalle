<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Gestion des commandes</title>
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

	<table class="table table-striped table-hover table-dark">	
		<tr>
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
					
				echo "<tr>";
				echo "<td class='text-center'>" . $show["id_commande"] . "</td>";
				echo "<td class='text-center'>" . $show["id_membre"] . " - " . $show["email"] . "</td>";
				echo "<td><div class='text-center'>" . $show["id_salle"] . " - " . $show["titre"] . "</div><div>" . $show["date_arrivee"] . " au " . $show["date_depart"] . "</div></td>";
				echo "<td class='text-center'>" . $show["prix"] . "</td>";
				echo "<td class='text-center'>" . $show["date_enregistrement"] . "</td>";
				echo "<td class='text-center'><a href='update_cmds.php?id_cmds=" . $show['id_commande'] . "'>Modifier</a></td>";
				echo "<td class='text-center'><a href='dell_cmds.php?id_cmds=" . $show['id_commande'] . "'>Supprimer</a></td>";
				echo "</tr>";
			}
		?>
	</table>

	<?php require "template/footer.php" ?>
	<?php }else{
		echo "<h1 style='color:red'>Vous n'êtes pas Admin ou vous avez oublier de vous connecter<br> Connectez-vous !</h1>";
		echo "<p>Redirection...</p>";
		header("refresh:2;URL=connexion.php");
	} ?>