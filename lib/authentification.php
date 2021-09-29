<?php
session_start();

/* récupérer les login et mdp
    et vérifier si ils sont valables
 */

/* Class authentification :
    - Login pour User
    - Inscription pour User
*/

require_once('../modele/dao/daoUtilisateur.php');
require_once('../modele/dao/dBConnex.php');


class authentification {

    private $db;

    function __construct() {
        $this->db = DBConnex::getInstance();
    }


    public function isInRow(string $data, string $champ, string $table) : bool {
        $req = $this->db->prepare("SELECT $champ FROM $table WHERE $data = ?");
        $req->execute(array($champ, $table, $data));
        $req->fetchAll();
        if($req->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }


    public function login(string $login, string $mdp) : ?dtoUtilisateur {
        // 3 étapes 
        // On check le login dans la db
        // on check le pass avec chiffrement 
        // On créer un objet qu'on return 

        // On vérifie d'abord que l'id est dans la DB 
        if(!$this->isInRow($login, "login", "utilisateur")) {
            Header('Location: ../?error=log');

        } else {
            // Sinon, on récupère les infos et le mdp 
            $user = new daoUtilisateur();
            $user = $user->getOneOrNull($login);

            if(password_verify($mdp, $user->getMdp())) {
                // Créer nos sessions et return 
                $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['AGENT'] = $_SERVER['USER_AGENT'];
                $_SESSION['TOKEN'] = $user->getToken();
                
                return $user;
            } else {
                Header('Location: ../?error=log');
            }

        }


    }


}