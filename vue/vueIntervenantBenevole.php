<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
			Bienvenue à vous bénévole !
		</div>
        <h2>Mes informations</h2>
        <br>
        <p>Nom : <?php echo $utilisateur->getNom();?> </p>
        <p>Prenom : <?php echo $utilisateur->getPrenom();?> </p>
        <p>Login : <?php echo $utilisateur->getLogin();?> </p>
        <p>Fonction :<?php echo $utilisateur->getFonction();?> </p>
        <p>Club : <?php echo $utilisateur->getClub();?> </p>
        <p>Ligue : <?php echo $utilisateur->getLigue();?> </p>


    </main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>