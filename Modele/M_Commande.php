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
     * @param string $etat_commande
     * @param array $articlesPanier as id_produit / quantite
     * @return void
     */
    public static function creerCommande($date_commande, $date_livraison_souhaitee, $client_id, $lot_id, $etat_commande, $articles_panier)
    {
        $conn = AccesDonnees::getPdo();
        //début de la transaction d'enregistrent de la commande
        $conn->beginTransaction();
        try {
            $req = "INSERT INTO lafleur_commandes(date_commande, livraison_souhaitee, client_id, lot_id, etat_commande) VALUES (:dc, :dl, :c_id, :l_id, :etat)";
            $stmt = $conn->prepare($req);
            $stmt->bindParam(':dc', $date_commande);
            $stmt->bindParam(':dl', $date_livraison_souhaitee);
            $stmt->bindParam(':c_id', $client_id);
            $stmt->bindParam(':l_id', $lot_id);
            $stmt->bindParam(':etat', $etat_commande);
            $stmt->execute();
            $id_commande = $conn->lastInsertId();

            foreach ($articles_panier as $article) {
                $req1 = "INSERT INTO lafleur_commande_produit(commande_id, produit_id, quantite) VALUES (:c_id, :p_id, :q)";
                $stmt1 = $conn->prepare($req1);
                $stmt1->bindParam(':c_id', $id_commande);
                $stmt1->bindParam(':p_id', $article[0]);
                $stmt1->bindParam(':q', $article[6]);
                $stmt1->execute();


                $req2 = "UPDATE lafleur_produits SET stock = stock - $article[6], date_m_a_j = :d WHERE id_produit = :id";
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
            return $id_commande;
        } catch (PDOException $e) {

            $conn->rollback();
            afficheMessage($e);
        }
    }
    /**
     * récu^ère les commandes d'un client à partir de son Id
     *
     * @param int $id
     * @return array le tableau des Id des commandes
     */
    public static function trouveLesCommandes(int $id) {
        $conn = AccesDonnees::getPdo();
        $req = "SELECT id_commande FROM lafleur_commandes WHERE client_id = :id";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    /**
     * récupère les infos d'une commande à partir de son Id
     *
     * @param int $id
     * @return array [date de commande, date de livraison souhaitée état de la commande, id du lot s'il existe]
     */
    public static function trouveLesInfos(int $id) {
        $conn = AccesDonnees::getPdo();
        $req = "SELECT date_commande, livraison_souhaitee, lot_id, date_livraison, etat_commande ";
        $req .= "FROM lafleur_commandes WHERE id_commande = :id";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * trouve le nom du lot à partir de l'Id enregistré dans la ligne de commandes
     *
     * @param integer $id
     * @return void string nom du lot
     */
    public static function trouveLeLot(int $id) {
        $conn = AccesDonnees::getPdo();
        $req = "SELECT nom_lot FROM lafleur_lots WHERE id_lot = :id";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    /**
     * calcule le montant d'une commande à partir de son Id dans la table commandes_produits
     *
     * @param int $id
     * @return void
     */
    public static function calculeLeMontant($id) {
        $montant = 0;
        $conn = AccesDonnees::getPdo();
        $req = "SELECT lafleur_produits.prix * lafleur_commande_produit.quantite as montant_produit FROM lafleur_commande_produit ";
        $req .= "JOIN lafleur_produits ON lafleur_produits.id_produit = lafleur_commande_produit.produit_id WHERE lafleur_commande_produit.commande_id = :id";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $montant += $row['montant_produit'];
        }
        return $montant;
    }

}

// function calculerMontantCommande($commande_id, $bdd) {
//     $montant = 0;
//     $stmt = $bdd->prepare("SELECT produits.prix * commandes.quantite as montant_produit FROM commandes INNER JOIN produits ON commandes.produit_id = produits.id WHERE commandes.commande_id = ?");
//     $stmt->bindParam(1, $commande_id);
//     $stmt->execute();
//     while ($row = $stmt->fetch()) {
//         $montant += $row['montant_produit'];
//     }
//     return $montant;
// }

