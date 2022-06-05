<div class="container">

    <header>

        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='texteAccueil'>
            <?php
            echo "<br/>";
            echo "<h1 class='title1'> Gérer tous les bulletins, " . $_SESSION['user']['nom'] . "</h1><br/>";
            echo "</div>";
            ?>
            <table>

                <tr>
                    <th>Id</th>
                    <th>Mois</th>
                    <th>Année</th>
                    <th>Bulletin</th>
                    <th>Utilisateur</th>
                </tr>

                <?php
                foreach($bulletins as $bulletin) {
                    echo '<tr>';
                    echo '<td>' . $bulletin->getIdBulletin() . '</td>';
                    echo '<td>' . $bulletin->getMoisBull() . '</td>';
                    echo '<td>' . $bulletin->getAnneeBull() . '</td>';
                    echo '<td>' . $bulletin->getBulletinPDF() . '</td>';
                    echo '<td>' . $bulletin->getIdContrat() . '</td>';


                    echo '<td> <a class="Intlink" href="index.php?Rh=bulletinRh&id='.$bulletin->getIdBulletin().'&action=suppBulletin"> <i class="fas fa-trash"></i> </a></td>';
                    echo '<td> <a class="Intlink" href="index.php?Rh=bulletinRh&id='.$bulletin->getIdBulletin().'&action=modifBulletin"> <i class="fas fa-user-edit"></i> </a></td>';
                    echo '<td> <a class="Intlink" href="/M2L'. $bulletin->getBulletinPDF() . '"> <i class="fa fa-file-text"></i></a></td>';
                    echo '</tr>';
                }
                ?>

            </table>

            <div class="container">
                <?php
                $formulaireBulletin->afficherFormulaire();

                ?>
            </div>
        </div>
    </main>
</div>