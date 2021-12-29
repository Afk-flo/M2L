	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>			
				<?php 
			// Mise en place des messages flashs si besoin
			if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {
				?>
				<div class="<?php echo $_SESSION['message']['type']; ?>">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					<strong>FLASH :</strong> <?php echo $_SESSION['message']['message']; ?>
				</div>
				<?php
				$_SESSION['message'] = [];
			}
			?>
				<?php	
					$formulaireConnexion->afficherFormulaire();
				?>

	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
