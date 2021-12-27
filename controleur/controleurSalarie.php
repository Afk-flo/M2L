<?php 

$user = new DaoUtilisateur();
$user = $user->getOneByToken($_SESSION['user']['token']);
echo "d";
require_once("vue/vueIntervenantSalarie.php");
