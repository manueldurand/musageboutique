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
                $stmt1 = $conn->prepare($req1);
                $stmt1->bindParam(':c_id', $idCommande);
                $stmt1->bindParam(':p_id', $article[0]);
                $stmt1->bindParam(':q', $article[6]);
                $stmt1->execute();


                $req2 = "UPDATE lafleur_produits SET stock = stock - $article[6], date_m_a_j = :d WHERE idProduit = :id";
                $stmt2 = $conn->prepare($req2);
                $stmt2->bindParam(':id', $article[0]);
                $stmt2->bindParam(':d', $date_commande);
                $stmt2->execute();
            }
            $req3 = "UPDATE lafleur_lots SET quantite = quantite - 1, m_a_j = :d2 WHERE id_lot = :id";
            $stmt3 = $conn->prepare($req3);
            $stmt3->bindParam(':id', $lot_id);
            $stmt3->bindParam(':d2', $date_commande);
            $stmt3->execute();
            
            $conn->commit();
            return $idCommande;
        } catch (PDOException $e) {

            $conn->rollback();
            afficheMessage($e);
        }
    }
}
