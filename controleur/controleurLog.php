<?php

require_once('../modele/dao/daoUtilisateur.php');

if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
    $login = htmlspecialchars($_POST["login"]);
    $mdp =  htmlspecialchars($_POST["mdp"]);

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



