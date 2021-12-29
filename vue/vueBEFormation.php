<div class="container">

	<header>
		
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
        <?php 

        echo "<h1 class='title1'> Bienvenu dans l'espace d'inscription et gestion des formations " . $_SESSION['user']['nom'] . "</h1><br/>";
        echo "<br/>";
        echo "<h3 class='title3'> Découvrez les formations </h3><br/>";


        // Affichage des participants de manière sympa
        	
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
		<br/>

        <!-- Affichage des formations (Couleur) ==> Selon statut différentes choses -->
		<div class="truc">

        <?php 
        foreach($formations as $formations) {
            // <?php echo $formations->getCouleur(); 
            $particip = new DaoParticipation();
            $particip = $particip->getParticipation($_SESSION['user']['id'], $formations->getIdFormation());

            if(is_bool($particip)) {
                echo "<div id='demandeur'>";
            } elseif ($particip->getEtat() === "ATTENTE"){
                echo "<div class='demandeurWait'>";
            } else {
                echo "<div class='demandeur".$particip->getEtat()."'>";
            } ?>
                <h1> <?php echo $formations->getIntitule(); ?> </h1>
                <h4>Descriptif:  <?php echo $formations->getDescriptif(); ?> </h4>
                <p> Nombre max : <?php echo $formations->getNombreMax(); ?> </p>
                <p> Cloture des inscriptions : <?php echo $formations->getDateFinInscription(); ?> </p>
                <?php 
                    // Si état = before // btn 
                    // Si état = attente on affiche attente 
                    // Sinon -> affichage du resultat 
                   echo '<div class="choix">';
                    if(is_bool($particip)) {
                        echo "<button><a href='index.php?".$_SESSION['user']['fonction']."=formations&id=".$formations->getIdFormation()."'> Je m'inscris ! </a></button>"; 
                    } else if($particip->getEtat() === "ATTENTE") {
                        echo '<div class="choixWAIT">';
                            echo "Votre candidature est en attente";
                        echo "</div>";
                    } else {
                        echo '<div class="choix'.$particip->getEtat().'">';
                            echo "Votre candidature est  : " . $particip->getEtat();
                        echo "</div>";
                    }
                   echo '</div>';
                   echo '<br/>';
                ?>
            </div>

            <?php 
        }
        ?>
        </div>

        </div>
    </main>

    <footer>
    <?php include 'bas.php' ;?>
    </footer>
</body>
</html>
