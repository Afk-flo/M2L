<?php

require_once('../modele/dao/daoUtilisateur.php');

if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
    $login = htmlspecialchars($_POST["login"]);
    $mdp =  htmlspecialchars($_POST["mdp"]);

    $user = new daoUtilisateur();

    if($user->login($login,$mdp)){
        require_once ("../vue/vuePanel");
    }
    else{
        $_SESSION['error'] = "Identifiants incorrects";
        Header("Location:../vue/vueConnexion.php");
    }
}
else{
    Header("Location:../vue/vueConnexion.php");
}



