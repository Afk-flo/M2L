<div class="container">

    <header>

        <?php include 'haut.php' ;?>
    </header>
    <main>
        <div class='texteAccueil'>
            <?php
            echo "<br/>";
            echo "<h1 class='title1'> Gérer tous les utilisateurs, " . $_SESSION['user']['nom'] . "</h1><br/>";
            echo "</div>";
            ?>
            <table>

                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Fonction</th>
                    <th>Club</th>
                    <th>Ligue</th>
                </tr>

                <?php
                foreach($users as $users) {
                    echo '<tr>';
                    echo '<td>' . $users->getNom() . '</td>';
                    echo '<td>' . $users->getPrenom() . '</td>';
                    echo '<td>' . $users->getFonction() . '</td>';
                    echo '<td>' . $users->getClub() . '</td>';
                    echo '<td>' . $users->getLigue() . '</td>';

                    echo '<td> <a class="Intlink" href="index.php?Rh=RhUsers&id='.$users->getIdUser().'&action=deleteUser"> <i class="fas fa-trash"></i> </a></td>';
                    echo '<td> <a class="Intlink" href="index.php?Rh=RhUsers&id='.$users->getIdUser().'&action=majUser"> <i class="fas fa-user-edit"></i> </a></td>';
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