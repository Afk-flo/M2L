<?php 

abstract class Securite {

    const BLACK_LIST = "<%/';";

    /**
     * Méthode de nettoyage des données, sécurise des entrées
     * 
     * @param mixed $data - la donnée à nettoyer
     * @return mixed $data - la donnée nettoyée
     */
    public static function nettoyage($data) {
        $data = htmlspecialchars($data);
        $data = str_replace(self::BLACK_LIST, ' ', $data);
        $data = trim($data);
        return $data;
    }


}