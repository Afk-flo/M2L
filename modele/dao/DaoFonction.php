<?php

class DaoFonction {
    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    public function getFonctions() {
        // On récupère la liste
        $req = $this->db->prepare('SELECT * FROM fonction');
        $req->execute();

        // On récupère si possible
        try {
            $full = $req->fetchAll(PDO::FETCH_CLASS, 'dtoFonction');
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }

}