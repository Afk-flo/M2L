<?php

class DaoClub{
    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    public function getClubs() {
        // On récupère la liste
        $req = $this->db->prepare('SELECT * FROM IdClub');
        $req->execute();

        // On récupère si possible
        try {
            $full = $req->fetchAll(PDO::FETCH_CLASS, 'DtoClub');
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }
}