<?php



class DaoBulletin{

    private $db;

    function __construct() {
        $this->db = DaoDBConnex::getInstance();
    }

    public function getBulletinsContrat($idContrat){
        try{
            $req = $this->db->prepare('SELECT * FROM bulletin WHERE idContrat = ?');
            $req->execute(array($idContrat));
            $all = $req->fetchAll(PDO::FETCH_CLASS,'dtoBulletin');
            return $all;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getUnBulletin($idBulletin){
        try{
            $req = $this->db->prepare("SELECT * FROM bulletin WHERE idBulletin =?");
            $req->execute(array($idBulletin));
            $req->setFetchMode(PDO::FETCH_CLASS,"dtoBulletin");
            $unBulletin = $req->fetch();
            return $unBulletin;
        }
        catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function majBulletin($unBulletin){
        try{
            $unBulletin = new DtoBulletin();
            $req = $this->db->prepare("UPDATE bulletin SET  mois = ?, annee = ?, bulletinPDF = ?, idContrat = ? WHERE idBulletin = ? ");
            $req->execute(array($unBulletin->getMoisBull(),$unBulletin->getAnneeBull(), $unBulletin->getBulletinPDF(), $unBulletin->getIdContrat(),$unBulletin->getIdBulletin()));
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function suppBulletin($idBulletin){
        try{
            $req = $this->db->prepare("DELETE FROM bulletin WHERE idBulletin =?");
            $req->execute(array($idBulletin));
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function creerBulletin($unBulletin){
        try{
            $req = $this->db->prepare('INSERT INTO bulletin (mois, annee, bulletinPDF, idContrat) VALUES (?,?,?,?)');
            $req->execute(array($unBulletin->getMoisBull(),$unBulletin->getAnneeBull(), $unBulletin->getBulletinPDF(), $unBulletin->getIdContrat()));
            return true;
        }

        catch(Exception $e){
            return false;
        }

    }


}