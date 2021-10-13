<?php

require_once('../modele/dao/daoUtilisateur.php');
require_once('../lib/Securite.php');

if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
    $login = Securite::nettoyage($_POST["login"]);
    $mdp =  Securite::nettoyage($_POST["mdp"]);

    $userDAO = new daoUtilisateur();
    $user = $userDAO->login($login,$mdp);

    if($user != null ){
        require_once ("../vue/vuePanel.php");
    }
    else{
        $_SESSION['error'] = "Identifiants incorrects";
        Header("Location:../vue/vueConnexion.php");
    }
}
else{
    Header("Location:../vue/vueConnexion.php");
}



