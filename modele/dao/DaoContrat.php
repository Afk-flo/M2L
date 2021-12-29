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
            $req = $this->db->prepare("SELECT * FROM CONTRAT");
            $req->execute();
            $liste=$req->setFetchAll(PDO::FETCH_ASSOC);
            if(!empty($liste)){
                foreach($liste as $bulletin){
                    $unBulletin = new BulletinDTO();
                    $unBulletin->getidContrat();
                    $unBulletin->getDateDebut();
                    $unBulletin->getDateFin();
                    $unBulletin->getTypeContrat();
                    $unBulletin->getnbHeures();
                    $unBulletin->getIdUser();
                    $resultat[]=$unBulletin;
                }
            }
            return $resultat;

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

    public function updateContrat($unContrat){

    }
}