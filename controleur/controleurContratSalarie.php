<?php

$contr = new DaoContrat();
$lesContratsUser = $contr->getContratsUser($_SESSION['user']['id']);

require_once("vue/vueContratsSalarie.php");