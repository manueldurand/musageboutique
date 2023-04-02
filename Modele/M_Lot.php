<?php
/**
 * Détermine le lot en fonction de l'id du résultat de la loterie
 */
Class M_Lot {
 public static function getLot($id) {
        $conn = AccesDonnees::getPdo();
        $stmt = $conn->prepare("SELECT nom_lot FROM lafleur_lots WHERE lafleur_lots.id_lot = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
}
