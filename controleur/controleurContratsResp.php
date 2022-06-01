<?php

$contrat = new DaoContrat();
$contrats = $contrat->getContrats();

$user= new DaoUtilisateur();
$users = $user->getAllSalarie();


$formulaireContrat = new Formulaire('post','index.php','ajoutContrat','ajoutContrat');

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Ajouter un Contrat"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Date de début du contrat :"));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputDate("debutContrat", "debutContrat", "required"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Date de fin du contrat :"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputDate("finContrat", "finContrat", "required"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Nombre d'heures :"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("nbHeures", "nbHeures", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Type du contrat"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("typeContrat", "typeContrat", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Choisissez un intervenant salarié"));
$formulaireContrat->ajouterComposantTab();

foreach($users as $users){
    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("user", $users->getNom() . " " . $users->getPrenom(), $users->getIdUser(), $users->getIdUser()));
    $formulaireContrat->ajouterComposantTab();
}



$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('ajoutContrat','ajoutContrat',"Créer un contrat"));
$formulaireContrat->ajouterComposantTab();



$formulaireContrat->creerFormulaire();


if(isset($_GET['action'])) {
    if ($_GET['action'] === "deleteContrat") {
        $contrat = new DaoContrat();
        $contrat->suppContrat($_GET['id']);

    } else if ($_GET['action'] === "modifContrat") {
        $user= new DaoUtilisateur();
        $users = $user->getAllSalarie();

        $contr = new DaoContrat();
        $contrat = $contr->getUnContrat(htmlspecialchars($_GET['id']));

        $dateDebut = substr($contrat->getDateDebut(), 0, 10);
        $dateFin = substr($contrat->getDateFin(), 0, 10);

        $_SESSION['id'] = htmlspecialchars($_GET['id']);

        $formulaireContrat = new Formulaire('post', 'index.php', 'modifContrat', 'modifContrat');

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Modifier un Contrat"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Date de début du contrat :"));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputDate("debutContrat", "debutContrat", "required",$dateDebut));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Date de fin du contrat :"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputDate("finContrat", "finContrat", "required",$dateFin));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Nombre d'heures :"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("nbHeures", "nbHeures", $contrat->getNbHeures(), 1, '', null));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Type du contrat"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("typeContrat", "typeContrat", $contrat->getTypeContrat(), 1, '', null));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Choisissez un intervenant salarié"));
        $formulaireContrat->ajouterComposantTab();

        foreach($users as $users){
            $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("user", $users->getNom()." ".$users->getPrenom(), $users->getIdUser(), $users->getIdUser()));
            $formulaireContrat->ajouterComposantTab();
        }


        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('modifContrat', 'modifContrat', "Modifier un Contrat"));
        $formulaireContrat->ajouterComposantTab();


        $formulaireContrat->creerFormulaire();

    }
}

require_once("vue/vueContratsResp.php");
