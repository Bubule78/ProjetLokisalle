<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Admin Statistique</title>
		<meta charset="UTF-8">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<!-- Bootstrap core CSS -->
  		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  		<!-- Custom styles for this template -->
  		<link href="css/shop-homepage.css" rel="stylesheet">
		<link rel="icon" href="lib/img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<?php require "template/header.php" ?>
	<ul>
		<li><a href="stats.php?top_salle_note=">=> Top 5 des salles les mieux notées</a></li>
		<li><a href="stats.php?top_salle_cmd=">=> Top 5 des salles les plus commandées</a></li>
		<li><a href="stats.php?top_membre_achat=">=> Top 5 des membres qui achetes le plus </a></li>
		<li><a href="stats.php?top_membre_achat_pimp=">=> Top 5 des membres qui achètes le plus cher</a></li>
	</ul>

 

 

 

 



	<?php require "template/footer.php" ?>