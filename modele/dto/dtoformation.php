<?php

class DtoFormation {


    private $idForma;
    private $intitule;
    private $descriptif;
    private $duree;
    private $dateOuvertureInscriptions;
    private $dateClotureInscriptions;
    private $nombreMax;
    private $nombreFinal;
    private $idResponsable;
    private $Couleur;
    private $DateDebut;
    private $Etat;

    public function setCouleur($data) {
        $this->Couleur = $data;
    }

    public function setDateDebut($data) {
        $this->DateDebut = $data;
    }

    public function setEtat($data) {
        $this->Etat = $data;
    }

    public function getCouleur() {
        return $this->Couleur;
    }

    public function getDateDebut() {
        return $this->DateDebut;
    }

    public function getEtat() {
        return $this->Etat;
    }

    public function setIdResponsable($data) {
        $this->idResponsable = $data;
    }

    public function setNombreFinal($data) {
        $this->nombreFinal = $data;
    }

    public function setNombreMax($data) {
        $this->nombreMax = $data;
    }

    public function setDateClotureInscription($data) {
        $this->dateClotureInscriptions = $data;
    }

    public function setDateOuvertureInscription($data) {
        $this->dateOuvertureInscriptions = $data;
    }

    public function setDuree($data) {
        $this->duree = $data;
    }

    public function setDescriptif($data) {
        $this->descriptif = $data;
    }

    public function setIntituel($data) {
        $this->intitule = $data;
    }

    public function setIdForma($data) {
        $this->idForma = $data;
    }

    public function getResponsable() {
        return $this->idResponsable;
    }

    public function getNombreMax() {
        return $this->nombreMax;
    }

    public function getNombreFinal() {
        return $this->nombreFinal;
    }

    public function getDateOuvertureInscription() {
        return $this->dateOuvertureInscriptions;
    }

    public function getDateFinInscription() {
        return $this->dateClotureInscriptions;
    }

    public function getDuree() {
        return $this->duree;
    }

    public function getDescriptif() {
        return $this->descriptif;
    }

    public function getIntitule() {
        return $this->intitule;
    }

    public function getIdFormation() {
        return $this->idForma;
    }


}