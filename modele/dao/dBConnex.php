<?php
class Param {
	public static $user = 'u433193930_ad';
	public static $pass = 'RGPD33/fr';
	public static $base = 'mysql:host=sql286.main-hosting.eu;dbname=u433193930_P2;charset=utf8';
}


class DBConnex extends PDO{
    
    private static $instance;
    
    public static function getInstance(){
        if ( !self::$instance ){
            self::$instance = new DBConnex();
        }
        return self::$instance;
    }
    
    private function __construct(){
        try {
            parent::__construct(Param::$base ,Param::$user, Param::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die("Impossible de se connecter. " );
        }
    }
    

}