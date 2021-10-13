<?php 
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
     * @return dtoUtilisateur|null 
     */
    public function getOneOrNull(int $id = null, string $login = null) : ?dtoUtilisateur {

        if($id) {
        // On récupère avec l'user avec une requête SQL 
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE idUser = ?');
        $req->execute(array($id));

        } else if($login) {
        $req = $this->db->prepare('SELECT * FROM utilisateur WHERE login = ?');
        $req->execute(array($login));
        } else {
            // Si les deux sont null - hmmm 
            Header('Location : ../error=log');
        }
        
        
        // On fetch en objet si possible sinon, on renvoie null 
        try {
            $user = new dtoUtilisateur();
            $req->setFetchMode(PDO::FETCH_CLASS, get_class($user));
            $data = $req->fetch();
            return $data;

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Permet de récupérer la liste des utilisateurs ou null si elle ne contient rien
     * 
     * @return []dtoUtilisateur 
     */
    public function getAllOrNull() : ?dtoUtilisateur {
        // On récupère la liste 
        $req = $this->db->prepare('SELECT * FROM utilisateur');
        $req->execute();

        // On récupère si possible 
        try {
            $user = new dtoUtilisateur();
            $full = $req->fetchAll(PDO::FETCH_CLASS, get_class($user));
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }


    /**
     * Permet de créer un utilisateur dans la base de données 
     * 
     * @param dtoUtilisateur $user
     * @return void 
     */
    public function create(dtoUtilisateur $user) : void {

    }

    /**
     * Permet de modifier un utilisateur dans la base de données
     * 
     * @param dtoUtilisateur
     * @return bool
     */
    public function update(dtoUtilisateur $user) : bool {
        return true;
    }


    /**
     * Permet de supprimer un utilisateur en se basant sur son id 
     * 
     * @param id l'id bdd 
     * @return bool action true¬false sur execution 
     */
    public function delete(int $id) : bool {
        return true;
    }



}