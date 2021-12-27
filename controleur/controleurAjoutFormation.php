<?php 
require_once('../lib/Securite.php');
require_once('../modele/dao/DaoParam.php');
require_once('../modele/dao/DaoDBConnex.php');
require_once('../modele/dto/dtoParticipation.php');
require_once('../modele/dao/DaoParticipation.php');

if(isset($_GET['idForma']) && isset($_GET['idUser']) && isset($_GET['data'])) {
   
    $idForma = Securite::nettoyage($_GET['idForma']);
    $idUser = Securite::nettoyage($_GET['idUser']);
    $data = Securite::nettoyage($_GET['data']);

    // Nouvel objet pour l'AJAX
    $participation = new DaoParticipation();
    // On met en place l'objet et la modification
    $part = new DtoParticipation();
    $part->setEtat($data);
    $part->setIdForma($idForma);
    $part->setIdUser($idUser);

    // On envoie 
    $participation->update($part);

}