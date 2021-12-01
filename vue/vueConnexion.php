<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class="contentConnexion">
			<div class='connexion'>
				<div class='titre'>Veuillez vous identifier</div>
				<?php	
					if(isset($_SESSION['user'])) {
						var_dump($_SESSION['user']);
					} else {
						echo "pas de post";
					}
					$formulaireConnexion->afficherFormulaire();
				?>
			</div>
		</div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
