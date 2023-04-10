<?php

class M_Commande
{

    /**
     * enregistre dans la base de données la commande du client puis les lignes de commandes ( commande / produits)
     * et mets à jour la quantité de produits disponibles
     *
     * @param datetime $date_commande
     * @param datetime $date_livraison_souhaitee
     * @param int $client_id
     * @param int $lot_id (gain de la loterie si il y a)
     * @param enum $etat_commande
     * @param array $articlesPanier as id_produit / quantite
     * @return void
     */
    public static function creerCommande($date_commande, $date_livraison_souhaitee, $client_id, $lot_id, $etat_commande, $articlesPanier)
    {
        $conn = AccesDonnees::getPdo();
        //début de la transaction d'enregistrent de la commande
        $conn->beginTransaction();
        try {
            $req = "INSERT INTO lafleur_commandes(dateCommande, livraison_souhaitee, client_id, lot_id, etat_commande) VALUES (:dc, :dl, :c_id, :l_id, :etat)";
            $stmt = $conn->prepare($req);
            $stmt->bindParam(':dc', $date_commande);
            $stmt->bindParam(':dl', $date_livraison_souhaitee);
            $stmt->bindParam(':c_id', $client_id);
            $stmt->bindParam(':l_id', $lot_id);
            $stmt->bindParam(':etat', $etat_commande);
            $stmt->execute();
            $idCommande = $conn->lastInsertId();

            foreach ($articlesPanier as $article) {
                $req1 = "INSERT INTO lafleur_commande_produits(commande_id, produit_id, quantite) VALUES (:c_id, :p_id, :q)";
                $stmt = $conn->prepare($req1);
                $stmt->bindParam(':c_id', $idCommande);
                $stmt->bindParam(':p_id', $article[0]);
                $stmt->bindParam(':q', $article[6]);
                $stmt->execute();


                $req2 = "UPDATE lafleur_produits SET stock = stock - $article[6] WHERE idProduit = :id";
                $stmt = $conn->prepare($req2);
                $stmt->bindParam(':id', $article[0]);
                $stmt->execute();
            }
            $req3 = "UPDATE lafleur_lots SET quantite = quantite - 1 WHERE id_lot = :id";
            $stmt = $conn->prepare($req3);
            $stmt->bindParam(':id', $lot_id);
            $stmt->execute();
            $conn->commit();
            return $idCommande;
        } catch (PDOException $e) {

            $conn->rollback();
            afficheMessage($e);
        }
    }
}
