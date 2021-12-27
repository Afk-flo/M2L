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
     * Permet de récupérer toutes les formations de la base de données
     * 
     * @return DtoFormation[] _> array de dtoFormation 
     */
    public function getAllorNull() : ?array {
        $req = $this->db->prepare('SELECT * FROM idForma');
        $req->execute();
        try {
            $all = $req->fetchAll(PDO::FETCH_CLASS, 'DtoFormation');
            return $all;
        } catch(Exception $e) {
            return null;
        }
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
            $req->setFetchMode(PDO::FETCH_CLASS, 'DtoFormation');
            $one = $req->fetch();
            return $one;
        } catch(Exception $e) {
            return null;
        }
    }

    /**
     * Met à jour dans la base de données la formation choisie
     * 
     * @param DtoFormation $formation
     * @return void 
     */
    public function update(DtoFormation $formation) : void {
        try {
            $req = $this->db->prepare('UPDATE idForma SET intitule = ?, descriptif = ?, dateOuvertureInscriptions = ?, 	dateClotureInscriptions = ?, nombreMax = ?, DateDebut = ? WHERE idForma = ?');
            $req->execute(array($formation->getIntitule(), $formation->getDescriptif(), $formation->getDateOuvertureInscription(), $formation->getDateFinInscription(), $formation->getNombreMax(), $formation->getDateDebut(), $formation->getIdFormation()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de créer une formation dans la base de données 
     * 
     * @param dtoFormation $formation - Un objet formation pour l'envoie en BDD
     * @return bool true|false - selon la bonne exécution 
     */
    public function create(dtoFormation $formation) : bool {
        try {
            $req = $this->db->prepare('INSERT INTO idForma (intitule, descriptif, dateOuvertureInscriptions, dateClotureInscriptions, nombreMax, nombreFinal, idResponsable) VALUES (?,?,?,?,?,?,?)');
            $req->execute(array($formation->getIntitule(), $formation->getDescriptif(), $formation->getDateOuvertureInscription(), $formation->getDateFinInscription(), $formation->getNombreMax(), '-1' , $formation->getResponsable()));
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
            $req = $this->db->prepare('DELETE FROM idForma WHERE idForma = ?');
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
            $util = $req->fetchAll(); 
           
            $users = array();

            foreach($util as $util) {
                $user = new DaoUtilisateur();
                $user = $user->getOneOrNull($util["idUser"]);
                array_push($users, $user);
            }
            return $users;
        } catch (Exception $e) {
            return false;
        }  
    }



 }

