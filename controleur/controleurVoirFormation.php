<?php 

if(isset($_GET['idForma'])) {

    $unique = new DaoFormation();
    $forma = $unique->getOne(htmlspecialchars($_GET['idForma']));
    $full = $unique->getUtilisateurAccepte(htmlspecialchars($_GET['idForma']));


} else {
    // Si on a pas d'id de formation
    require_once(dispatcher::dispatch('lesFormations'));
    die();
}

require_once('vue/vueUniqueForma.php');
