<?php

$user = new DaoUtilisateur();
$users = $user->getAllOrNull();


$fonction = new DaoFonction();
$fonctions = $fonction->getFonctions();

$ligue = new DaoLigue();
$ligues = $ligue->getLigues();

$club = new DaoClub();
$clubs = $club->getClubs();




$formulaireContrat = new Formulaire('post','index.php','ajoutUser','ajoutUser');

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Créer un utilisateur"));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Nom : "));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("nom", "nom", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Prénom : "));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("prenom", "prenom", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Login : "));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("login", "login", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Mot de passe : "));

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputMdp("mdp", "mdp", 0, 1, '', null));
$formulaireContrat->ajouterComposantTab();


$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Fonction : "));
$formulaireContrat->ajouterComposantTab();


foreach($fonctions as $fonctions){
    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("fonction", $fonctions->getLibelle(),  $fonctions->getidFonct(), $fonctions->getidFonct()));
    $formulaireContrat->ajouterComposantTab();
}

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Ligue : "));

foreach($ligues as $ligues){
    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("ligue", $ligues->getNomLigue(),  $ligues->getIdLigue(), $ligues->getIdLigue()));
    $formulaireContrat->ajouterComposantTab();
}

$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Club : "));

foreach($clubs as $clubs){
    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("club", $clubs->getNomClub(),  $clubs->getIdClub(), $clubs->getIdClub()));
    $formulaireContrat->ajouterComposantTab();
}


$formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('ajoutUser','ajoutUser',"Créer un utilisateur"));
$formulaireContrat->ajouterComposantTab();


$formulaireContrat->creerFormulaire();


if(isset($_GET['id']) && isset($_GET['action'])) {
    if ($_GET['action'] === "deleteUser") {
        $user = new DaoUtilisateur();
        $user->delete(htmlspecialchars($_GET['id']));

    } else if ($_GET['action'] === "majUser") {

        $fonction = new DaoFonction();
        $fonctions = $fonction->getFonctions();

        $ligue = new DaoLigue();
        $ligues = $ligue->getLigues();

        $club = new DaoClub();
        $clubs = $club->getClubs();


        $utilisateur = new DaoUtilisateur();
        $user = $utilisateur->getOneOrNull(htmlspecialchars($_GET['id']));

        $formulaireContrat = new Formulaire('post', 'index.php', 'majUser', 'majUser');

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Modifier un utilisateur"));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Nom : "));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("nom", "nom", $user->getNom(), 1, '', null));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Prénom : "));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("prenom", "prenom", $user->getPrenom(), 1, '', null));
        $formulaireContrat->ajouterComposantTab();

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Login : "));

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("login", "login", $user->getLogin(), 1, '', null));
        $formulaireContrat->ajouterComposantTab();



        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Fonction : "));



        foreach($fonctions as $fonctions){
            $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("fonction", $fonctions->getLibelle(),  $fonctions->getidFonct(), $fonctions->getidFonct()));
            $formulaireContrat->ajouterComposantTab();
        }

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Ligue : "));

        foreach($ligues as $ligues){
            $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("ligue", $ligues->getNomLigue(),  $ligues->getIdLigue(), $ligues->getIdLigue()));
            $formulaireContrat->ajouterComposantTab();
        }

        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Club : "));

        foreach($clubs as $clubs){
            $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("club", $clubs->getNomClub(),  $clubs->getIdClub(), $clubs->getIdClub()));
            $formulaireContrat->ajouterComposantTab();
        }



        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('majUser','majUser',"Modifier un utilisateur"));
        $formulaireContrat->ajouterComposantTab();


        $formulaireContrat->creerFormulaire();

    }
}

require_once("vue/vueRhUsers.php");
