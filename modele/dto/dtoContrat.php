<?php

class dtoContrat {
    use Hydrate;
    private $idContrat;
    private $dateDebut;
    private $dateFin;
    private string $typeContrat;
    private int $nbHeures;
    private string $idUser;

    public function getIdContrat(){
        return $this->idContrat;
    }

    public function setIdContrat($idContrat){
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

    public function getNbHeures(){
        return $this->nbHeures;
    }

    public function setNbHeures($nbHeures){
        $this->nbHeures = $nbHeures;
    }

    public function setIdUser(string $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getIdUser(): string
    {
        return $this->idUser;
    }



}