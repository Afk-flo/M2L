
<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
			<?php
            echo "<br/>";
            echo "Bienvenue reponsable de formation " . $_SESSION['user']['nom'];
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