<?php

include_once 'Modele/M_Produit.php';

switch ($action) {

    case 'ajoutPanier':
        if(isset($_SESSION['id'])) {
            $produit = filter_input(INPUT_GET, 'produit');

        } else {
            $message = "Vous devez être connecté pour passer une commande";
            
        }
}