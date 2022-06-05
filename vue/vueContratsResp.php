<div class="container">

    <header>

        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='texteAccueil'>
<?php
echo "<br/>";
echo "<h1 class='title1'> Gérer tous les contrats, " . $_SESSION['user']['nom'] . "</h1><br/>";
echo "</div>";
?>
 <table>

            <tr>
                <th>Id</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Type Contrat</th>
                <th>Nombre d'heures</th>
                <th>Utilisateur</th>
            </tr>

            <?php
            foreach($contrats as $contrats) {
                echo '<tr>';
                echo '<td>' . $contrats->getIdContrat() . '</td>';
                echo '<td>' . $contrats->getDateDebut() . '</td>';
                echo '<td>' . $contrats->getDateFin() . '</td>';
                echo '<td>' . $contrats->getTypeContrat() . '</td>';
                echo '<td>' . $contrats->getNbHeures() . '</td>';
                echo '<td>' . $contrats->getIdUser() . '</td>';


                echo '<td> <a class="Intlink" href="index.php?Rh=contratsResp&id='.$contrats->getIdContrat().'&action=deleteContrat"> <i class="fas fa-trash"></i> </a></td>';
                echo '<td> <a class="Intlink" href="index.php?Rh=contratsResp&id='.$contrats->getIdContrat().'&action=modifContrat"> <i class="fas fa-user-edit"></i> </a></td>';
                echo '<td> <a class="Intlink" href="index.php?Rh=bulletinRh&id='.$contrats->getIdContrat().'"> <i class="fa fa-file-text"></i> </a></td>';
                echo '</tr>';
            }
            ?>

            </table>

            <div class="container">
                <?php
                $formulaireContrat->afficherFormulaire();
                ?>
            </div>
        </div>
    </main>