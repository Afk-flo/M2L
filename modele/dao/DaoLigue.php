<?php

class DaoLigue{

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    public function getLigues() {
        // On récupère la liste
        $req = $this->db->prepare('SELECT * FROM ligue');
        $req->execute();

        // On récupère si possible
        try {
            $full = $req->fetchAll(PDO::FETCH_CLASS, 'DtoLigue');
            return $full;

        } catch(Exception $e) {
            return null;
        }
    }
}
