	<body>
		<div class="container">
			<header>
				<nav class="navbar navbar-nav navbar-expand-lg navbar-dark bg-dark fixed-top">
			    <div class="container">
			      <a class="navbar-brand" href="index.php">Lokisalle</a>
			      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			      </button>
			      <div class="collapse navbar-collapse" id="navbarResponsive">
			        <ul class="navbar-nav ml-auto">
			          <li class="nav-item active">
			            <a class="nav-link" href="index.php">Accueil
			              <span class="sr-only">(current)</span>
			            </a>
			          </li>
                <?php if(internauteEstConnecteEtEstAdmin()){ ?>
                <li class="nav-item">
        				  <a class="nav-link" href="gestion_membres.php">Gestion Membre</a>
      				  </li>
         				<li class="nav-item">
          				<a class="nav-link" href="gestion_produits.php">Gestion Produit</a>
        				</li>
         				<li class="nav-item">
          				<a class="nav-link" href="gestion_cmds.php">Gestion Commandes</a>
        				</li>
         				<li class="nav-item">
          				<a class="nav-link" href="gestion_avis.php">Gestion Avis</a>
        				</li>
         				<li class="nav-item">
          				<a class="nav-link" href="gestion_salles.php">Gestion Salles</a>
        				</li>
        				<li class="nav-item">
          				<a class="nav-link" href="stats.php">Statistique</a>
        				</li>
                <?php } ?>
                <?php if(internauteEstConnecte()){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="connexion.php?action=deconnexion">Deconnexion</a>
                </li>
                <?php }else{ ?>
         				<li class="nav-item">
          				<a class="nav-link" href="connexion.php">Connexion</a>
        				</li>			          
         				<li class="nav-item">
          				<a class="nav-link" href="inscription.php">inscription</a>
        				</li>
                <?php } ?>
			        </ul>
			      </div>
			    </div>
			  </nav>
			</header>
			<main>
