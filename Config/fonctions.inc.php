<?php

/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier() {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array(

        );
    }
}

/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier() {
    unset($_SESSION['panier']);
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
