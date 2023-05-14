<?php
require_once 'Connexion.php' ;
class DialogueBD
{

    public function getTousLesProduit()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "select p.IDPRODUIT ,c.IDCATEGORIE, p.NOMPRODUIT, p.PRIXPRODUIT, p.DEDESCRIPTIONPRODUIT,p.Image, c.COULEUR FROM produit p join categorie c on p.IDCATEGORIE= c.IDCATEGORIE  order by IDPRODUIT ";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $tableProduit = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $tableProduit;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des Produits : " . $e->getMessage());
        }
    }

    public function AjouterProduit($IDCATEGORIE, $NOMPRODUIT, $PRIXPRODUIT, $DEDESCRIPTIONPRODUIT,$IMAGE)
    {

        $ajoutOk = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO produit (IDCATEGORIE, NOMPRODUIT, PRIXPRODUIT,DEDESCRIPTIONPRODUIT,Image)  VALUES(?,?,?,?,?)";
            $sth = $conn->prepare($sql);
            $sth->execute(array($IDCATEGORIE,$NOMPRODUIT ,$PRIXPRODUIT,$DEDESCRIPTIONPRODUIT,$IMAGE ));
            $ajoutOk = true;
        } catch (Exception $e) {
            $msgErreur = $e->getMessage() . '(' . $e->getFile() . ',ligne' . $e->getFile() . ')';
        }
        return $ajoutOk;
    }



    public function getCategorie()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "select IDCATEGORIE ,NOMCATEGORIE FROM categorie";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $tableCategorie = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $tableCategorie;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération : " . $e->getMessage());
        }
    }


    public function supprimerProduit($idProduit)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "DELETE FROM produit WHERE IDPRODUIT = :idProduit";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':idProduit', $idProduit);
            $success = $sth->execute();
            return $success;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du produit : " . $e->getMessage());
        }
    }

    public function modifierProduit($IDPRODUIT,$IDCATEGORIE ,$NOMPRODUIT , $PRIXPRODUIT, $DEDESCRIPTIONPRODUIT,$Image )
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE produit SET IDCATEGORIE = :IDCATEGORIE, NOMPRODUIT = :NOMPRODUIT, PRIXPRODUIT = :PRIXPRODUIT, DEDESCRIPTIONPRODUIT = :DEDESCRIPTIONPRODUIT, Image = :Image WHERE IDPRODUIT = :IDPRODUIT";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':IDCATEGORIE', $IDCATEGORIE);
            $sth->bindParam(':NOMPRODUIT', $NOMPRODUIT);
            $sth->bindParam(':PRIXPRODUIT', $PRIXPRODUIT);
            $sth->bindParam(':DEDESCRIPTIONPRODUIT', $DEDESCRIPTIONPRODUIT);
            $sth->bindParam(':IDPRODUIT', $IDPRODUIT);
            $sth->bindParam(':Image', $Image);

            $sth->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la modification du produit: " . $e->getMessage());
        }
    }

    public function getTousLesUtilisateur()
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "select IDUTILISATEUR ,NOMUTILISATEUR ,EMAILUTILISATEUR ,MOTDEPASSE From utilisateur ";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $tableUtilisateur = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $tableUtilisateur;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des utilisateur : " . $e->getMessage());
        }
    }

    public function modifierUtilisateur($id_utilisateur, $nom_utilisateur, $email, $motsdepasse)
    {
        $Ok = false;
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE utilisateur SET IDUTILISATEUR=?,NOMUTILISATEUR =?, EMAILUTILISATEUR=?,MOTDEPASSE=?  WHERE IDUTILISATEUR = ?";
            $sth = $conn->prepare($sql);
            $sth->execute(array($id_utilisateur,$nom_utilisateur, $email, $motsdepasse));
            $Ok = true;
        } catch (Exception $e) {
            $erreur = $e->getMessage() . ' (' . $e->getFile() . ', ligne ' . $e->getLine() . ')';
        }
        return $Ok;
    }

    public function modifUtilisateur($id_utilisateur, $nom_utilisateur, $email, $motsdepasse)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "UPDATE utilisateur SET IDUTILISATEUR = :IDUTILISATEUR, NOMUTILISATEUR= :NOMUTILISATEUR, EMAILUTILISATEUR = :EMAILUTILISATEUR,  MOTDEPASSE= :MOTDEPASSE WHERE IDUTILISATEUR = :IDUTILISATEUR";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':IDUTILISATEUR', $id_utilisateur);
            $sth->bindParam(':NOMUTILISATEUR', $nom_utilisateur);
            $sth->bindParam(':EMAILUTILISATEUR', $email);
            $sth->bindParam(':MOTDEPASSE', $motsdepasse);
            $sth->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la modification : " . $e->getMessage());
        }
    }


}
