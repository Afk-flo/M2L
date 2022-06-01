<?php

$bulletin = new DaoBulletin();
$bulletins=$bulletin->getBulletinsContrat($_GET['id']);

$user= new DaoUtilisateur();
$users = $user->getAllSalarie();
$dir = 'C:\xampp\htdocs\Nouveau dossier\M2L\doc_bulletin';
$scandir = array();
$scandir = scandir($dir,1);
var_dump($scandir);
$formulaireContrat = new Formulaire('post','index.php','ajoutBulletin','ajoutBulletin');

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Ajouter un bulletin"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Mois"));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("mois", "mois", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Année"));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("annee", "annee", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();


$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Choisir un bulletin :"));
$formulaireContrat->ajouterComposantTab();



$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerSelect("pdf", "pdf","pdf", "<?php foreach ($scandir as $f) { echo $f; } ?>"));
$formulaireContrat->ajouterComposantTab();



$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('ajoutBulletin','ajoutBulletin',"Créer un contrat"));
$formulaireContrat->ajouterComposantTab();



$formulaireContrat->creerFormulaire();


if(isset($_GET['action'])) {
    if ($_GET['action'] === "suppBulletin") {
        $bulletin = new DaoBulletin();
        $bulletin->suppBulletin($_GET['id']);

    } else if ($_GET['action'] === "modifBulletin") {

        $bulletin = new DaoBulletin();
        $bulletin->suppBulletin($_GET['id']);

        $bulletin = new DaoContrat();
        $bull = $bulletin->getUnContrat(htmlspecialchars($_GET['id']));

        $formulaireContrat = new Formulaire('post', 'index.php', 'modifBulletin', 'modifBulletin');

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Modifier un Bulletin"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Mois"));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("mois", "mois", 0, 1, '', null));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Année"));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("annee", "annee", 0, 1, '', null));
        $formulaireContrat->ajouterComposantTab();


        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Choisir un bulletin :"));
        $formulaireContrat->ajouterComposantTab();

        foreach($scandir as $fichier){
            $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerSelect("pdf", "pdf","pdf","/doc_bulletin/"));
            $formulaireContrat->ajouterComposantTab();
        }



        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('modifBulletin','modifBulletin',"Modifier un Bulletin"));
        $formulaireContrat->ajouterComposantTab();


        $formulaireContrat->creerFormulaire();

    }
}

require_once("vue/vueBulletinRh.php");
