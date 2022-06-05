<div class="conteneur">
    <header>
        <?php include 'haut.php' ;?>
    </header>
    <main>

        <div class='texteAccueil'>
            <p>Bonjour !</p><br>
            <h3>Voici vos informations personnelles</h3>
            <br><br>

            <?php
            $formulaireContrat->afficherFormulaire();

            ?>


        </div>

    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>