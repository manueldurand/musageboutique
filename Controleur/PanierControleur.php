<?php

include_once 'Modele/M_Produit.php';
include_once 'Modele/M_Lot.php';
include_once 'Modele/M_Commande.php';

/**Contrôleur pour la gestion du panier
 * 
 */
switch ($action) {

    case 'passerCommande':
        if (isset($_SESSION['id_client']) && !isset($_SESSION['loterie'])) {
            header('Location: index.php?uc=loterie');
        } else if (isset($_SESSION['id_client']) && isset($_SESSION['loterie'])) {
            $articlesPanier = $_SESSION['panier'];
            $client_id = intval($_SESSION['id_client']);
            $lot_id = intval($_SESSION['loterie']['idLot']);
            $date = new DateTime();
            $date_commande = $date->format('Y-m-d H:i:s');
            $date_livraison = new DateTime(sprintf(
                '%04d-%02d-%02d %02d:%02d:00',
                $_POST['annee'],
                $_POST['mois'],
                $_POST['jour'],
                $_POST['heure'],
                $_POST['minute']
            ));
            $date_livraison_sql = $date_livraison->format('Y-m-d H:i:s');
            $etat_commande = 'en cours';
            
            try {
                $idCommande = M_Commande::creerCommande($date_commande, $date_livraison_sql, $client_id, $lot_id, $etat_commande, $articlesPanier);
                supprimerPanier();
                $articlesPanier = null;
                $_SESSION['panier'] = [];
                $_SESSION['loterie'] = [];
                $_SESSION['lot'] = [];
                $_SESSION['message'] = "Votre commmande n° $idCommande a bien été enregistrée, merci pour votre confiance";
                header('Location: index.php?uc=messages');
                
            } catch (\PDOException $e) {
                echo $e;
                $_SESSION['message'] = "Une erreur est survenue, nous sommes désolés, veuillez recommencer";
                header('Location: index.php?uc=messages');
                
            }
        } else {
            $_SESSION['message'] = "Vous devez être connecté pour passer une commande";
            header('Location: index.php?uc=messages');
        }
        break;
    case 'infoPanier':
        if (isset($_SESSION['panier'])) {
            $articlesPanier = $_SESSION['panier'];
            if (isset($_SESSION['loterie'])) {
                // var_dump($_SESSION['loterie']);
                $maxId = null; // Initialisation de la variable $maxId à null
                $resultatsLoterie = $_SESSION['resultatsLoterie'];
                foreach ($resultatsLoterie as $tuple) {
                    $idLot = $tuple[1]; // Récupération de l'id de loterie du tuple actuel
                    if ($idLot > $maxId) { // Comparaison de l'id de loterie avec $maxId
                        $maxId = $idLot; // Affectation de $idLot à $maxId si l'id est plus grand
                        $_SESSION['loterie']['idLot'] = $idLot;
                    }
                    $_SESSION['lot'] = M_Lot::getLot($idLot);
                }
            }
        }
        break;
    case 'supprimerUnProduit':
        $idProduit = filter_input(INPUT_GET, 'produit');
        $articlesPanier = $_SESSION['panier'];
        foreach ($articlesPanier as $key => $article) {
            if ($idProduit == $article[0]) {

                unset($_SESSION['panier'][$key]);
            }
        }
        $uc = 'panier';
        $action = 'infoPanier';
        header('Location: index.php?uc=panier&action=infoPanier');
        exit();
        break;
    case 'commander':
        include 'Vue/commande.php';
        break;
    case 'enregistrePanier':
        if (isset($_POST['commander'])) {
            $panierTotal = [];
            $prixTotal = filter_input(INPUT_POST, 'prixTotal');
            $dateCommande = new DateTime();
            $date_livraison = sprintf(
                '%04d-%02d-%02d %02d:%02d:00',
                $_POST['annee'],
                $_POST['mois'],
                $_POST['jour'],
                $_POST['heure'],
                $_POST['minute']
            );
        }
    case 'retourPanier':
        if (isset($_SESSION['loterie'])) {
            $articlesPanier = $_SESSION['panier'];
            // var_dump($articlesPanier);
            $maxId = null; // Initialisation de la variable $maxId à null
            $resultatsLoterie = $_SESSION['resultatsLoterie'];
            // var_dump($resultatsLoterie);
            foreach ($resultatsLoterie as $tuple) {
                $idLot = $tuple[1]; // Récupération de l'id de loterie du tuple actuel
                if ($idLot > $maxId) { // Comparaison de l'id de loterie avec $maxId
                    $maxId = $idLot; // Affectation de $idLot à $maxId si l'id est plus grand
                    $_SESSION['loterie']['idLot'] = $idLot;
                }
                $_SESSION['lot'] = M_Lot::getLot($idLot);
            }
        }
}
