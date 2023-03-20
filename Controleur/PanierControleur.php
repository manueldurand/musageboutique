<?php

include_once 'Modele/M_Produit.php';

/**Contrôleur pour la gestion du panier
 * 
 */
switch ($action) {

    case 'passerCommande':
        if(isset($_SESSION['id'])) {
            

        } else {
            $message = "Vous devez être connecté pour passer une commande";
            
        }
        break;
}