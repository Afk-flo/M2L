<?php
require_once('dBConnex.php');
//require_once('../dto/dtoUtilisateur.php');
require_once('../dto/dtoUtilisateur.php');

// Class dao -> Actions sur l'objet utilisateurs (crud)

class daoUtilisateur {

    private $db;

    function __construct() {
        $this->db = DBConnex::getInstance();
    }


    /**
     * Permet de récupérer un utilisateur grâce à son ID ou null s'il n'existe pas
     *
     * @param int $id
     * @return dtoUtilisateur|null - Un utilisateur ou null|null
     */
    public function getOneOrNull(int $id) : ?dtoUtilisateur {

        // On récupère avec l'user avec une requête SQL
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE idUser = ?');
        $req->execute(array($id));

        // On fetch en objet si possible sinon, on renvoie null
        try {
           
            $req->setFetchMode(PDO::FETCH_CLASS, 'dtoUtilisateur');
            $data = $req->fetch();
            
            $reqClub = $this->db->prepare('SELECT nomClub FROM IdClub as c INNER JOIN utilisateur AS u ON c.idClub = u.idClub WHERE idUser = ?');
            $reqClub->execute(array($id));
    
            $data->setClub($reqClub);
    
            $reqLigue = $this->db->prepare('SELECT nomLigue FROM ligue as l INNER JOIN utilisateur AS u ON l.idLigue = u.idLigue WHERE idUser = ?');
            $reqLigue->execute(array($id));
    
            $data->setLigue($reqLigue);

            return $data;

        } catch (Exception $e) {
            return null;
        }

       
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
            $full = $req->fetchAll(PDO::FETCH_CLASS, 'dtoUtilisateur');
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }


    /**
     * Permet de créer un utilisateur dans la base de données
     *
     * @param dtoUtilisateur|null - Un utilisateur ou null $user
     * @return void
     */
    public function create(dtoUtilisateur $user) : void {

    }

    /**
     * Permet de modifier un utilisateur dans la base de données
     *
     * @param dtoUtilisateur|null - Un utilisateur ou null
     * @return bool
     */
    public function update(dtoUtilisateur $user) : bool {
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
     * Permet de savoir si une donnée est dans un champ (si la row ne retourne pas 0)
     *
     * @param string $data - Donnée du Where
     * @param string $champ - Le champ à selectionner
     * @param string $table - La table requise
     * @return bool - True si dans une ligne / False sinon
     */
    public function isInRow(string $data, string $champ = "*", string $table) : bool {
        $req = $this->db->prepare("SELECT $champ FROM $table WHERE $data = ?");
        $req->execute(array($champ, $table, $data));
        $req->fetchAll();
        if($req->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Méthode permettant à un utilisateur de s'identifier
     *
     * @param string $login - Identifiant de connexion
     * @param string $mdp - Mot de passe
     * @return dtoUtilisateur|null - Un utilisateur ou null s'il ne trouve rien
     */
    public function login(string $login, string $mdp) : ?dtoUtilisateur {

        // On vérifie d'abord que l'id est dans la DB
        $req = $this->db->prepare("SELECT * FROM utilisateur WHERE login = ?");
        $req->execute(array($login));
        $data = $req->fetch();

        if(!isset($data['idUser']) && $data['idUser'] == null ) {
            Header('Location: ../?error=log');

        } else {

            // Sinon, on récupère les infos et le mdp
            $user = $this->getOneOrNull(intval($data['idUser']));


            if(password_verify($mdp, $user->getMdp())) {
                // Créer nos sessions et return
                $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['AGENT'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['TOKEN'] = $user->getToken();

                return $user;
            } else {
                Header('Location: ../?error=log2');
            }

         }

    }
}

