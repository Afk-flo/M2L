<?php

class dtoFonction {
    private string $idFonct;
    private string $libelle;

    public function getidFonct(){
        return $this->idFonct;
    }

    public function setidFunct($idFonct){
        $this->idFonct = $idFonct;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function setLibelle($libelle){
        $this->libelle = $libelle;
    }


}