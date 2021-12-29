<?php 

if($_SESSION['user']['fonction'] == "formation") {

    $forma = new Menu("forma");

    $forma->ajouterComposant($forma->creerItemLien("accueil", "Accueil"));
    $forma->ajouterComposant($forma->creerItemLien("lesFormations", "Les formations"));
    $forma->ajouterComposant($forma->creerItemLien("deconnexion", "Se déconnecter"));
    
    $menuPrincipalM2L = $forma->creerMenu('0','Formation');

    if(isset($_GET['Formation']) && !empty($_GET['Formation'])) {
        $target = Securite::nettoyage($_GET['Formation']);
        if($target == "lesFormations") {
            require_once(dispatcher::dispatch('LesFormations'));
            die();
        } elseif($target === "deconnexion") {
            $_SESSION['user'] = [];
            session_destroy();
            include_once dispatcher::dispatch('Accueil');
            die();
        } elseif($target === "VoirFormation") {
            require_once(dispatcher::dispatch('VoirFormation'));
            die();
        }
    }
    

    if(isset($_POST['modifForma'])) {
        if(!empty($_POST['intitFom']) && !empty($_POST['descri']) && !empty($_POST['nbrMax']) && !empty($_POST['debutIns']) && !empty($_POST['finIns']) && !empty($_POST['debutFor'])) {
            $intitule = Securite::nettoyage($_POST['intitFom']);
            $descri = Securite::nettoyage($_POST['descri']);
            $nbMax = Securite::nettoyage($_POST['nbrMax']);
            $debutIns = Securite::nettoyage($_POST['debutIns']);
            $finIns = Securite::nettoyage($_POST['finIns']);
            $debut = Securite::nettoyage($_POST['debutFor']);

            $nbMax = intval($nbMax);
            if($nbMax != null && $nbMax > 0 && $nbMax < 5000) {
                if($debutIns < $finIns && $debut > $finIns) {

            $formation = new DtoFormation();
            $formation->setIntituel($intitule);
            $formation->setDescriptif($descri);
            $formation->setNombreMax($nbMax);
            $formation->setDateOuvertureInscription($debutIns);
            $formation->setDateClotureInscription($finIns);
            $formation->setDateDebut($debut);
            $formation->setIdForma($_SESSION['idForma']);

            $action = new DaoFormation();
            $action->update($formation);

            $_SESSION['message'] = ['type' => 'succes', 'message' => 'Formation mise à jour avec succès'];
            require_once(dispatcher::dispatch('LesFormations'));
                  die();
                } else {
                    $_SESSION['message'] = ['type' => 'alert', 'message' => 'Les dates doivent être valide'];
                    require_once(dispatcher::dispatch('LesFormations'));
                }
            } else {
                $_SESSION['message'] = ['type' => 'alert', 'message' => 'Le nombre maximum doit être un chiffre compris entre 1 et 4999'];
                require_once(dispatcher::dispatch('LesFormations'));
            }
        } else {
            $_SESSION['message'] = ['type' => 'alert', 'message' => 'Tous les champs ne sont pas remplis'];
            require_once(dispatcher::dispatch('LesFormations'));
        }
    }



    if(isset($_POST['ajoutFormation'])) {
        if(!empty($_POST['intitFom']) && !empty($_POST['descri']) && !empty($_POST['nbrMax']) && !empty($_POST['debutIns']) && !empty($_POST['finIns']) && !empty($_POST['debutFor'])) {
            $intitule = Securite::nettoyage($_POST['intitFom']);
            $descri = Securite::nettoyage($_POST['descri']);
            $nbMax = Securite::nettoyage($_POST['nbrMax']);
            $debutIns = Securite::nettoyage($_POST['debutIns']);
            $finIns = Securite::nettoyage($_POST['finIns']);
            $debut = Securite::nettoyage($_POST['debutFor']);

            // Vérification des dates et du nombre de candidat
            $nbMax = intval($nbMax);
            if($nbMax != null && $nbMax > 0 && $nbMax < 5000) {
                if($debutIns < $finIns && $debut > $finIns) {

                    $formation = new DtoFormation();
                    $formation->setIntituel($intitule);
                    $formation->setDescriptif($descri);
                    $formation->setNombreMax($nbMax);
                    $formation->setDateOuvertureInscription($debutIns);
                    $formation->setDateClotureInscription($finIns);
                    $formation->setDateDebut($debut);
                    $formation->setIdResponsable($_SESSION['user']['id']);

                    // En envoie honney 
                    $action = new DaoFormation();
                    $action->create($formation);

                    $_SESSION['message'] = ['type' => 'succes', 'message' => 'Formation ajoutée avec succès'];
                    require_once(dispatcher::dispatch('LesFormations'));
                    die();
                } else {
                    $_SESSION['message'] = ['type' => 'alert', 'message' => 'Les dates doivent être valide'];
                    require_once(dispatcher::dispatch('LesFormations'));
                }
            } else {
                $_SESSION['message'] = ['type' => 'alert', 'message' => 'Le nombre maximum doit être un chiffre compris entre 1 et 4999'];
                require_once(dispatcher::dispatch('LesFormations'));
            }
        } else {
            $_SESSION['message'] = ['type' => 'alert', 'message' => 'Tous les champs ne sont pas remplis'];
            require_once(dispatcher::dispatch('LesFormations'));
        }
    }
    
    require_once("vue/vueResponsableFormation.php");
}
