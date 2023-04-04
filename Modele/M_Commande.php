<?php

class M_Commande {


    public static function creerCommande($date_commande, $date_livraison_sql, $client_id, $lot_id) {
        $conn = AccesDonnees::getPdo();
        $req = "INSERT INTO lafleur_commandes(date_commande, date_livraison, client_id, lot_id) ";
        $req .= "VALUES (:dc, :dl, :c_id, :l_id)";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':dc', $date_commande);
        $stmt->bindParam(':dl', $date_commande);
        $stmt->bindParam(':c_id', intval($client_id));
        $stmt->bindParam(':l_id', intval($lot_id));
        $stmt->execute();
        return $conn->lastInsertId();
    }















}