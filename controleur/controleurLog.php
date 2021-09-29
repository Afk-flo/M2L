<?php
require_once("../lib/authentification.php");

if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
    $login = htmlspecialchars($_POST["login"]);
    $mdp =  htmlspecialchars($_POST["mdp"]);

    $authentification = new authentification();

    if($authentification->login($login,$mdp)){
        require_once ("../vue/vuePanel");
    }
    else{
        Header("Location:../vue/vueConnexion.php");
    }
}
else{
    Header("Location:../vue/vueConnexion.php");
}



