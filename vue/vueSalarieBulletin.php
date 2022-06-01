<div class = "container">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <main>
        <div class ="texteAccueil">
<?php
echo '<br/>';
echo "<h1 class='title1'> Gérer vos bulletins </h1></br>";
echo '</div>';

?>
        <br/>
        <br/>

<?php
    foreach($bulletins as $bulletin){
        echo '<div class="bulletin">';
        echo '<img src=images/document.png >';
        //bouton dl
        ;
        echo '<br/>';
        echo '<a href='. $bulletin->getBulletinPDF().' download="Bulletin' . $bulletin->getMoisBull() . '_' . $bulletin->getAnneeBull().'"> Télécharger</a>';
    }
?>
    </main>
    <footer>
        <?php include 'bas.php' ;?>
    </footer>
</div>
