<?php

class DTOUtilisateur{
    private $idUSer;
    private $nom;
    private $prenom;
    private $login;
    private $mdp;
    private $statut;
    private $typeUSer;


    //création des accesseurs getteurs et setteurs pour créer chaque utilisateur
    //pour les données de la table Utilisateur
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setPrenom($prenom){
        $this->prenom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setLogin($login){
        $this->login;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setMdp($mdp){
        $this->mdp;
    }

    public function getMdp(){
        return $this->mdp;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function setStatut($statut){
        $this->statut;
    }

    public function getTypeUser(){
        return $this->typeUSer;
    }

    public function setTypeUser($typeUser){
        $this->typeUSer;
    }


    public function getIdUSer()
    {
        return $this->idUSer;
    }
}

?>
