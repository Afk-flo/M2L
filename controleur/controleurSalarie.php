<?php 

if($_SESSION['user']['fonction'] == "salarie") {
    $user = new DaoUtilisateur();
    $utilisateur = $user->getOneOrNull($_SESSION['user']['id']);

    $salarie = new Menu("salarie");

    $salarie->ajouterComposant($salarie->creerItemLien("accueil", "Accueil"));
    $salarie->ajouterComposant($salarie->creerItemLien("formations", "Les formations"));
    $salarie->ajouterComposant($salarie->creerItemLien("contrat", "Les contrats"));
    $salarie->ajouterComposant($salarie->creerItemLien("deconnexion", "Se déconnecter"));

    $menuPrincipalM2L = $salarie->creerMenu('0', 'salarie');

    if (isset($_GET) && !empty($_GET['salarie'])) {
        $target = Securite::nettoyage($_GET['salarie']);
        if ($target == "formations") {
            require_once(dispatcher::dispatch('BEFormation'));
            die();
        } elseif ($target == "contrat") {
            require_once(dispatcher::dispatch('contratSalarie'));
            die();
        } elseif ($target === "deconnexion") {
            $_SESSION['user'] = [];
            session_destroy();
            include_once dispatcher::dispatch('Accueil');
            die();
        }
        elseif($target == "bulletin"){
            require_once(dispatcher::dispatch('salarieBulletin'));
            die();
        }

    }

    require_once("vue/vueIntervenantSalarie.php");

}

