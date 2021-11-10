<?php

if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
    $login = Securite::nettoyage($_POST["login"]);
    $mdp =  Securite::nettoyage($_POST["mdp"]);

    $userDAO = new DaoUtilisateur();
    $user = $userDAO->login($login,$mdp);

    if($user != null ){
        switch($user->getFonction()) {
            case 1:
                $_SESSION['identification']['fonction'] = 'salarie';
                require_once("vue/vueIntervenantSalarie.php");
                break;
            case 2:
                $_SESSION['identification']['fonction'] = 'admin';
                require_once("../vue/vuePanel.php");
                break;
            case 3:
                $_SESSION['identification']['fonction'] = 'responsable';
                require_once("../vue/vueResponsableFormation.php");
                break;
            case 4:
                $_SESSION['identification']['fonction'] = 'benevole';
                require_once("../vue/vueIntervenantBenevole.php");
                break;
            case 5:
                $_SESSION['identification']['fonction'] = 'gerantrh';
                require_once("../vue/vueGerantRH.php");
                break;
            default:
                $userDAO->deconnexion();
                $_SESSION['error'] = "Erreur dans l'initialisation du profil - contactez l'administrateur.";
                require dispatcher::dispatch("logOut");
        }
    }
    else{
        $_SESSION['error'] = "Identifiants incorrects";
        Header("Location:../vue/vueConnexion.php");
    }
}
else{
    Header("Location:../vue/vueConnexion.php");
}



