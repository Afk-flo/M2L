<?php

class dtoClub{
    private $idClub;
    private $nomClub;
    private $adresseClub;
    private $idLigue;
    private $idCommune;

    public function getIdClub()
    {
        return $this->idClub;
    }

    public function setIdClub($idClub): void
    {
        $this->idClub = $idClub;
    }

    public function getNomClub()
    {
        return $this->nomClub;
    }

    public function setNomClub($nomClub): void
    {
        $this->nomClub = $nomClub;
    }

    public function getAdresseClub()
    {
        return $this->adresseClub;
    }

    public function setAdresseClub($adresseClub): void
    {
        $this->adresseClub = $adresseClub;
    }

    public function getIdLigue()
    {
        return $this->idLigue;
    }

    public function setIdLigue($idLigue): void
    {
        $this->idLigue = $idLigue;
    }
    public function getIdCommune()
    {
        return $this->idCommune;
    }

    public function setIdCommune($idCommune): void
    {
        $this->idCommune = $idCommune;
    }

}
