<?php

/**requêtes sur les produits
 * 
 */
class M_Produit {

    public static function trouveTousLesProduits() {
        $request = "SELECT id, nom_produit, description, image FROM lafleur_produits";
        $res = AccesDonnees::query($request);
        return $res->fetchAll();
    
    }
    public static function trouveLeProduit($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT * FROM lafleur_produits WHERE lafleur_produits.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

    }
}