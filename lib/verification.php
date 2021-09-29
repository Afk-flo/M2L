<?php 

/* VERIFICATION : 
    - Verficiation des rôles 
    - Verification que les personnes correspondent à qui elles prétendent être 
*/


class verification {

    /**
     * Permet de vérifier si la personne qui demande la page correspond au rôle 
     * 
     * @param array $demande qui permettra de choisir le ou les rôles pour une page
     * @return bool true si ça passe / false qui ne passe pas
     */
    public function access(dtoUtilisateur $user, array $demande) : bool {
        return in_array($user->getRole(), $demande);
    }

    /**
     * Permet de vérifier si la personne est admin 
     * 
     * @param dtoUtilisateur $user 
     * @return bool true si la personne est admi / false sinon 
     */
    public function isAdmin(dtoUtilisateur $user) : bool {
        return $user->getRole() == "ADMIN" ? true : false;
    }

    /**
     * Permet de voir si l'utilisateur est connecté et si il est bien celui qu'il prétend être 
     * On vérifie donc : Le token / L'IP de l'user / L'agent de l'user
     * 
     * @param dtoUtilisateur $user 
     * @return bool 
     */
    public function isLoged(dtoUtilisateur $user) : bool {
        return !empty($_SESSION['TOKEN']) && $_SESSION['TOKEN'] == $user->getToken() && $_SESSION['IP'] == $_SERVER['REMOTE_ADDR'] && $_SESSION['AGENT'] == $_SERVER['USER_AGENT'] ? true : false;
    }

    



}