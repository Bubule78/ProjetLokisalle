<?php  
	try {
		$connexion = new PDO('mysql:host=localhost;dbname=Carnet_adresses;charset=utf8','root','');
	} catch (Exception $e) {
		die("Erreur : " . $e->getMessage());	
	}

			require "lib/function.php";


// 		$connexion = new PDO('mysql:host=sql25;dbname=vvq74721;charset=utf8','vvq74721','sqZ5t2hSueDM');
//		$connexion = new PDO('mysql:host=localhost:100;dbname=carnet_adresses;charset=utf8','root','');
		?>
