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


$formulaireForma = new Formulaire('post','index.php','ajoutFormation','ajoutFormation');
    
$formulaireForma->ajouterComposantLigne($formulaireForma->creerTitre("Ajouter une formation"));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Intitulé de la formation"));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("intitFom", "initiForm", 0, 1, 'Titre de votre formation : "Comment remplir une note de frais.."', null));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Descriptif de la formation"));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("descri", "descri", 0, 1, 'Description de votre formation', null));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Nombre maxmim de participants : "));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("nbrMax", "nbrMax", 0, 1, 'Nombre maximum de participants', null));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Début date ouverture des inscriptions : "));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("debutIns", "debutIns", "required"));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Fin date des inscriptions : "));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("finIns", "finIns", "required"));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Début date formation : "));
$formulaireForma->ajouterComposantTab();

$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("debutFor", "debutFor", "required"));
$formulaireForma->ajouterComposantTab();


$formulaireForma->ajouterComposantLigne($formulaireForma->creerInputSubmit('ajoutFormation','ajoutFormation',"Créer la formation"));
$formulaireForma->ajouterComposantTab();


$formulaireForma->creerFormulaire();


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

        $formulaireForma = new Formulaire('post','index.php','modifForma','modifForma');
            
        $formulaireForma->ajouterComposantLigne($formulaireForma->creerTitre("Modifier une formation"));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Intitulé de la formation"));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("intitFom", "initiForm", $formation->getIntitule(), 1, '', null));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Descriptif de la formation"));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("descri", "descri", $formation->getDescriptif(), 1, '', null));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Nombre maxmim de participants : "));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputTexte("nbrMax", "nbrMax", $formation->getNombreMax(), 1, '', null));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Début date ouverture des inscriptions : "));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("debutIns", "debutIns", "required", $dateDebutInscription));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Fin date ouverture des inscriptions : "));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("finIns", "finIns", "required", $dateFinInscription));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerLabel("Début date formation : "));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputDate("debutFor", "debutFor", "required", $dateDebut));
        $formulaireForma->ajouterComposantTab();

        $formulaireForma->ajouterComposantLigne($formulaireForma->creerInputSubmit('modifForma','modifForma',"Modifier la formation"));
        $formulaireForma->ajouterComposantTab();


        $formulaireForma->creerFormulaire();


    } elseif($_GET['action'] === "attribution") {
        // Si l'attribution est activé (on masque tout et hop)
        $id = htmlspecialchars($_GET['id']);
        $forma = new DaoFormation();
        $contrat = $forma->getOne($id);

        // Mise en place utilisateur :)
        $user = new DaoFormation();
        $user = $user->getUtilisateurDemandeur($id);

    

    }
}


require_once("vue/vueFormation.php");