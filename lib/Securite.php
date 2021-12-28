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
     * Permet de voir si l'utilisateur est connecté et si il est bien celui qu'il prétend être 
     * On vérifie donc : Le token / L'IP de l'user / L'agent de l'user
     * 
     * @param dtoUtilisateur $user 
     * @return bool 
     */
    public function isLoged(dtoUtilisateur $user) : bool {
        return !empty($_SESSION['user']['token']) && $_SESSION['user']['token'] == $user->getToken() && $_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR'] && $_SESSION['user']['agent'] == $_SERVER['USER_AGENT'] ? true : false;
    }


    /**
     * Fonction principale anti brute force - limite le nombre de connexion 
     * 
     * @return void
     */
    public static function antiBruteForce() : void {
        if(isset($_SESSION['antb']) && !empty($_SESSION['antb'])) {
            $ant = intval($_SESSION['antb']);

            // On vérifie la valeur des tentatives et on agit en conséquence (la partie neg c'est une sécurité supplémentaire)
            if($ant < 0 || $ant >= 3) { 
                self::ban($_SERVER['REMOTE_ADDR'], "Tentative de brute force");
            } else {
                $_SESSION['antb'] = $ant + 1;
            }
        } else {
            // Si l'utilisateur à touché au var de session
            self::ban($_SERVER['REMOTE_ADDR'], "Tentative de brute force");
        }
    }

    /**
     * Fonction bannant une personne 
     * 
     */
    public static function ban($ip, $raison) : void {
        try {
            $raison = SELF::nettoyage($raison);
            DaoBan::add($ip, $raison);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de voir si un utilisateur est bannis
     * 
     * @param $ip - ip personne
     * @return bool - true si bannis
     */
    public static function isBaned($ip): bool {
       $ip = DaoBan::getOne($ip);

       if(is_bool($ip)) {
            return false;
       } else { 
           return true;
       }
    }



}