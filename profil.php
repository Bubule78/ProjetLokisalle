<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Votre Profil</title>
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

		<h1>Salut <?php if(isset($_SESSION['membre']['pseudo'])) echo $_SESSION['membre']['pseudo'];?></h1>

	<?php 
		if(internauteEstConnecte())
			{
				echo "<h3>Voici toutes tes informations : </h3>";
			} else {
				echo "Veuillez vous connecter pour acceder à cette page";
			}

			foreach ($_SESSION as $key => $value) {
				foreach ($value as $key2 => $value2) {
					if($key2 == 'id_membre' || $key2 == 'mdp'){

					}else{
					echo "<p>$key2 = $value2</p>";
					}
				}
			}
	?>

	<?php require "template/footer.php" ?>