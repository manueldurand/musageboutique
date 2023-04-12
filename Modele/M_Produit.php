<?php

/**requêtes sur les produits
 * 
 */
class M_Produit {

    public static function trouveTousLesProduitsVisibles() {
        $request = "SELECT idProduit, nom_plante, nom_couleur, type_unite, prix, lafleur_produits.description, image1, image2 FROM lafleur_produits ";
        $request .= "JOIN lafleur_type_plante ON lafleur_type_plante.id_type_plante = lafleur_produits.plante_id ";
        $request .= "JOIN lafleur_couleurs ON lafleur_couleurs.idcouleur = lafleur_produits.couleur_id ";
        $request .= "JOIN lafleur_unite ON lafleur_unite.id_unite = lafleur_produits.unite_id WHERE stock > '0'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public static function trouveTousLesBouquetsVisibles() {
        $request = "SELECT idProduit, nom_plante, nom_couleur, type_unite, prix, lafleur_produits.description, image1, image2 FROM lafleur_produits ";
        $request .= "JOIN lafleur_type_plante ON lafleur_type_plante.id_type_plante = lafleur_produits.plante_id ";
        $request .= "JOIN lafleur_couleurs ON lafleur_couleurs.idcouleur = lafleur_produits.couleur_id ";
        $request .= "JOIN lafleur_unite ON lafleur_unite.id_unite = lafleur_produits.unite_id WHERE stock > '0' AND unite_id = '3'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function trouveLesFleursUniteVisibles() {
        $request = "SELECT idProduit, nom_plante, nom_couleur, type_unite, prix, lafleur_produits.description, image1, image2 FROM lafleur_produits ";
        $request .= "JOIN lafleur_type_plante ON lafleur_type_plante.id_type_plante = lafleur_produits.plante_id ";
        $request .= "JOIN lafleur_couleurs ON lafleur_couleurs.idcouleur = lafleur_produits.couleur_id ";
        $request .= "JOIN lafleur_unite ON lafleur_unite.id_unite = lafleur_produits.unite_id WHERE stock > '0' AND unite_id = '1' OR unite_id = '2'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * retourne les produits dont la couleur correspond à l'id de la bdd
     *
     * @param int $id
     * @return array $produits
     */
    public static function trouveLaCouleur($id) {
        $conn = AccesDonnees::getPdo();
        $request = "SELECT idProduit, nom_plante, nom_couleur, type_unite, prix, lafleur_produits.description, image1, image2 FROM lafleur_produits ";
        $request .= "JOIN lafleur_type_plante ON lafleur_type_plante.id_type_plante = lafleur_produits.plante_id ";
        $request .= "JOIN lafleur_couleurs ON lafleur_couleurs.idcouleur = lafleur_produits.couleur_id ";
        $request .= "JOIN lafleur_unite ON lafleur_unite.id_unite = lafleur_produits.unite_id WHERE stock > '0' AND couleur_id= :c ";
        $stmt = $conn->prepare($request);
        $stmt->bindParam(':c', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function trouveLeProduit($id) {
        $conn = AccesDonnees::getPdo();
        $request = "SELECT idProduit, nom_plante, nom_couleur, type_unite, prix, stock, lafleur_produits.description, image1, image2 FROM lafleur_produits ";
        $request .= "JOIN lafleur_type_plante ON lafleur_type_plante.id_type_plante = lafleur_produits.plante_id ";
        $request .= "JOIN lafleur_couleurs ON lafleur_couleurs.idcouleur = lafleur_produits.couleur_id ";
        $request .= "JOIN lafleur_unite ON lafleur_unite.id_unite = lafleur_produits.unite_id WHERE idProduit = :id";
        $stmt = $conn->prepare($request);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

    }
    public static function getNom($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT nom_produit FROM lafleur_produits WHERE lafleur_produits.idProduit = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPrix($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT prix FROM lafleur_produits WHERE lafleur_produits.idProduit = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getImage($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT image FROM lafleur_produits WHERE lafleur_produits.idProduit = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

