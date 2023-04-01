<?php

/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier() {
    if (!isset($_SESSION['produits'])) {
        $_SESSION['produits'] = array(

        );
    }
}

/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier() {
    unset($_SESSION['produits']);
}

/**
 * Ajoute un produit au panier
 * @param int $id,
 * @param string nom,
 * @param string couleur,
 * @param string type,
 * @param string image,
 * @param dec prix
 * @param int quantité
 */
function ajouterAuPanier(int $idProduit,  $nomProduit, $couleurProduit, $uniteProduit, $image, $prix, int $quantite) {
        $_SESSION['panier'][] = [$idProduit, $nomProduit, $couleurProduit, $uniteProduit, $image, $prix, $quantite];
        $ok = true;
    
    return $ok;
}

/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produits
 * @return : le tableau
 */
function getLesIdProduitDuPanier() {
    return $_SESSION['produits'];
}

/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
 */
function nbProduitsDuPanier() {
    $n = 0;
    if (isset($_SESSION['produits'])) {
        $n = count($_SESSION['produits']);
    }
    return $n;
}

/**
 * Retire un produit du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de jeu

 */
function retirerDuPanier($idProduit) {
    $index = array_search($idProduit, $_SESSION['produits']);
    unset($_SESSION['produits'][$index]);
}

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs) {
    echo '<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
        ?>     
        <li><?php echo $erreur ?></li>
        <?php
    }
    echo '</ul></div>';
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg) {
    echo '<div class="message">'.$msg.'</div>';
}


// function ajouterProduitAuPanier() {
//     // Vérifie si l'ID du produit a été passé en paramètre GET
//     if (isset($_GET['id_produit'])) {
//         $id_produit = $_GET['id_produit'];

//         // Vérifie si la quantité a été passée en paramètre POST
//         if (isset($_POST['quantite'])) {
//             $quantite = $_POST['quantite'];

//             // Initialise le panier client en session s'il n'existe pas déjà
//             if (!isset($_SESSION['panier'])) {
//                 $_SESSION['panier'] = array();
//             }

//             // Ajoute le produit avec sa quantité dans le panier client
//             $_SESSION['panier'][$id_produit] = $quantite;
//         }
//     }
// }