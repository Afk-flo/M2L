<?php 

$user = new DaoUtilisateur();
$user = $user->getOneOrNull($_SESSION['identification']['id'],$_SESSION['identification']['token']);

require_once("vue/vueIntervenantSalarie.php");
