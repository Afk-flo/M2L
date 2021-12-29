<?php

class dtoBulletin{
    private $idBulletin;
    private $mois;
    private $annee;
    private $bulletinPDF;
    
    public function getIdBulletin(){
        return $this->idBulletin;
    }

    public function getMoisBull(){
        return $this->mois;
    }

    public function setMoisBull($mois){
        $this->mois = $mois;
    }

    public function getAnneeBull(){
        return $this->annee;
    }

    public function setAnneeBull($annee){
        $this->annee=$annee;
    }

    //get et set de liens pour les PDF donc des contrats

    public function getBulletinPDF(){
        return $this->bulletinPDF;
    }

    public function setBulletinpdf($bulletinPDF){
         $this->bulletinPDF = $bulletinPDF;
    }




}