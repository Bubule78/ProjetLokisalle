<?php require "lib/loader.php" ; ?>
<?php if(internauteEstConnecteEtEstAdmin()){ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin suppression des Commandes</title>
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
	<?php  require "template/header.php"; ?>
		<?php 

			$idCmds = $_GET['id_cmds'];

			$sql = "DELETE FROM commande WHERE id_commande = '$idCmds'";
			$requete = $connexion->exec($sql);

			echo " <h1 style='color:green'>La commande ayant pour ID : " . $idCmds . " à bien été supprimé </h1><br><p class='my-4 h3' style='color:red'> Vous allez être redirigé dans 5 secondes</p>";

	// A placer dans la page DELL_MEMBRE pour rendre le bouton Suppr opé
			header("refresh:6;URL=gestion_cmds.php");
	?>
	<?php require "template/footer.php"; ?>
	<?php }else{
		echo "<h1 style='color:red'>Vous n'êtes pas Admin ou vous avez oublier de vous connecter<br> Connectez-vous !</h1>";
		echo "<p>Redirection...</p>";
		header("refresh:2;URL=connexion.php");
	} ?>
