<?php
include_once 'Modele/M_Lot.php';
/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
}

/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier()
{
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
function ajouterAuPanier(int $idProduit,  $nomProduit, $couleurProduit, $uniteProduit, $image, $prix, int $quantite)
{
    $_SESSION['panier'][] = [$idProduit, $nomProduit, $couleurProduit, $uniteProduit, $image, $prix, $quantite];
    $ok = true;

    return $ok;
}
function trouveLesIdDuPanier()
{
    $lesIdDuPanier = [];
    foreach ($_SESSION['panier'] as $article) {
        $lesIdDuPanier[] = $article[0];
    }
    return $lesIdDuPanier;
}
/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs)
{
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
function afficheMessage(string $msg)
{
    echo '<div class="message">' . $msg . '</div>';
}

function recapCommandes($infos_commandes, $montants_commandes)
{
    foreach ($infos_commandes as $index => $info_commande) {
        foreach ($info_commande as  $detail) {
            $tableau_commandes[] = [
                'date_commande' => $detail['date_commande'],
                'livraison_souhaitee' => $detail['livraison_souhaitee'],
                'nom_lot' => M_Lot::getLot($detail['lot_id']),
                'date_livraison' => $detail['date_livraison'],
                'etat_commande' => $detail['etat_commande'],
                'montant_commande' => $montants_commandes[$index],
            ];

        }
    }
    return $tableau_commandes;
}
