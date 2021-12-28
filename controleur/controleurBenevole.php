<?php 

if($_SESSION['user']['fonction'] == "benevole") {

    // Vue formation pour les bénévoles 

    $benevole = new Menu("benevole");

    $benevole->ajouterComposant($benevole->creerItemLien("accueil", "Accueil"));
    $benevole->ajouterComposant($benevole->creerItemLien("formations", "Les formations"));
    $benevole->ajouterComposant($benevole->creerItemLien("deconnexion", "Se déconnecter"));
    
    $menuPrincipalM2L = $benevole->creerMenu('0','benevole');

    if(isset($_GET['benevole']) && !empty($_GET['benevole'])) {
        $target = Securite::nettoyage($_GET['benevole']);
        if($target == "formations") {
            require_once(dispatcher::dispatch('BEFormation'));
            die();
        } else {
            require_once("vue/vueIntervenantBenevole.php");
            die();
        }
    }

    require_once("vue/vueIntervenantBenevole.php");

 
} else {
    require_once(dispatcher::dispatch("Accueil"));
    die();
}
