
<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
			<?php 
			echo "<br/>";
            echo "Bienvenu reponsable de formation " . $_SESSION['user']['nom'];
			echo "Il y a actuellement X formations ouvertes aux inscriptions";
			echo "Il y a actuellement X formations en cours";
			echo "Il y a actuellement X formations terminées";
			echo "<br/>";

			
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
		</div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>