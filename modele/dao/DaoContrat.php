<?php

class DaoContrat{
    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }


    //récupérer les contrats
    public function getContrats(){
        try{
            $resultat=[];
            $req =DaoDBConnex::getInstance()->prepare("SELECT * FROM contrat ");
            $req->execute();
            $liste=$req->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($liste)){
                foreach($liste as $contrat){
                    $unContrat = new dtoContrat();
                    $unContrat->hydrate($contrat);

                    $resultat[]=$unContrat;
                }
            }
            return $resultat;

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getContratsUser($idUser){

        $req = $this->db->prepare('SELECT * FROM contrat WHERE idUser = ?');
        $req->execute(array($idUser));

        try {
            $all = $req->fetchAll(PDO::FETCH_CLASS, 'dtoContrat');
            return $all;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getUnContrat($idContrat){
        try{
            $req = $this->db->prepare("SELECT * FROM contrat WHERE idContrat =? ");
            $req->execute(array($idContrat));
            $req->setFetchMode(PDO::FETCH_CLASS,"dtoContrat");
            $unContrat = $req->fetch();
            return $unContrat;
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function majContrat($unContrat){
        try{
            $req = $this->db->prepare("UPDATE contrat SET  dateDebut = ?, dateFin = ?, typeContrat = ?, nbHeures = ?, idUser = ? WHERE idContrat = ? ");
            $req->execute(array($unContrat->getDateDebut(),$unContrat->getDateFin(), $unContrat->getTypeContrat(), $unContrat->getNbHeures(), $unContrat->getIdUser(),$unContrat->getIdContrat()));
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function suppContrat($idContrat){
        try{
            $req = $this->db->prepare("DELETE FROM contrat WHERE idContrat =?");
            $req->execute(array($idContrat));
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function ajoutContrat($unContrat){
        try{
            $req = $this->db->prepare('INSERT INTO contrat (dateDebut, dateFin, typeContrat, nbHeures, idUser) VALUES (?,?,?,?,?)');
            $req->execute(array($unContrat->getDateDebut(), $unContrat->getDateFin(), $unContrat->getTypeContrat(), $unContrat->getNbHeures(), $unContrat->getIdUser()));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}