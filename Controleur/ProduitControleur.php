<?php

include_once 'Modele/M_Produit.php';

switch ($action) {
    case 'tousLesProduits':
        $produits = M_Produit::trouveTousLesProduitsVisibles();
        break;
    case 'voir':
            $idProduit = filter_input(INPUT_GET, 'idProduit');
            $produit = M_Produit::trouveLeProduit($idProduit);
        break;
    case 'bouquets':
        $produits = M_Produit::trouveTousLesBouquetsVisibles();
        break;
    case 'unite':
        $produits = M_Produit::trouveLesFleursUniteVisibles();
        break;
    case 'couleur':
        $id_couleur= (int)filter_input(INPUT_GET, 'id');
        $produits = M_Produit::trouveLaCouleur(intval($id_couleur));
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
            $produit = M_Produit::trouveLeProduit($idProduit);

        $nomProduit = $produit['nom_plante'];
        $couleurProduit = $produit['nom_couleur'];
        $uniteProduit = $produit['type_unite'];
        $prix = $produit['prix'];
        $image = $produit['image1'];
             
        ajouterAuPanier($idProduit, $nomProduit, $couleurProduit, $uniteProduit, $image, $prix, $quantite) ;
        afficheMessage("Article ajouté au panier !");
        $produit = M_Produit::trouveLeProduit($idProduit);
        break;


}






