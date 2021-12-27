<?php 

class DtoParticipation {
    private $idForma;
    private $idUser;
    private $etat;
    private $dateInscription;

    public function setIdForma($data) {
        $this->idForma = $data;
    }

    public function setIdUser($data) {
        $this->idUser = $data;
    }

    public function setEtat($data) {
        $this->etat = $data;
    }

    public function setDateInscription($data){
        $this->dateInscription = $data;
    }

    public function getIdForma() {
        return $this->idForma;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getDateInscription() {
        return $this->dateInscription;
    }
}