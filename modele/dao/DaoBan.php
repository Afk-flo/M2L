<?php 

class DaoBan {


    /**
     * Fonction permettant d'ajouter un ban en bdd
     * 
     */
    public static function add($ip, string $raison) {
        try {
            $instance = DaoDBConnex::getInstance();
            $req = $instance->prepare('INSERT INTO ban VALUES (?,?)');
            $req->execute(array($ip, $raison));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    
    }

    /**
     * Fonction permettant de récupérer des données de db 
     * 
     */
    public static function getOne($ip) {
        try {
            $instance = DaoDBConnex::getInstance();
            $req = $instance->prepare('SELECT * FROM ban WHERE ip = ?');
            $req->execute(array($ip));
            $one = $req->fetch();
            return $one;
        }  catch (Exception $e) {
            die($e->getMessage());
        }
    }
}