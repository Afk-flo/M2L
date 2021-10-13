<?php

class dtoUtilisateur{
    private string $idUser;
    private string $nom;
    private string $prenom;
    private string $login;
    private string $mdp;
    private string $statut;
    private string $role;
    private string $token;


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

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut($statut){
        $this->statut=$statut;
    }

    public function getIdUSer(): string
    {
        return $this->idUSer;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole($role){
        $this->role=$role;
    }
    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token=$token;
    }

}

?>
