<?php 

// Récupè toutes les formations
$formation = new DaoFormation();
$formations = $formation->getAllorNull();


// Traitement des formations -> Selon la date et leur date de début on va les mettres dans dans différents tableaux
$preForma = [];
$formaOuverte = [];
$formaFermePre = [];
$formaFermeFini = [];

$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

foreach($formations as $formations) {
    
    if($formations->getDateOuvertureInscription() > $date ) {
       
        array_push($preForma, $formations);
    } else {
        if($formations->getDateFinInscription() > $date) {
            array_push($formaOuverte, $formations);
        }
        else {
            if($formations->getNombreFinal() == -1) {
                array_push($formaFermePre, $formations);
            } else {
                array_push($formaFermeFini, $formations);
            }
        }
    }
}


$formulaireFormation = new Formulaire('post','index.php','ajoutFormation','ajoutFormation');
    
$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerTitre("Ajouter une formation"));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Intitulé de la formation"));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("intitFom", "initiForm", 0, 1, 'Titre de votre formation : "Comment remplir une note de frais.."', null));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Descriptif de la formation"));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("descri", "descri", 0, 1, 'Description de votre formation', null));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Nombre maxmim de participants : "));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("nbrMax", "nbrMax", 0, 1, 'Nombre maximum de participants', null));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Début date ouverture des inscriptions : "));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("debutIns", "debutIns", "required"));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Fin date des inscriptions : "));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("finIns", "finIns", "required"));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Début date formation : "));
$formulaireFormation->ajouterComposantTab();

$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("debutFor", "debutFor", "required"));
$formulaireFormation->ajouterComposantTab();


$formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputSubmit('ajoutFormation','ajoutFormation',"Créer la formation"));
$formulaireFormation->ajouterComposantTab();


$formulaireFormation->creerFormulaire();


if(isset($_GET['id']) && isset($_GET['action'])) {
    if($_GET['action'] === "delete") {
        $forma = new DaoFormation();
        $forma->delete(htmlspecialchars($_GET['id']));
        $_SESSION['message'] = "Élément supprimé avec succès";
        // reload si possible        

    } else if($_GET['action'] === "toUpdate") {

        $forma = new DaoFormation();
        $formation = $forma->getOne(htmlspecialchars($_GET['id']));

        $dateDebutInscription = substr($formation->getDateOuvertureInscription(),0,10);
        $dateFinInscription = substr($formation->getDateFinInscription(),0,10);
        $dateDebut = substr($formation->getDateDebut(),0,10);

        $_SESSION['idForma'] = htmlspecialchars($_GET['id']);

        $formulaireFormation = new Formulaire('post','index.php','modifForma','modifForma');
            
        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerTitre("Modifier une formation"));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Intitulé de la formation"));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("intitFom", "initiForm", $formation->getIntitule(), 1, '', null));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Descriptif de la formation"));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("descri", "descri", $formation->getDescriptif(), 1, '', null));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Nombre maxmim de participants : "));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputTexte("nbrMax", "nbrMax", $formation->getNombreMax(), 1, '', null));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Début date ouverture des inscriptions : "));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("debutIns", "debutIns", "required", $dateDebutInscription));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Fin date ouverture des inscriptions : "));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("finIns", "finIns", "required", $dateFinInscription));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerLabel("Début date formation : "));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputDate("debutFor", "debutFor", "required", $dateDebut));
        $formulaireFormation->ajouterComposantTab();

        $formulaireFormation->ajouterComposantLigne($formulaireFormation->creerInputSubmit('modifForma','modifForma',"Modifier la formation"));
        $formulaireFormation->ajouterComposantTab();


        $formulaireFormation->creerFormulaire();


    } elseif($_GET['action'] === "attribution") {
        // Si l'attribution est activé (on masque tout et hop)
        $id = htmlspecialchars($_GET['id']);
        $forma = new DaoFormation();
        $forma = $forma->getOne($id);

        // Mise en place utilisateur :)
        $user = new DaoFormation();
        $user = $user->getUtilisateurDemandeur($id);

    

    }
}


require_once("vue/vueFormation.php");