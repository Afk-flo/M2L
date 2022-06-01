<!-- une seule vue pour les intervenants avec toutes les info perso
par contre le menu va changer entre les deux
-->
<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>

        <h1>Bonjour !</h1>
        <h3>Voici vos informations personnelles</h3>
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