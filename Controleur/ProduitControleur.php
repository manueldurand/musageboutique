<?php

include_once 'Modele/M_Produit.php';

switch ($action) {
    case 'tousLesProduits':
        $produits = M_Produit::trouveTousLesProduits();
        break;
    case 'voir':
            $idProduit = filter_input(INPUT_GET, 'produit');
            $produit = M_Produit::trouveLeProduit($idProduit);
        break;

}
