<?php

$bulletin = new DaoBulletin();
$bulletins=$bulletin->getBulletinsContrat($_GET['id']);

$user= new DaoUtilisateur();
$users = $user->getAllSalarie();
$dir = 'C:\xampp\htdocs\Nouveau dossier\M2L\doc_bulletin';
$scandir = array();
$scandir = scandir($dir,1);

$fichiers = array();
foreach($scandir as $f){
    array_push($fichiers,$f);
}



$formulaireBulletin = new Formulaire('post','index.php','ajoutBulletin','ajoutBulletin');

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerTitre("Ajouter un bulletin"));
$formulaireBulletin->ajouterComposantTab();

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Mois"));

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputTexte("mois", "mois", 0, 1, '', null));
$formulaireBulletin->ajouterComposantTab();

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Année"));

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputTexte("annee", "annee", 0, 1, '', null));
$formulaireBulletin->ajouterComposantTab();


$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Choisir un bulletin :"));
$formulaireBulletin->ajouterComposantTab();

$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerSelect("pdf", "pdf","pdf", $fichiers));
$formulaireBulletin->ajouterComposantTab();



$formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputSubmit('ajoutBulletin','ajoutBulletin',"Créer un contrat"));
$formulaireBulletin->ajouterComposantTab();



$formulaireBulletin->creerFormulaire();


if(isset($_GET['action'])) {
    if ($_GET['action'] === "suppBulletin") {
        $bulletin = new DaoBulletin();
        $bulletin->suppBulletin($_GET['id']);

    } else if ($_GET['action'] === "modifBulletin") {

        $bulletin = new DaoBulletin();
        $bulletin->majBulletin($_GET['id']);

        $bulletin = new DaoBulletin();
        $bull = $bulletin->getUnBulletin(htmlspecialchars($_GET['id']));

        $formulaireBulletin = new Formulaire('post', 'index.php', 'modifBulletin', 'modifBulletin');

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerTitre("Modifier un Bulletin"));
        $formulaireBulletin->ajouterComposantTab();

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Mois"));

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputTexte("mois", "mois", $bull->getMoisBull(), 1, '', null));
        $formulaireBulletin->ajouterComposantTab();

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Année"));

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputTexte("annee", "annee", $bull->getAnneeBull(), 1, '', null));
        $formulaireBulletin->ajouterComposantTab();


        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerLabel("Choisir un bulletin :"));
        $formulaireBulletin->ajouterComposantTab();

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerSelect("pdf", "pdf","pdf", $fichiers));
        $formulaireBulletin->ajouterComposantTab();

        $formulaireBulletin->ajouterComposantLigne($formulaireBulletin->creerInputSubmit('modifBulletin','modifBulletin',"Modifier un Bulletin"));
        $formulaireBulletin->ajouterComposantTab();


        $formulaireBulletin->creerFormulaire();

    }

}

require_once("vue/vueBulletinRh.php");
