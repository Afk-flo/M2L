<!-- une seule vue pour les intervenants avec toutes les info perso
par contre le menu va changer entre les deux
-->
<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
        <div class='gauche'>
            <p>Bienvenue !</p>
        </div>
        <div class='droite'>
            <p>Bonjour !</p><br>
            <h3>Voici vos informations personnelles</h3>
            <br><br>
            <p>Nom : <?php $user.getNom() ?></p>
            <p>Prénom</p>
            <p>Ligue</p>
            <p>Club</p>

        </div>

	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>