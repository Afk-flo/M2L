<?php 

/**
 * Class DaoFormation : 
 *  - Create - Créer une formation 
 *  - Update - Modifie une formation 
 *  - Delete - Supprime une formation 
 *  - GetOne - Permet de voir une formation 
 *  - getUtilisateurDemandeur - Permet d'avoir tous les utilisateurs demandant une formation 
 */

 class DaoFormation {

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    /**
     * Permet d'obtenir une formation depuis la base de données 
     * 
     * @param int $id - L'id de la formation
     * @return DtoFormation|null - Une formation ou null si rien 
     */
    public function getOne(int $id) : ?DtoFormation {
        $req = $this->db->prepare('SELECT * FROM idForma WHERE idForma = ?');
        $req->execute(array($id));

        try {
            $req->setFetchMode(PDO::FETCH_CLASS, 'DtoUtilisateur');
            $one = $req->fetch();
            return $one;
        } catch(Exception $e) {
            return null;
        }
    }

    /**
     * Permet de créer une formation dans la base de données 
     * 
     * @param DtoFormation $formation - Un objet formation pour l'envoie en BDD
     * @return bool true|false - selon la bonne exécution 
     */
    public function create(DtoFormation $formation) : bool {
        try {
            $req = $this->db->prepare('INSERT INTO idForma (intitule, descriptif, duree, dateOuvertureInscriptions, dateClotureInscriptions, nombreMax, nombreFinal, idResponsable) VALUES (?,?,?,?,?,?,?,?)');
            $req->execute(array($formation->getNomFormation(), $formation->getDescriptif(), $formation->getDuree(), $formation->getDateDepart(), $formation->getDateFin(), $formation->getEffectifMax(), $formation->getEffectifTotal(), $formation->getResponsable()));
            return true;
        } catch (Exception $e) {
            return false;
        }  
    }


    /**
     * Permet de supprimer une formation dans la base de données 
     * 
     * @param int $id - Id d'identification de la formation 
     * @return bool - true|false - Selon la bonne exécution 
     */
    public function delete(int $id) : bool {
        try {
            $req = $this->db->prepare('DELETE FROM idForma WHERE id = ?');
            $req->execute(array($id));
            return true;
        } catch (Exception $e) {
            return false;
        }  
    }

    /**
     * Permet d'obtenir tous les utilisateurs qui veulent s'inscrire à une formation 
     * 
     * @param int $id - Id d'identification de la formation
     * @return DtoUtilisateur[] - Array d'utilisateur Dto, tous les utilisateurs voulant la formation 
     */
    public function getUtilisateurDemandeur(int $id) : array {
        try {
            $req = $this->db->prepare('SELECT idUser FROM PARTICPE WHERE idForma = ?');
            $req->execute(array($id));
            $req->fetchAll(); 
            $users = array();

            foreach($req as $req) {
                $user = new DaoUtilisateur();
                array_push($users, $user->getOneOrNull($req));
            }

            return $users;
        } catch (Exception $e) {
            return false;
        }  
    }



 }

