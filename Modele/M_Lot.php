<?php
/**
 * Détermine le lot en fonction de l'id du résultat de la loterie
 */
Class M_Lot {
 public static function getLot($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT nom_lot FROM musage_lots WHERE musage_lots.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }  
    
    public static function verifieStockLot($id) {
        $test = false;
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT quantite FROM musage_lots WHERE musage_lots.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt->fetch()>0) {
            $test = true;
        };
        return $test;

    }
}
