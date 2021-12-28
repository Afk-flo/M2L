<?php 

// Récupère toutes les formations
$formation = new DaoFormation();
$pre = $formation->getAllorNull();



$formations = array();
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

// On enlève les formations déjà finis et celles qui ne sont pas encore dispo pour les inscriptions
foreach($pre as $pre) {
    if($pre->getNombreFinal() == "-1") {
        if ($pre->getDateOuvertureInscription() < $date) {
            $particip = new DaoParticipation();
            $particip = $particip->getParticipation($_SESSION['user']['id'], $pre->getIdFormation());
            if(is_bool($particip) && $pre->getDateFinInscription() < $date) {
                // pass
            } else {
                array_push($formations, $pre);
            }
        }
    }
}

// Si on demande une inscription a une formation
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $forma = new DtoParticipation();
    $forma->setIdForma($id);
    $forma->setIdUser($_SESSION['user']['id']);
    $forma->setEtat("ATTENTE");

    // Date 
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');
    $forma->setDateInscription($date);

    $part = new DaoParticipation();
    $part = $part->ajout($forma) ;
    $_SESSION['message'] = ['type' => 'succes', 'message' => 'Demande faite avec succès'];
}

require_once('vue/vueBEFormation.php');
