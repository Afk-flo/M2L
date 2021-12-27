<div class="container">

	<header>
		
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class='texteAccueil'>
			<?php 
			echo "<br/>";
            echo "<h1 class='title1'> Bienvenu dans l'espace de gestion des formations " . $_SESSION['user']['nom'] . "</h1><br/>";
        	echo "</div>";

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
			

            if(!isset($user)) {
				$formulaireFormation->afficherFormulaire();
			}
		?>


		<?php 
		// Si l'user existe, on met en place uniquement le formulaire d'interaction avec les demandes 
		// On se base sur un principe presque PWA 
		if(isset($user)) {
			echo "<br/>";
            echo "<h3 class='title3'> Attribution des employés à la formation '". $forma->getIntitule() ."'</h3><br/>";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			// Affichage pour le nombre en cours 
			$count = new DaoParticipation();
			$count = $count->getCount($forma->getIdFormation());
			echo "<h3 class='title3'> Places disponibles : <span id='nbr'>".	$count["count(idForma)"] . "</span>/" . $forma->getNombreMax() . " </h3>";

			echo "<div class='truc'>";
			foreach($user as $user) {
				$participation = new DaoParticipation();
				$participation = $participation->getParticipation($user->getIdUser(), $forma->getIdFormation());
				?>
				<?php 
				if($participation->getEtat() == "ATTENTE") {
					echo "<div id='demandeur'>";
				} else {
					echo "<div class='demandeur".$participation->getEtat()."'>";
				} ?>
					<h4 class="user"> Demandeur : <?php echo $user->getNom(); echo " "; echo $user->getPrenom(); ?> </h4>
						<p> Fonction : <?php echo $user->getFonction(); ?> </p>
						<p> Club : <?php echo $user->getClub(); ?> </p>
						<p> Utilisateur inscrit le : <?php echo $participation->getDateInscription(); ?> </p>

						<?php 
						// Création de participation avec id et vérification état (peux être fait au dessus pour affichage particulier)
						if($participation->getEtat() == "ATTENTE") {
							?>
							<p> Validez-vous cet utilisateur ? </p>
							<div class="choix">
								<button onclick="registreUser(<?php echo $forma->getIdFormation(); ?>,<?php echo $user->getIdUser(); ?>,'ACCEPTE',<?php echo $forma->getNombreMax() ?>,<?php echo $count['count(idForma)']; ?>)" id="oui"> Oui </button>
								<button onclick="registreUser(<?php echo $forma->getIdFormation(); ?>,<?php echo $user->getIdUser(); ?>,'REFUSE',<?php echo $forma->getNombreMax() ?>,<?php echo $count['count(idForma)']; ?>)" id="non"> Non </button>
								<span id="info"></span>
							</div>
							<?php
						} else {
							echo '<div class="choix'.$participation->getEtat().'">';
								echo "</p class='".$participation->getEtat()."'> Pour cet utilisateur, vous avez dit : " . $participation->getEtat() .".";
							echo '</div>';
						}
						?>

				</div>
				<?php 
			}
			echo "</div>";
		} else {
			?>

		
		<div class="droite">

		<h1> Formations à venir </h1>
		<?php 
		if(!empty($preForma)) {
			?>		
		<br/>

		<table id="tableResp" >

		<tr>
			<th>Intitulé</th>
			<th>Libellé</th>
			<th>Date départ inscription</th>
			<th>Date fin inscription </th>
			<th>Nombre d'inscris maximum </th>
			<th>Responsable</th>
			<th>Date de départ</th>
			<th>Supprimer</th>
			<th>Modifier</th>
		</tr>

		<?php 
		foreach($preForma as $formations) {
			echo '<tr>';
			echo '<td>' . $formations->getIntitule() . '</td>';
			echo '<td>' . $formations->getDescriptif() . '</td>';
			echo '<td>' . $formations->getDateOuvertureInscription() . '</td>';
			echo '<td>' . $formations->getDateFinInscription() . '</td>';
			echo '<td>' . $formations->getNombreMax() . '</td>';
			echo '<td>' . $formations->getResponsable() . '</td>';
			echo '<td>' . $formations->getDateDebut() . '</td>';

			echo '<td> <a class="Intlink" href="index.php?Formation=lesFormations&id='.$formations->getIdFormation().'&action=delete"> <i class="fas fa-trash"></i> </a></td>';
			echo '<td> <a class="Intlink" href="index.php?Formation=lesFormations&id='.$formations->getIdFormation().'&action=toUpdate"> <i class="fas fa-user-edit"></i> </a></td>';
			echo '</tr>';
		}
		?>

		</table>
		<?php 
		} else {
			echo "Aucune formation pour le moment ..";
		}
		?>


		<div class="jump"></div>
		
		

		<h1> Formations en cours d'inscription </h1>
		<?php 
		if(!empty($formaOuverte)) {
			?>

		<table id="tableResp">

		<tr>
			<th>Intitulé</th>
			<th>Libellé</th>
			<th>Date départ inscription</th>
			<th>Date fin inscription </th>
			<th>Nombre d'inscris maximum </th>
			<th>Responsable</th>
			<th>Date de départ</th>
			<th>Supprimer</th>
			<th>Modifier</th>
		</tr>

		<?php 
		foreach($formaOuverte as $formations) {
			echo '<tr>';
			echo '<td>' . $formations->getIntitule() . '</td>';
			echo '<td>' . $formations->getDescriptif() . '</td>';
			echo '<td>' . $formations->getDateOuvertureInscription() . '</td>';
			echo '<td>' . $formations->getDateFinInscription() . '</td>';
			echo '<td>' . $formations->getNombreMax() . '</td>';
			echo '<td>' . $formations->getResponsable() . '</td>';
			echo '<td>' . $formations->getDateDebut() . '</td>';

			echo '<td> <a class="Intlink" href="index.php?Formation=lesFormations&id='.$formations->getIdFormation().'&action=delete"> <i class="fas fa-trash"></i> </a></td>';
			echo '<td> <a class="Intlink" href="index.php?Formation=lesFormations&id='.$formations->getIdFormation().'&action=toUpdate"> <i class="fas fa-user-edit"></i> </a></td>';
			echo '</tr>';
		}
		?>

		</table>

		<?php 
		} else {
			echo "Aucune formation pour le moment ..";
		}
		?>

		<div class="jump"></div>		


		<h1> Formations avec inscription terminé et attribution en attente </h1>

		<br/>
		<?php 
		if(!empty($formaFermePre)) {
			?>
		<div>
			<p class="attention"> <i class="fas fa-exclamation-triangle"></i> <bold>Attention ! </bold> Ces formations doivent être complétées. </p>
		</div>

		<table id="tableResp">

		<tr>
			<th>Intitulé</th>
			<th>Libellé</th>
			<th>Date départ inscription</th>
			<th>Date fin inscription </th>
			<th>Nombre d'inscris maximum </th>
			<th>Responsable</th>
			<th>Date de départ</th>
			<th>Attribuer</th>
		</tr>

		<?php 
		foreach($formaFermePre as $formations) {
			echo '<tr>';
			echo '<td>' . $formations->getIntitule() . '</td>';
			echo '<td>' . $formations->getDescriptif() . '</td>';
			echo '<td>' . $formations->getDateOuvertureInscription() . '</td>';
			echo '<td>' . $formations->getDateFinInscription() . '</td>';
			echo '<td>' . $formations->getNombreMax() . '</td>';
			echo '<td>' . $formations->getResponsable() . '</td>';
			echo '<td>' . $formations->getDateDebut() . '</td>';

			echo '<td> <a class="Intlink" href="index.php?Formation=lesFormations&id='.$formations->getIdFormation().'&action=attribution"> <i class="fas fa-clipboard"></i> </a></td>';
			echo '</tr>';
		}
		?>

		</table>
		<?php 
		} else {
			echo "Aucune formation pour le moment ..";
		}
		?>

		<div class="jump"></div>



		<h1> Formations avec inscription terminé et attribution </h1>
		<?php 
		if(!empty($formaFermeFini)) {
			?>
		<table id="tableResp">

		<tr>
			<th>Intitulé</th>
			<th>Libellé</th>
			<th>Date départ inscription</th>
			<th>Date fin inscription </th>
			<th>Nombre d'inscris maximum </th>
			<th>Responsable</th>
			<th>Date de départ</th>
			<th>Nombre d'inscription final</th>
		</tr>

		<?php 
		foreach($formaFermeFini as $formations) {
			echo '<tr>';
			echo '<td>' . $formations->getIntitule() . '</td>';
			echo '<td>' . $formations->getDescriptif() . '</td>';
			echo '<td>' . $formations->getDateOuvertureInscription() . '</td>';
			echo '<td>' . $formations->getDateFinInscription() . '</td>';
			echo '<td>' . $formations->getNombreMax() . '</td>';
			echo '<td>' . $formations->getResponsable() . '</td>';
			echo '<td>' . $formations->getDateDebut() . '</td>';
			echo '<td>' . $formations->getNombreFinal() . '</td>';
			echo '</tr>';
		}
		?>

		</table>
		<?php 
		} else {
			echo "Aucune formation pour le moment ..";
		}
		?>

		<div class="jump"></div>



		</div>
		</div>
	</main>

		<?php 
	
		}
		?>




	<footer>
	<script>
			function registreUser(idForma, idUser, data, count, max)
			{
				console.log(idForma);
				console.log(idUser);
				console.log(data);
				
				if(count === max && data === "ACCEPTE") {
					// Si le compte n'est pas bon et que la date est true 
					alert("Le nombre maximum de candidat accepté a été atteint. Lo siento chico");
					return null;
					// Si les resultats ne sont pas au max 
				} else {

				// création de l'objet de requête
				xmlhttp = new XMLHttpRequest();
		
				xmlhttp.onreadystatechange = function()
				{
					// Si l'envoie est bon 
					
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						// On récupère les données 
						console.log("ça marche honnney");
						console.log(url);
						console.log(xmlhttp.status);

					}
				}

				// Envoie 
				let url = "controleur/controleurAjoutFormation.php?idForma="+idForma+"&idUser="+idUser+"&data="+data+"";
				xmlhttp.open("GET",url,true);
				xmlhttp.send();
				
				// Dès que c'est bon, on modifie le DOM 
				let conteneur = document.getElementById("demandeur");
				let btn1 = document.getElementById("oui");
				let btn2 = document.getElementById("non");
				let info = document.getElementById("info");

				btn1.style.display = "none";
				btn2.style.display = "none";

				
				if(data === "ACCEPTE") {
					info.innerHTML = "Pour cet utilisateur, vous avez dit : ACCEPTE";
					info.classList.add("choixACCEPTE");
					conteneur.classList.add("demandeurACCEPTE");
					//conteneur.parentNode.removeChild(conteneur);
				} else {
					info.innerHTML = "Pour cet utilisateur, vous avez dit : REFUSE";
					info.classList.add("choixREFUSE");
					conteneur.classList.add("demandeurREFUSE");
					conteneur.classList.remove("demandeur");
				}

				if(data === "ACCEPTE") {
					let elem = document.getElementById("nbr");
					let damn = parseInt(elem.innerHTML)+1;
					elem.innerHTML = damn;
				}

			  }
			}	

			</script>
		<?php include 'bas.php' ;?>
	</footer>
</div>