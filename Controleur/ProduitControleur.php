<?php

include_once 'Modele/M_Produit.php';

switch ($action) {
    case 'tousLesProduits':
        $produits = M_Produit::trouveTousLesProduitsVisibles();
        break;
    case 'voir':
            $idProduit = filter_input(INPUT_GET, 'produit');
            $produit = M_Produit::trouveLeProduit($idProduit);
        break;
    case 'ajoutPanier':
        if(isset($_POST['ajouter'])){
                $idProduit = filter_input(INPUT_GET, 'produit');
                $quantite = filter_input(INPUT_POST, 'quantite');
               // Initialiser le panier client en session s'il n'existe pas déjà
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = array();
            }
            }
        $nomProduit = M_Produit::getNom($idProduit);
        $prix = M_Produit::getPrix($idProduit);
        $image = M_Produit::getImage($idProduit);
             
        ajouterAuPanier($idProduit, $nomProduit, $image, $prix, $quantite) ;
        afficheMessage("Article ajouté au panier !");
        $produit = M_Produit::trouveLeProduit($idProduit);
        break;


}






