<div class = "container">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <main>
        <div class ="texteAccueil">
            <?php
            echo '<br/>';
            echo "<h1 class='title1'> Gérer les bulletins </h1></br>";
            echo '</div>';

            ?>
            <br/>
            <br/>

            <?php
            foreach($bulletins as $bulletin){
                echo '<div class="bulletin">';
                echo '<img src=images/document.png >';

                echo '<br/>';
                echo '<a href='. $bulletin->getBulletinPDF().'"> Télécharger</a>';
            }

            $formulaireContrat->afficherFormulaire();
            ?>
    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>
