<?php

// Class dao -> Actions sur l'objet utilisateurs (crud)

class DaoUtilisateur {

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }


    /**
     * Permet de récupérer un utilisateur grâce à son ID ou null s'il n'existe pas
     *
     * @param int $id
     * @return DtoUtilisateur|null - Un utilisateur ou null|null
     */
    public function getOneOrNull(int $id) : ?DtoUtilisateur {

        // On récupère avec l'user avec une requête SQL
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE idUser = ?');
        $req->execute(array($id));

        // On fetch en objet si possible sinon, on renvoie null
        try {
           
            $req->setFetchMode(PDO::FETCH_CLASS, 'DtoUtilisateur');
            $data = $req->fetch();
          //  $_SESSION['util'] = $data;
         
            $reqClub = $this->db->prepare('SELECT nomClub FROM IdClub as c INNER JOIN utilisateur AS u ON c.idClub = u.idClub WHERE idUser = ?');
            $reqClub->execute(array($id));
            $club = $reqClub->fetch();
            $data->setClub($club['nomClub']);
    
            $reqLigue = $this->db->prepare('SELECT nomLigue FROM ligue as l INNER JOIN utilisateur AS u ON l.idLigue = u.idLigue WHERE idUser = ?');
            $reqLigue->execute(array($id));
            $ligue = $reqLigue->fetch();
            $data->setLigue($ligue['nomLigue']);

            $reqFonction = $this->db->prepare('SELECT libelle FROM fonction as F INNER JOIN utilisateur AS u ON F.idFonct = u.idFonct WHERE idUser = ?');
            $reqFonction->execute(array($id));
            $fonction = $reqFonction->fetch();
            $data->setFonction($fonction['libelle']);
            $_SESSION['util'] = $data;

            return $data;

        } catch (Exception $e) {
            return null;
        }

       
    }


       /**
     * Permet de récupérer des infos sur un utilisateur à partir du token (infos simples)
     * 
     * @param string $token
     * @return DtoUtilisateur|null - s'il trouve 
     */
    public function getOneByToken(string $token) : ?DtoUtilisateur {
        $req = $this->db->prepare('SELECT nom FROM utilisateur WHERE token = ?');
        $req->execute(array($token));
        $data = $req->fetch();

        $user = new DtoUtilisateur();
        $user->setNom($data['nom']);
        return $user;
    }


    /**
     * Permet de récupérer la liste des utilisateurs ou null si elle ne contient rien
     *
     * @return []dtoUtilisateur|null - Un utilisateur ou null
     */
    public function getAllOrNull() : ?array {
        // On récupère la liste
        $req = $this->db->prepare('SELECT * FROM utilisateur');
        $req->execute();

        // On récupère si possible
        try {
            $full = $req->fetchAll(PDO::FETCH_CLASS, 'DtoUtilisateur');
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }


    /**
     * Permet de créer un utilisateur dans la base de données
     *
     * @param DtoUtilisateur|null - Un utilisateur ou null $user
     * @return void
     */
    public function create(DtoUtilisateur $user) : void {

    }

    /**
     * Permet de modifier un utilisateur dans la base de données
     *
     * @param DtoUtilisateur|null - Un utilisateur ou null
     * @return bool
     */
    public function update(DtoUtilisateur $user) : bool {
        return true;
    }


    /**
     * Permet de supprimer un utilisateur en se basant sur son id
     *
     * @param int $id l'id bdd
     * @return bool action true¬false sur execution
     */
    public function delete(int $id) : bool {
        return true;
    }


    /**
     * Méthode permettant de se déconnecter 
     * 
     * @return void 
     */
    public function deconnexion() {
        $_SESSION = [];
        session_destroy();
    }

 

    /**
     * Méthode permettant à un utilisateur de s'identifier
     *
     * @param string $login - Identifiant de connexion
     * @param string $mdp - Mot de passe
     * @return DtoUtilisateur|null - Un utilisateur ou null s'il ne trouve rien
     */
    public function login(string $login, string $mdp) : ?DtoUtilisateur {

        // On vérifie d'abord que l'id est dans la DB
        $req = $this->db->prepare("SELECT * FROM utilisateur WHERE login = ?");
        $req->execute(array($login));
        $data = $req->fetch();

        if(!isset($data['idUser']) && $data['idUser'] == null ) {
            return null;
        } else {

            // Sinon, on récupère les infos et le mdp
            $user = $this->getOneOrNull(intval($data['idUser']));


            if(password_verify($mdp, $user->getMdp())) {
                // Créer nos sessions et return
                $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['AGENT'] = $_SERVER['HTTP_USER_AGENT'];

                if(!isset($_SESSION['user'])) {
                    $_SESSION['user'] = ['id' => $user->getIdUSer(),'agent' => $_SERVER['HTTP_USER_AGENT'], 'ip' => $_SERVER["REMOTE_ADDR"], 'token' => $user->getToken(), 'nom' => $user->getNom(), 'prenom' => $user->getPrenom(), 'fonction' => $user->getFonction()];
                }

                return $user;
            } else {
                return null;
            }

         }

    }
}

