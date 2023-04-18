<?php

include_once 'Modele/M_Produit.php';

switch ($action) {
    case 'tousLesProduits':
        $produits = M_Produit::trouveTousLesProduitsVisibles();
        break;
    case 'voir':
            $id_produit = filter_input(INPUT_GET, 'produit');
            $produit = M_Produit::trouveLeProduit($id_produit);
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
                $id_produit = intval(filter_input(INPUT_GET, 'produit'));
                $quantite = filter_input(INPUT_POST, 'quantite');
               // Initialise le panier client en session s'il n'existe pas déjà
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }
            }
            $produit = M_Produit::trouveLeProduit($id_produit);
            $lesIdDuPanier = trouveLesIdDuPanier();
            var_dump($lesIdDuPanier);
            var_dump($id_produit);
            $stock = $produit['stock'];
            foreach ($lesIdDuPanier as $index => $id_article) {
                if ($id_produit == $id_article) {
                    if($quantite + $_SESSION['panier'][$index][6] > $stock) {
                        $_SESSION['message'] = "nous sommes désolés, nous ne pouvons ajouter de commande, il ne nous reste que $stock exemplaires en stock";
                        header('location: index.php?uc=messages');
                    } else {
                        $_SESSION['panier'][$index][6] += $quantite;
                        $_SESSION['message'] = "quantité mise à jour";
                        header('location: index.php?uc=messages');
                    }
                    break;
                }
            }
            if($quantite > $stock) {
                $_SESSION['message'] = "nous sommes désolés, il ne nous reste que $stock exemplaires en stock";
                header('location: index.php?uc=messages');
                
            } else if (!in_array($id_produit, $lesIdDuPanier)) {
                $nom_produit = $produit['nom_plante'];
                $couleur_produit = $produit['nom_couleur'];
                $unite_produit = $produit['type_unite'];
                $prix = $produit['prix'];
                $image = $produit['image1'];
                
                ajouterAuPanier($id_produit, $nom_produit, $couleur_produit, $unite_produit, $image, $prix, $quantite) ;
                $produit = M_Produit::trouveLeProduit($id_produit);
                $_SESSION['message'] = "produit ajouté au panier";
                header('location: index.php?uc=messages');
        break;               
            }



}






