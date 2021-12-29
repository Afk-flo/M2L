<?php



class DaoBulletin{

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    public function getOneBulletin($idBulletin) {
        $req = $this->db->prepare('SELECT * FROM bulletin WHERE idBulletin = ?');
        $req->execute(array($idBulletin));

        try{
            $req->setFetchMode(PDO::FETCH_CLASS,'DtoBulletin');
            $data = $req->fetch();

            $reqContrat = $this->db->prepare('SELECT * FROM contrat AS C INNER JOIN bulletin AS B ON B.idContrat = C.idContrat WHERE idContrat = ?');
            $reqContrat->execute(array($idBulletin));

        }
        catch(Exception $e){
            return null;
        }
    }

}