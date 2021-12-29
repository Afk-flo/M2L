<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<?php 
			require('../modele/dao/dBConnex.php');
			$db = new DBConnex();
			echo "wadaz";
			var_dump($db);
		?>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>