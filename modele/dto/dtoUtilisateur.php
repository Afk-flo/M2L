<?php

class DtoUtilisateur{
    private string $idUser;
    private string $nom;
    private string $prenom;
    private string $login;
    private string $mdp;
    private string $fonction;
    private string $token;
    private string $club;
    private string $ligue;


    //création des accesseurs getteurs et setteurs pour créer chaque utilisateur
    //pour les données de la table Utilisateur

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
    public function setPrenom($prenom){
        $this->prenom=$prenom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setLogin($login){
        $this->login=$login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setMdp($mdp){
        $this->mdp=$mdp;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }


    public function getIdUser(): string
    {
        return $this->idUser;
    }

    public function getFonction(): string
    {
        return $this->fonction;
    }

    public function setFonction($role){
        $this->fonction=$role;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token=$token;
    }

    public function getClub()
    {
        return $this->club;
    }
    public function setClub($club)
    {
        $this->club = $club;
    }

    public function getLigue(){
        return $this->ligue;
    }

    public function setLigue($ligue)
    {
        $this->ligue=$ligue;
    }


}

?>
