<?php  
	session_start();
	try {
		$connexion = new PDO('mysql:host=sql25;dbname=vvq74721;charset=utf8','vvq74721','sqZ5t2hSueDM');
	} catch (Exception $e) {
		die("Erreur : " . $e->getMessage());	
	}

			require "lib/function.php";


// 		$connexion = new PDO('mysql:host=sql25;dbname=vvq74721;charset=utf8','vvq74721','sqZ5t2hSueDM');
//		$connexion = new PDO('mysql:host=localhost:100;dbname=carnet_adresses;charset=utf8','root','');
//		$connexion = new PDO('mysql:host=localhost;dbname=lokisalle;charset=utf8','root','');
		?>
