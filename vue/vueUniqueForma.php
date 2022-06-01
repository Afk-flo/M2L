<div class="container">

	<header>
		
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
        <?php 

        echo "<h1 class='title1'> Bienvenu dans l'espace de gestion des formations " . $_SESSION['user']['nom'] . "</h1><br/>";
        echo "<br/>";
        echo "<h3 class='title3'> Liste des employés participant à la formation '". $contrat->getIntitule() ."'</h3><br/>";


        // Affichage des participants de manière sympa
        ?>
        <?php 
		if(!empty($full)) {
			?>		
		<br/>

		<table id="tableResp" >

		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Fonction</th>
			<th>Club</th>
			
		</tr>

		<?php 
		foreach($full as $user) {
			echo '<tr>';
			echo '<td>' . $user->getNom() . '</td>';
			echo '<td>' . $user->getPrenom() . '</td>';
			echo '<td>' . $user->getFonction() . '</td>';
			echo '<td>' . $user->getClub() . '</td>';
			echo '</tr>';
		}
		?>

		</table>
		<?php 
		} else {
			echo "Aucune formation pour le moment ..";
		}
		?>


        </div>
    </main>

    <footer>
    <?php include 'bas.php' ;?>
    </footer>
</body>
</html>
