<?php	
	function readMembreAll(){
	//connexion
		global $connexion;

		// faire une requête
		$sql = "SELECT * FROM membre";
		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
		
		// execute la requette
		$requete->execute();

		// renvoyé les résultats dans la variable $resultat
		$resultat = $requete->fetchAll();
		
		$r = []; // tableau vide
		foreach ($resultat as $row) {
			// Le tableau qui va être ajouté au tableau $r =>
			$membre["id"] = $row["id_membre"] ;
			$membre["pseudo"] = $row["pseudo"] ;
			$membre["mdp"] = $row["mdp"] ;
			$membre["nom"] = $row["nom"] ;
			$membre["prenom"] = $row["prenom"] ;
			$membre["email"] = $row["email"] ;
			$membre["civilite"] = $row["civilite"] ;
			$membre["statut"] = $row["statut"] ;
			$membre["date_enregistrement"] = $row["date_enregistrement"] ;
			// équivalent du push()
			$r[] = $membre ; 
		}
		return $r;
	}
?>
<?php	
	function readSalleAll(){
	//connexion
		global $connexion;
		// faire une requête
		$sql = "SELECT * FROM salle";
		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);

		// execute la requette
		$requete->execute();

		// renvoyé les résultats dans la variable $resultat
		$resultat = $requete->fetchAll();
		$r = []; // tableau vide

		foreach ($resultat as $row) {
			// Le tableau qui va être ajouté au tableau $r =>
			$salle["id"] = $row["id_salle"] ;
			$salle["titre"] = $row["titre"] ;
			$salle["description"] = $row["description"] ;
			$salle["photo"] = $row["photo"] ;
			$salle["pays"] = $row["pays"] ;
			$salle["ville"] = $row["ville"] ;
			$salle["adresse"] = $row["adresse"] ;
			$salle["cp"] = $row["cp"] ;
			$salle["capacite"] = $row["capacite"] ;
			$salle["categorie"] = $row["categorie"] ;
			// équivalent du push()
			$r[] = $salle ; 
		}
		return $r;
	}
?>
<?php	
	function readProduitAll(){
	//connexion
		global $connexion;

		// faire une requête
		$sql = "SELECT * FROM produit";
		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
		
		// execute la requette
		$requete->execute();

		// renvoyé les résultats dans la variable $resultat
		$resultat = $requete->fetchAll();
		
		$r = []; // tableau vide
		foreach ($resultat as $row) {
			// Le tableau qui va être ajouté au tableau $r =>
			$produit["id"] = $row["id_produit"] ;
			$produit["date_arrivee"] = $row["date_arrivee"] ;
			$produit["date_depart"] = $row["date_depart"] ;
			$produit["id_salle"] = $row["id_salle"] ;
			$produit["prix"] = $row["prix"] ;
			$produit["etat"] = $row["etat"] ;
			
			$r[] = $produit ; 
		}
		return $r;
	}
?>
<?php	
	function readSalleEtProduitAll(){
	//connexion
		global $connexion;

		// faire une requête
		$sql = "
			SELECT *
			FROM produit AS p
			JOIN salle AS s
			ON p.id_salle = s.id_salle";
		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
		
		// execute la requette
		$requete->execute();

		// renvoyé les résultats dans la variable $resultat
		$resultat = $requete->fetchAll();
		
		$r = []; // tableau vide
		foreach ($resultat as $row) {
			// Le tableau qui va être ajouté au tableau $r =>
			$result["id_produit"] = $row["id_produit"] ;
			$result["date_arrivee"] = $row["date_arrivee"] ;
			$result["date_depart"] = $row["date_depart"] ;
			$result["id_salle"] = $row["id_salle"] ;
			$result["prix"] = $row["prix"] ;
			$result["etat"] = $row["etat"] ;
			$result["titre"] = $row["titre"] ;
			$result["photo"] = $row["photo"] ;
			
			$r[] = $result ; 
		}
		return $r;
	}
?>
<?php 

	function readAvisJoinedAll(){

		global $connexion;

		$sql = "SELECT a.id_avis, a.id_membre, m.email, a.id_salle, s.titre, a.commentaire, a.note, a.date_enregistrement
		FROM avis AS a
		JOIN membre AS m
		ON a.id_membre = m.id_membre
		JOIN salle AS s
		ON a.id_salle = s.id_salle
		";

		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
		$requete->execute();

		$resultat = $requete->fetchAll();

		$r = [];
		foreach ($resultat as $row) {
			$avis["id_avis"] = $row["id_avis"] ;
			$avis["id_membre"] = $row["id_membre"] ;
			$avis["id_salle"] = $row["id_salle"] ;
			$avis["commentaire"] = $row["commentaire"] ;
			$avis["note"] = $row["note"] ;
			$avis["date_enregistrement"] = $row["date_enregistrement"] ;
			$avis["email"] = $row["email"];
			$avis["titre"] = $row["titre"];

			$r[] = $avis ;
		}
		return $r;
	}
?>

<?php 

	function readCmdsAll(){

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
		";

		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
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
?>
<?php
	function showFicheProduitIndex(){
		global $connexion;

		$sql = "
		SELECT p.id_produit, s.titre, s.photo, s.description, p.date_arrivee, p.date_depart, p.prix, s.id_salle, p.etat
		FROM produit AS p
		JOIN salle AS s 
		ON p.id_salle = s.id_salle
		WHERE p.etat = 'libre'
		";

		$requete = $connexion->query($sql, PDO::FETCH_ASSOC);
  		// $requete->execute();
   		// $result = $requete->fetchAll();
        
        $r = []; 

		foreach ($requete as $row) {
			$produit["id_produit"] = $row["id_produit"] ;
			$produit["titre"] = $row["titre"] ;
			$produit["photo"] = $row["photo"] ;
			$produit["description"] = $row["description"] ;
			$produit["date_arrivee"] = $row["date_arrivee"] ;
			$produit["date_depart"] = $row["date_depart"] ;
			$produit["prix"] = $row["prix"] ;
			$produit["id_salle"] = $row["id_salle"] ;
			
			$r[] = $produit ; 
		}
        return $r;
	}
?>
<?php 
	function internauteEstConnecte()
	{
		if(!isset($_SESSION['membre'])) return false;
		else return true;
	}

	function internauteEstConnecteEtEstAdmin()
	{
		if(internauteEstConnecte() && $_SESSION['membre']['statut'] == "Admin"){
			return true;
		}else{
		return false;
		}
	}
?>
