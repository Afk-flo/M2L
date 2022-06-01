<div class = "container">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <main>
        <div class ="texteAccueil">
            <?php
            echo '<br/>';
            echo "<h1 class='title1'> Gérer vos contrats </h1></br>";
            echo '</div>';

            //affichage différent selon le user
            ?>

        <table>

        <tr>
            <th>Contrat</th>
            <th>Date Debut</th>
            <th>Date Fin</th>
            <th>Type Contrat</th>
            <th>Nombre d'heures</th>63
        </tr>

        <?php
        foreach($lesContratsUser as $lesContratsUser) {
            echo '<tr>';
            echo '<td>' . $lesContratsUser->getidContrat() . '</td>';
            echo '<td>' . $lesContratsUser->getDateDebut() . '</td>';
            echo '<td>' . $lesContratsUser->getDateFin() . '</td>';
            echo '<td>' . $lesContratsUser->getTypeContrat() . '</td>';
            echo '<td>' . $lesContratsUser->getNbHeures() . '</td>';
            echo '<td> <a class="Intlink" href="index.php?salarie=bulletin&id='.$lesContratsUser->getIdContrat().'"> <i class="fa fa-file-text"></i> </a></td>';
            echo '</tr>';
        }
        ?>

        </table>


        </div>
    </main>
</div>