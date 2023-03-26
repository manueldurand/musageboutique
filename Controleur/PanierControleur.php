<?php

include_once 'Modele/M_Produit.php';

/**Contrôleur pour la gestion du panier
 * 
 */
switch ($action) {

    case 'passerCommande':
        if (isset($_SESSION['id'])) {
        } else {
            $message = "Vous devez être connecté pour passer une commande";
        }
        break;
    case 'infoPanier':
        if (isset($_SESSION['panier'])) {
            $articlesPanier = $_SESSION['panier'];

            // var_dump($articlesPanier);
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
        header('Location: index.php?uc=commander&action=infoPanier' );
        exit();
        break;
}
