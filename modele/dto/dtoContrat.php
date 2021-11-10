<?php

class dtoContrat {
    private string $idContrat;
    private DateTime $dateDebut;
    private DateTime $dateFin;
    private string $typeContrat;
    private int $nbHeures;

    public function getidContrat(){
        return $this->idContrat;
    }

    public function setidContrat($idContrat){
        $this->idContrat = $idContrat;
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function setDateDebut($dateDeb){
        $this->dateDebut = $dateDeb;
    }

    public function getDateFin(){
        return $this->dateFin;
    }

    public function setDateFin($dateFin){
         $this->dateFin = $dateFin;
    }

    public function getTypeContrat(){
        return $this->typeContrat;
    }

    public function setTypeContrat($typeContrat){
        $this->typeContrat = $typeContrat;
    }

    public function getnbHeures(){
        return $this->nbHeures;
    }

    public function setNbHeures($nbHeures){
        $this->nbHeures = $nbHeures;
    }


}