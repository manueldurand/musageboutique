<?php

/**requêtes sur les produits
 * 
 */
class M_Produit {

    public static function trouveTousLesProduitsVisibles() {
        $request = "SELECT musage_produits.id, nom_plante, nom_couleur, musage_type_unite, prix, musage_produits.description, image1, image2 FROM musage_produits ";
        $request .= "JOIN musage_type_plante ON musage_type_plante.id = musage_produits.plante_id_id ";
        $request .= "JOIN musage_couleurs ON musage_couleurs.id = musage_produits.couleur_id_id ";
        $request .= "JOIN musage_unite ON musage_unite.id = musage_produits.unite_id_id WHERE stock > '0'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public static function trouveTousLesBouquetsVisibles() {
        $request = "SELECT musage_produits.id, nom_plante, nom_couleur, musage_type_unite, prix, musage_produits.description, image1, image2 FROM musage_produits ";
        $request .= "JOIN musage_type_plante ON musage_type_plante.id = musage_produits.plante_id_id ";
        $request .= "JOIN musage_couleurs ON musage_couleurs.id = musage_produits.couleur_id_id ";
        $request .= "JOIN musage_unite ON musage_unite.id = musage_produits.unite_id_id WHERE stock > '0' AND unite_id_id = '3'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function trouveLesFleursUniteVisibles() {
        $request = "SELECT musage_produits.id, nom_plante, nom_couleur, musage_type_unite, prix, musage_produits.description, image1, image2 FROM musage_produits ";
        $request .= "JOIN musage_type_plante ON musage_type_plante.id = musage_produits.plante_id_id ";
        $request .= "JOIN musage_couleurs ON musage_couleurs.id = musage_produits.couleur_id_id ";
        $request .= "JOIN musage_unite ON musage_unite.id = musage_produits.unite_id_id WHERE stock > '0' AND unite_id_id = '1' OR unite_id_id = '2'";
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
        $request = "SELECT musage_produits.id, nom_plante, nom_couleur, musage_type_unite, prix, musage_produits.description, image1, image2 FROM musage_produits ";
        $request .= "JOIN musage_type_plante ON musage_type_plante.id = musage_produits.plante_id_id ";
        $request .= "JOIN musage_couleurs ON musage_couleurs.id = musage_produits.couleur_id_id ";
        $request .= "JOIN musage_unite ON musage_unite.id = musage_produits.unite_id_id WHERE stock > '0' AND couleur_id_id= :c ";
        $stmt = $conn->prepare($request);
        $stmt->bindParam(':c', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function trouveLeProduit($id) {
        $conn = AccesDonnees::getPdo();
        $request = "SELECT musage_produits.id, nom_plante, nom_couleur, musage_type_unite, prix, stock, musage_produits.description, image1, image2 FROM musage_produits ";
        $request .= "JOIN musage_type_plante ON musage_type_plante.id = musage_produits.plante_id_id ";
        $request .= "JOIN musage_couleurs ON musage_couleurs.id = musage_produits.couleur_id_id ";
        $request .= "JOIN musage_unite ON musage_unite.id = musage_produits.unite_id_id WHERE musage_produits.id = :id";
        $stmt = $conn->prepare($request);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

    }
    public static function getNom($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT nom_produit FROM musage_produits WHERE musage_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPrix($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT prix FROM musage_produits WHERE musage_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getImage($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT image FROM musage_produits WHERE musage_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

