<?php


if ($_SESSION['user']['fonction'] == "rh") {


    $gerant = new Menu("rh");

    $gerant->ajouterComposant($gerant->creerItemLien("accueil", "Accueil"));
    $gerant->ajouterComposant($gerant->creerItemLien("RhUsers", "Les utilisateurs"));
    $gerant->ajouterComposant($gerant->creerItemLien("contratsResp", "Les contrats"));
    $gerant->ajouterComposant($gerant->creerItemLien("deconnexion", "Se déconnecter"));

    $menuPrincipalM2L = $gerant->creerMenu('0', 'Rh');

    if (isset($_GET['Rh']) && !empty($_GET['Rh'])) {
        $target = Securite::nettoyage($_GET['Rh']);
        if ($target == "contratsResp") {
            require_once(dispatcher::dispatch('contratsResp'));
            die();
        } elseif ($target === "deconnexion") {
            $_SESSION['user'] = [];
            session_destroy();
            include_once dispatcher::dispatch('Accueil');
            die();
        }
        else if ($target == "bulletinRh"){
            require_once(dispatcher::dispatch('bulletinRh'));
        }
        elseif($target == "RhUsers"){
            require_once (dispatcher::dispatch('RhUSers'));
        }

    }

    if (isset($_POST['modifContrat'])) {
        //if (!empty($_POST['debutContrat']) && !empty($_POST['finContrat']) && !empty($_POST['nbrMax']) && !empty($_POST['debutIns']) && !empty($_POST['finIns']) && !empty($_POST['debutFor'])) {
            $dateDebut = Securite::nettoyage($_POST['debutContrat']);
            $dateFin = Securite::nettoyage($_POST['finContrat']);
            $nbHeures = Securite::nettoyage($_POST['nbHeures']);
            $typeContrat = Securite::nettoyage($_POST['typeContrat']);
            $salarie = Securite::nettoyage($_POST['user']);
            $idContrat = Securite::nettoyage($_SESSION['id']);


            $bulletin = new dtoContrat();
            $bulletin->setDateDebut($dateDebut);
            $bulletin->setDateFin($dateFin);
            $bulletin->setNbHeures($nbHeures);
            $bulletin->setTypeContrat($typeContrat);
            $bulletin->setIdUser($salarie);
            $bulletin->setIdContrat($idContrat);

            $action = new DaoContrat();
            $action->majContrat($bulletin);

            require_once (dispatcher::dispatch("contratsResp"));
            die();
        }
    }



    if (isset($_POST['ajoutContrat'])) {
        //if (!empty($_POST['debutContrat']) && !empty($_POST['finContrat']) && !empty($_POST['nbHeures'] && !empty($_POST['typeContrat']) && !empty($_POST['user']))) {
        $dateDebut = Securite::nettoyage($_POST['debutContrat']);
        $dateFn = Securite::nettoyage($_POST['finContrat']);
        $nbHeures = Securite::nettoyage($_POST['nbHeures']);
        $typeContrat = Securite::nettoyage($_POST['typeContrat']);
        $salarie = Securite::nettoyage($_POST['user']);

        $bulletin = new dtoContrat();
        $bulletin->setDateDebut($dateDebut);
        $bulletin->setDateFin($dateDebut);
        $bulletin->setNbHeures($nbHeures);
        $bulletin->setTypeContrat($typeContrat);
        $bulletin->setIdUser($salarie);


        $action = new DaoContrat();
        $action->ajoutContrat($bulletin);

        require_once (dispatcher::dispatch("contratsResp"));
        die();
    }


    if (isset($_POST['ajoutUser'])) {
        //if (!empty($_POST['debutContrat']) && !empty($_POST['finContrat']) && !empty($_POST['nbHeures'] && !empty($_POST['nbHeures']) && !empty($_POST['typeContrat']))&& !empty($_POST['user'])) {
        $nom = Securite::nettoyage($_POST['nom']);
        $prenom = Securite::nettoyage($_POST['prenom']);
        $login = Securite::nettoyage($_POST['login']);
        $mdp = Securite::nettoyage($_POST['mdp']);
        $fonction = Securite::nettoyage($_POST['fonction']);
        $club = Securite::nettoyage($_POST['club']);
        $ligue = Securite::nettoyage($_POST['ligue']);

        $user = new DtoUtilisateur();
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setLogin($login);
        $user->setMdp($mdp);
        $user->setFonction($fonction);
        $user->setClub($club);
        $user->setLigue($ligue);
        $user->setFonction($fonction);

        $action = new DaoUtilisateur();
        $action->create($user);

        require_once (dispatcher::dispatch("RhUsers"));
        die();
    }

    if (isset($_POST['majUser'])) {
        //if (!empty($_POST['debutContrat']) && !empty($_POST['finContrat']) && !empty($_POST['nbHeures'] && !empty($_POST['nbHeures']) && !empty($_POST['typeContrat']))&& !empty($_POST['user'])) {
        $nom = Securite::nettoyage($_POST['nom']);
        $prenom = Securite::nettoyage($_POST['prenom']);
        $login = Securite::nettoyage($_POST['login']);
        $fonction = Securite::nettoyage($_POST['fonction']);
        $club = Securite::nettoyage($_POST['club']);
        $ligue = Securite::nettoyage($_POST['ligue']);
        $userMod = Securite::nettoyage($_POST['user']);

        $user = new DtoUtilisateur();
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setLogin($login);
        $user->setFonction($fonction);
        $user->setClub($club);
        $user->setLigue($ligue);
        $user->setIdUser($userMod);

        $action = new DaoUtilisateur();
        $action->update($user);

        require_once (dispatcher::dispatch("RhUsers"));
        die();
    }

    if(isset($_POST['creerBulletin'])){
        $mois = Securite::nettoyage($_POST['mois']);
        $annee = Securite::nettoyage($_POST['annee']);
        $bulletinPDF = Securite::nettoyage($_POST['bulletinPDF']);
        $idContrat = Securite::nettoyage($_POST['idContrat']);


        $bulletin = new dtoBulletin();
        $bulletin->setMoisBull($mois);
        $bulletin->setAnneeBull($annee);
        $bulletin->setBulletinpdf($bulletinPDF);
        $bulletin->setIdContrat($idContrat);

        $action = new DaoBulletin();
        $action->creerBulletin($bulletin);

        require_once (dispatcher::dispatch("BulletinRh"));
        die();
    }

    if(isset($_POST['modifBulletin'])){
        $mois = Securite::nettoyage($_POST['mois']);
        $annee = Securite::nettoyage($_POST['annee']);
        $bulletinPDF = Securite::nettoyage($_POST['bulletinPDF']);


        $bulletin = new dtoBulletin();
        $bulletin->setMoisBull($mois);
        $bulletin->setAnneeBull($annee);
        $bulletin->setBulletinpdf($bulletinPDF);

        $action = new DaoBulletin();
        $action->majBulletin($bulletin);

        require_once (dispatcher::dispatch("BulletinRh"));
        die();
    }
    if(($_SESSION['identification']['page'] = 'accueilRh')){
    $fonction = new DaoFonction();
    $fonctions = $fonction->getFonctions();

    $ligue = new DaoLigue();
    $ligues = $ligue->getLigues();

    $club = new DaoClub();
    $clubs = $club->getClubs();


    $utilisateur = new DaoUtilisateur();
    $user1 = $utilisateur->getOneOrNull(htmlspecialchars($_SESSION['user']['id']));
    $formulaireContrat = new Formulaire('post', 'index.php', 'majUser', 'majUser');

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerTitre("Modifier un utilisateur"));
    $formulaireContrat->ajouterComposantTab();

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Nom : "));

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("nom", "nom", $user1->getNom(), 1, '', null));
    $formulaireContrat->ajouterComposantTab();

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Prénom : "));

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("prenom", "prenom", $user1->getPrenom(), 1, '', null));
    $formulaireContrat->ajouterComposantTab();

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Login : "));

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputTexte("login", "login", $user1->getLogin(), 1, '', null));
    $formulaireContrat->ajouterComposantTab();


    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Fonction : "));


    foreach ($fonctions as $fonctions) {
        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("fonction", $fonctions->getLibelle(), $fonctions->getidFonct(), $fonctions->getidFonct()));
        $formulaireContrat->ajouterComposantTab();
    }

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Ligue : "));

    foreach ($ligues as $ligues) {
        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("ligue", $ligues->getNomLigue(), $ligues->getIdLigue(), $ligues->getIdLigue()));
        $formulaireContrat->ajouterComposantTab();
    }

    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerLabel("Club : "));

    foreach ($clubs as $clubs) {
        $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerRadio("club", $clubs->getNomClub(), $clubs->getIdClub(), $clubs->getIdClub()));
        $formulaireContrat->ajouterComposantTab();
    }


    $formulaireContrat->ajouterComposantLigne($formulaireContrat->creerInputSubmit('majUser', 'majUser', "Modifier un utilisateur"));
    $formulaireContrat->ajouterComposantTab();


    $formulaireContrat->creerFormulaire();
require_once("vue/vueGerantRH.php");

}




