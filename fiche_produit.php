<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Nos Produits </title>
		<meta charset="UTF-8">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Bootstrap core CSS -->
  		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 		 <!-- Custom styles for this template -->
  		<link href="css/shop-item.css" rel="stylesheet">
		<link rel="icon" href="lib/img/favicon.ico">
	</head>
	<?php require "template/header.php" ?>
<?php 
	
	function showFicheProduit(){
		$idProduit = $_GET['id_produit'];
		global $connexion;

		$sql = "
		SELECT p.id_produit, p.date_arrivee, p.date_depart, p.prix, p.etat, s.titre, s.description, s.photo, s.adresse, s.ville, s.cp, s.capacite, s.categorie, a.commentaire, a.date_enregistrement, m.pseudo, SUM(a.note)/COUNT(a.note) AS 'Note', a.note
		FROM produit AS p
		LEFT JOIN salle AS s
		ON p.id_salle = s.id_salle
		LEFT JOIN avis AS a
		ON a.id_salle = s.id_salle
		LEFT JOIN membre AS m
		ON a.id_membre = m.id_membre
		WHERE p.id_produit = '$idProduit'
		";

		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
  		$requete->execute();
   		$result = $requete->fetchAll();
        
        $r = []; 

		foreach ($result as $row) {
			$produit["id_produit"] = $row["id_produit"] ;
			$produit["date_arrivee"] = $row["date_arrivee"] ;
			$produit["date_depart"] = $row["date_depart"] ;
			$produit["prix"] = $row["prix"] ;
			$produit["etat"] = $row["etat"] ;
			$produit["titre"] = $row["titre"] ;
			$produit["description"] = $row["description"] ;
			$produit["photo"] = $row["photo"] ;
			$produit["adresse"] = $row["adresse"] ;
			$produit["ville"] = $row["ville"] ;
			$produit["cp"] = $row["cp"] ;
			$produit["capacite"] = $row["capacite"] ;
			$produit["Note"] = $row["Note"] ;
			$produit["commentaire"] = $row["commentaire"] ;
			$produit["pseudo"] = $row["pseudo"] ;
			$produit["date_enregistrement"] = $row["date_enregistrement"] ;
			$produit["categorie"] = $row["categorie"] ;
			$produit["note"] = $row["note"] ;
			
			$r[] = $produit ; 
		}
        return $r;
	}
?>
		<div class="row">

		    <div class="col-lg-9">
				<?php 
					if(isset($_GET['id_produit'])){
						$idProduit = $_GET['id_produit'];
						global $connexion;

						$fiche_produit = showFicheProduit();

						foreach ($fiche_produit as $show) {
							settype($show['Note'], "integer");
							echo "
								<div class='card mt-4'>
									<img class='card-img-top img-fluid' src='lib/img/" . $show['photo'] . "' alt='photo de la salle'>
									<div class='card-body'>
				            			<h3 class='card-title'>" . $show['titre'] . "</h3>
				            			<h4 class='h6'>Information complémentaires</h4>
				            			<p class='card-text'> Arrivée : " . $show['date_arrivee'] . " &nbsp;&nbsp;&nbsp;&nbsp; Capacité : " . $show['capacite'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Adresse : " . $show['adresse'] . ", " . $show['cp'] . ", " . $show['ville'] .
				            			"</p>
				            			<p class='card-text'> Départ : " . $show['date_depart'] . " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Catégorie : " . $show['categorie'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tarif : " . $show['prix'] .
				            			"</p>";
				           				if(isset($show['note'])){
				           					echo "<span class='text-warning'>" . $show['Note'] . "/10</span>";
				           				}
				          		echo "</div><!-- /.card-body-->
			        			</div><!-- /.card -->
			        			<div class='card card-outline-secondary my-4'>
									<div class='card-header'>
		            					Commentaires
		          					</div>
									<div class='card-body'>
		            				<p>" .
		            					$show['commentaire']
		            				. "</p>";
		            			if(isset($show['date_enregistrement'])){
		            				echo "<small class='text-muted'>Posté par " . $show['pseudo'] . " le " . $show['date_enregistrement'] . "</small>";
		            			};
		            			echo "<hr>
		            				</div>
		           				</div>";	
						}
					}
				?>

			</div>
		      <!-- /.col-lg-9 -->
			<div class="col-lg-3">
				<form action="panier.php?id_produit=<?php echo $idProduit ?>" method="POST">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="d-flex flex-column">
								<?php 
									foreach ($fiche_produit as $show) {
										echo "<h4 class='h6'>Description</h4><br><p class='card-text' style='width:100%;'>" . $show['description'] . "</p>";
									}
								?>
									<h4 class='h6'>Localisation</h4>
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20985.497752307056!2d2.1137268601752757!3d48.89276907459848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e662f1ab7b0bb5%3A0x40b82c3688c35f0!2s78110%20Le%20V%C3%A9sinet!5e0!3m2!1sfr!2sfr!4v1574776407238!5m2!1sfr!2sfr" width="350" height="270" frameborder="0" id="Frame" allowfullscreen=""></iframe>
								<input class="btn btn-outline-primary col-md-7 my-4" type="submit" name="reserver" value="Reserver" >
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.row -->

	<?php require "template/footer.php" ?>