<?php 

class Securite {

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

    /**
     * Fonction permettant de savoir si un utilisateur est authentifié ET si c'est le bon utilsiateur 
     * 
     * @return bool true|fasle - selon 
     */
    public static function isLogged() {
        // vérification login
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            // Vérification d'identitié 
            // 1 - IP
            $ip = $_SESSION['user']['ip'];
            if(filter_var($ip, FILTER_VALIDATE_IP)) {
                // Si l'ip ne correspond pas à celle enregistré 
                if($ip != $_SERVER["REMOTE_ADDR"]) {
                    return false;
                }
            }

            // 2 - USER AGENT 
            $agent = $_SESSION['user']['agent'];
            

        }
        else {
            return false;
        }
    }




}