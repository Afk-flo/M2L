<?php

class dtoLigue{
    private $idLigue;
    private $nomLigue;
    private $site;
    private $descriptif;


    public function setIdLigue($idLigue): void
    {
        $this->idLigue = $idLigue;
    }

    public function getIdLigue()
    {
        return $this->idLigue;
    }

    public function getNomLigue()
    {
        return $this->nomLigue;
    }

    public function setNomLigue($nomLigue): void
    {
        $this->nomLigue = $nomLigue;
    }

    public function getSite()
    {
        return $this->site;
    }

    public function setSite($site): void
    {
        $this->site = $site;
    }

    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function setDescriptif($descriptif): void
    {
        $this->descriptif = $descriptif;
    }

}