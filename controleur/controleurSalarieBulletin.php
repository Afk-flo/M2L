<?php

$bulletin = new DaoBulletin();
$bulletins = $bulletin->getBulletinsContrat($_GET['id']);

require_once("vue/vueSalarieBulletin.php");