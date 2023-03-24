<?php

session_start();


// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Attention : A supprimer en production !!!

require("./Config/fonctions.inc.php");
require('./Config/validateurs.inc.php');
require("./Modele/AccesDonnees.php");


$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
initPanier();

if (!$uc) {
    $uc = 'accueil';
}

// Controleur principal
switch ($uc) {
    case 'boutique' :
        include 'Controleur/ProduitControleur.php';
        break;
    case 'voirProduit' :
        include 'Controleur/ProduitControleur.php';
        break;
    case 'panier' :
        include 'Controleur/PanierControleur.php';
        break;
    case 'commander':
        include 'Controleur/PanierControleur.php';
        break;
    case 'panierConfirmer';
        include 'Controleur/ProduitControleur.php';
        break;
    case 'livraison':
        include 'Controleur/LivraisonControleur.php';
        break;
    case 'inscription' :
        include 'Controleur/C_monCompte.php';
        break;
    case 'connexion':
        include 'Controleur/C_monCompte.php';
        break;
    case 'deco':
        include 'Controleur/C_monCompte.php';
        break;
    case 'compte':
        include 'Controleur/C_moncompte.php';
        break;
    default:
        break;
}


include("Vue/base.php");

