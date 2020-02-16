<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Lokisalle Accueil</title>
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

		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<h2 class="my-4 h6">Catégorie</h2>
		        	<div class="list-group">
						<a href="#" class="list-group-item">Réunion</a>
						<a href="#" class="list-group-item">Bureau</a>
						<a href="#" class="list-group-item">Formation</a>
					</div>

					<h2 class="my-4 h6">Ville</h2>
					<div class="list-group">
						<a href="#" class="list-group-item">Paris</a>
						<a href="#" class="list-group-item">Lyon</a>
						<a href="#" class="list-group-item">Marseille</a>
		        	</div>

		      		<h2 class="my-4 h6">Capacité</h2>
					<div class="list-group">
						<select name="capacite">
							<?php 
								for ($i=1; $i <= 100 ; $i++) { 
		          					echo "<option value='$i'>$i</option>";
		          				} 
							?>
						</select>
					</div>
					
					<div class="list-group">
						<h2 class="my-4 h6">Prix</h2>
						<form name="prix">
              				<input type="range" name="amountRange" min="100" max="6000" value="3000" oninput="this.form.amountInput.value=this.value"></input><br>
                			<output type="number" name="amountInput" min="100" max="6000" value="3000" oninput="this.form.amountRange.value=this.value."></output> &nbsp; €
                		</form>
						<code>Maximum 6000€</code>
					</div>

					<div class="list-group">
						<h2 class="my-4 h6">Période</h2>
						<label for="dateArriver">Date d'arrivée</label>
						<input type="date" name="dateArriver" min="2018-01-01" max="2050-12-31">
					</div>

					<div class="list-group">
						<h2 class="my-4 h6">Période</h2>
						<label for="dateDepart">Date de départ</label>
						<input type="date" name="dateDepart" min="2018-01-01" max="2050-12-31">
					</div>

				</div>
				<!-- /.col-lg-3 -->

				<div class="col-lg-9">

        			<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          				<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
			            	<div class="carousel-item active">
								<img class="d-block img-fluid" src="lib/img/Office-interior-design-reunion.jpg" alt="First slide" style="max-height: 450px;">
			            	</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="lib/img/lokisalle-modern-office-interior-design-loft-concept-3d-rendering.jpg" alt="Second slide" style="max-height: 450px;">
							</div>
							<div class="carousel-item">
								<img class="d-block img-fluid" src="lib/img/lokisalle-bureau-gratte-ciel-1024x1024.jpg" alt="Third slide" style="max-height: 450px;">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			            	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			            	<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			            	<span class="carousel-control-next-icon" aria-hidden="true"></span>
			            	<span class="sr-only">Next</span>
						</a>
					</div>
					<div class="row">
						<?php 
							$vignetteProduitIndex = showFicheProduitIndex();
            				foreach ($vignetteProduitIndex as $show) {
            					settype($show['Note'], "integer");
            					$idSalle = $show['id_salle'];
            					echo "<div class='col-lg-4 col-md-6 mb-4'>
									<div class='card h-100'>
										<a href='fiche_produit.php?id_produit=" . $show['id_produit'] . "'>
											<img class='card-img-top' src='lib/img/" . $show['photo'] . "' alt='Photo de la salle'>
										</a>
										<div class='card-body'>
											<h4 class='card-title'>
											<a href='fiche_produit.php?id_produit=" . $show['id_produit'] . "'>" . $show['titre'] . "</a>
											</h4>
											<h5>" . $show['prix'] . " €</h5>
											<p class='card-text'>
												" . $show['description'] . "
											</p>
											<p class='card-text'>
												Du " . $show['date_arrivee'] . " au " .  $show['date_depart'] . "
											</p>
										</div>
										<div class='card-footer'>";
										
										global $connexion;
										$sql="SELECT avis.note, SUM(avis.note)/COUNT(avis.note) AS NOTE FROM avis WHERE avis.id_salle = '$idSalle'";
										$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
										foreach ($requete as $show) {
											settype($show['NOTE'], "integer");
											if(isset($show['note'])){
												echo "<small class='text-muted'>" . $show['NOTE'] . "/10</small>";
											}
										}	
										echo "
										</div>
									</div>
								</div>";
							}

// &#9733; &#9733; &#9733; &#9733; &#9734; Petit étoiles.


						?>
						
					</div>
        			<!-- /.row -->
				</div>
				<!-- /.col-lg-9 -->
		    </div>
		    <!-- /.row -->
		    
		</div>
  		<!-- /.container -->

	<?php require "template/footer.php" ?>