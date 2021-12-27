<?php 

class DaoParticipation {

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    /**
     * Permet de récupérer toutes les infos d'une participation
     * 
     * @param int $idUser -> identifiant de 'user 
     * @param int $idForma -> formation identifiant
     * @return DtoParticipation|null un objet Participation ou R
     */
    public function getParticipation(int $idUser, int $idForma)  {
        try {
            $req = $this->db->prepare('SELECT * FROM PARTICPE WHERE idUser = ? AND idForma = ?');
            $req->execute(array($idUser, $idForma));
            $req->setFetchMode(PDO::FETCH_CLASS, 'DtoParticipation');
            $forma = $req->fetch();
            return $forma;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
  

    /**
     * Fonction pour mettre à jour des inscriptions au formation
     */
    public function update(DtoParticipation $forma) {
        try {
            $req = $this->db->prepare('UPDATE PARTICPE SET etat = ? WHERE idForma = ? AND idUser = ?');
            $req->execute(array($forma->getEtat(), $forma->getIdForma(), $forma->getIdUser())); 
        } catch (Exception $e) {
            die($e->getMessage());
        }   
    }

    /**
     * Fonction permettant de compter le nombre de demande accepte 
     * 
     * 
     */
    public function getCount($idForma) {
        try {
            $req = $this->db->prepare('SELECT count(idForma) FROM PARTICPE WHERE idForma = ? AND etat = "ACCEPTE"');
            $req->execute(array($idForma));
            $two = $req->fetch();
            return $two;
        } catch (Exception $e) {
            die($e->getMessage());
        }   
    }

}