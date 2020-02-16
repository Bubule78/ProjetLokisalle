<?php require "lib/loader.php" ; ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Votre Panier</title>
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

		<div class="row">

		    <div class="col-lg-9">
				<?php 
					$idMembre = $_SESSION['membre']['id_membre'];
					function readCmdsPanier(){
						$idMembre = $_SESSION['membre']['id_membre'];
						global $connexion;

						$sql = "
						SELECT c.id_commande, c.id_membre, m.email, c.id_produit, s.id_salle, s.titre, p.date_arrivee, p.date_depart, p.prix, c.date_enregistrement
						FROM commande AS c
						JOIN membre AS m
						ON c.id_membre = m.id_membre
						JOIN produit AS p
						ON c.id_produit = p.id_produit
						JOIN salle AS s
						ON p.id_salle = s.id_salle
						WHERE m.id_membre = '$idMembre'
						";

						$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
						if($requete == false){

						}else{
							$requete->execute();

							$resultat = $requete->fetchAll();

							$r = [];
							foreach ($resultat as $row) {
								$cmds["id_commande"] = $row["id_commande"] ;
								$cmds["id_membre"] = $row["id_membre"] ;
								$cmds["email"] = $row["email"] ;
								$cmds["id_produit"] = $row["id_produit"] ;
								$cmds["id_salle"] = $row["id_salle"] ;
								$cmds["titre"] = $row["titre"] ;
								$cmds["date_arrivee"] = $row["date_arrivee"] ;
								$cmds["date_depart"] = $row["date_depart"] ;
								$cmds["prix"] = $row["prix"] ;
								$cmds["date_enregistrement"] = $row["date_enregistrement"] ;
								
								$r[] = $cmds ;
							}
							return $r;
						}
					}
				?>
				<?php
					if(isset($_GET['id_produit']) && internauteEstConnecte()){
						$idProduit = $_GET['id_produit'];
						global $connexion;
						$sql= "
						UPDATE produit
						SET etat = 'reservation'
						WHERE produit.id_produit = '$idProduit'
						";
						$requete = $connexion->exec($sql);
					
						$sql="
						INSERT INTO commande (id_commande, id_membre, id_produit, date_enregistrement)
						VALUES (NULL, '$idMembre', '$idProduit', current_timestamp())
						";
						$requete = $connexion->exec($sql);	
					}
					if(internauteEstConnecte() || isset($_GET['id_produit'])){
						echo "<h1> Panier : </h1>";
						echo "<p> La liste des produits que vous avez commandés :</p>";
						
				?>
					<table class="table table-striped table-hover table-dark">	
						<tr>
							<th>ID Commande</th>
							<th>ID Membre</th>
							<th>ID Produit</th>
							<th>Prix</th>
							<th>Date D'enregistrement</th>
						</tr>
				<?php
							$listeCmds = readCmdsPanier();
							foreach ($listeCmds as $show) {
										
								echo "<tr>";
								echo "<td class='text-center'>" . $show["id_commande"] . "</td>";
								echo "<td class='text-center'>" . $show["id_membre"] . " - " . $show["email"] . "</td>";
								echo "<td><div class='text-center'>" . $show["id_salle"] . " - " . $show["titre"] . "</div><div>" . $show["date_arrivee"] . " au " . $show["date_depart"] . "</div></td>";
								echo "<td class='text-center'>" . $show["prix"] . "</td>";
								echo "<td class='text-center'>" . $show["date_enregistrement"] . "</td>";
								echo "</tr>";
							}

						}else{
							echo "<h1> Veuillez vous connecter pour pouvoir afficher la liste</h1>";
						}

				?>
					</table>
			</div>
		</div>
	<?php require_once "template/footer.php" ?>