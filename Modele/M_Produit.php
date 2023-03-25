<?php

/**requêtes sur les produits
 * 
 */
class M_Produit {

    public static function trouveTousLesProduitsVisibles() {
        $request = "SELECT id, nom_produit, description, image FROM lafleur_produits WHERE stock > '0'";
        $res = AccesDonnees::query($request);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    
    }
    public static function trouveLeProduit($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT * FROM lafleur_produits WHERE lafleur_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

    }
    public static function getNom($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT nom_produit FROM lafleur_produits WHERE lafleur_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPrix($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT prix FROM lafleur_produits WHERE lafleur_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getImage($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT image FROM lafleur_produits WHERE lafleur_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

