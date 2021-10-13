<?php


class DaoDBConnex extends PDO{
    
    private static $instance;
    
    public static function getInstance(){
        if ( !self::$instance ){
            self::$instance = new DBConnex();
        }
        return self::$instance;
    }
    
    private function __construct(){
        try {
            parent::__construct(DaoParam::$base ,DaoParam::$user, DaoParam::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die("Impossible de se connecter. " );
        }
    }
    

}