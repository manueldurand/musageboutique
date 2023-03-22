<?php

include_once 'Modele/M_Produit.php';

switch ($action) {
    case 'tousLesProduits':
        $produits = M_Produit::trouveTousLesProduitsVisibles();
        break;
    case 'voirProduit':
            $idProduit = filter_input(INPUT_GET, 'produit');
            $produit = M_Produit::trouveLeProduit($idProduit);
        break;
    case 'ajoutPanier':
        if(isset($_POST['ajouter'])){
            if(isset($_GET['id'])){
                $idProduit = filter_input(INPUT_GET, 'produit');
                $quantite = filter_input(INPUT_POST, 'quantite');
               // Initialiser le panier client en session s'il n'existe pas déjà
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }
            }
        }
        
        ajouterAuPanier($idProduit, $quantite) ;
        afficheMessage("Article ajouté au panier !");
        
        break;


}


function ajouterProduitAuPanier() {
    // Vérifie si l'ID du produit a été passé en paramètre GET
    if (isset($_GET['id_produit'])) {
        $id_produit = $_GET['id_produit'];

        // Vérifie si la quantité a été passée en paramètre POST
        if (isset($_POST['quantite'])) {
            $quantite = $_POST['quantite'];

            // Initialise le panier client en session s'il n'existe pas déjà
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }

            // Ajoute le produit avec sa quantité dans le panier client
            $_SESSION['panier'][$id_produit] = $quantite;
        }
    }
}
