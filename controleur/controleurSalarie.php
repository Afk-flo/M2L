<?php 

if($_SESSION['user']['fonction'] == "salarie") {

    // Vue formation pour les bénévoles 

    $salarie = new Menu("salarie");

    $salarie->ajouterComposant($salarie->creerItemLien("accueil", "Accueil"));
    $salarie->ajouterComposant($salarie->creerItemLien("formations", "Les formations"));
    $salarie->ajouterComposant($salarie->creerItemLien("deconnexion", "Se déconnecter"));
    
    $menuPrincipalM2L = $salarie->creerMenu('0','salarie');

    if(isset($_GET['salarie']) && !empty($_GET['salarie'])) {
        $target = Securite::nettoyage($_GET['salarie']);
        if($target == "formations") {
            require_once(dispatcher::dispatch('BEFormation'));
            die();
        } else {
            require_once("vue/vueIntervenantsalarie.php");
            die();
        }
    }

    require_once("vue/vueIntervenantsalarie.php");

 
} else {
    require_once(dispatcher::dispatch("Accueil"));
    die();
}
