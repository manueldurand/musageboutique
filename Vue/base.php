<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Recursive:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Css/style.css" type="text/css">
    <title>Lafleur</title>
</head>

<body>
    <!-- ---------------------------------EN-TETE LOGO + PANIER + LIENS INSCRIPTION CONNEXION -------------- -->
    <div class="page-container">
        <header>
            <div id="top_page">
                <img class="vignette" src="assets/img/comp/rue_lourmarin_carre.jpg" alt="rue Lourmarin">
            </div>

            <!-- ---------------------------BURGER MENU MOBILE ------------------------------------------- -->

            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">x</a>
                <ul>
                    <li><a href="index.php?$uc=accueil">Accueil</a></li>
                    <li><a href="index.php?uc=boutique&action=tousLesProduits">Boutique</a></li>
                    <li><a href="index.php?uc=livraison">Livraison</a></li>
                    <li><a href="index.php?$uc=contact">Contact</a></li>
                    <li><a href="index.php?$uc=blog">Blog</a></li>

                </ul>
            </div>

            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>


            <div class="titre_header">
                <a href="index.php?$uc=accueil"><img src="assets/img/comp/logo.png" class="logo" alt="logo lafleur"></a>
            </div>
            <div class="aside_head">
                <div class="inside_aside">
                    <div class="icone_panier"><a href="index.php?uc=panier&action=infoPanier"><img src="assets/icones/icons8-shopping-cart-48.png" class="icn-panier" alt="panier"></a></div>
                    <p class="legende_aside">
                        <?php if (!isset($_SESSION['id_client'])) : ?>
                            <a href="index.php?uc=inscription"><span>inscription</span></a><a href="index.php?uc=connexion"><span>connexion</span></a>
                        <?php endif ?>
                        <?php if (isset($_SESSION['id_client'])) : ?>
                            <a href="index.php?uc=compte&action=consulter"><span>Mon compte</span></a><a href="index.php?uc=deconnexion"><span>Déconnexion</span></a>
                        <?php endif ?>
                    </p>
                </div>
            </div>
        </header>
        <!-- ---------------------------------MENU BARRE DE NAVIGATION ----------------------- -->
        <nav id="wrap" class="navbar">
            <ul class="menu">
                <li><a href="index.php?$uc=accueil">
                        Accueil
                    </a></li>
                <li><a href="index.php?uc=boutique&action=tousLesProduits">
                        Boutique
                    </a></li>
                <li><a href="index.php?uc=livraison">
                        Livraison
                    </a></li>
                <li><a href="index.php?$uc=contact">
                        Contact
                    </a></li>
                <li><a href="index.php?$uc=blog">
                        Blog
                    </a></li>
            </ul>
        </nav>

        <!-- ------------------------------------CONTROLEUR DES VUES------------------------- -->
        <main>
            <?php
            switch ($uc) {
                case 'accueil':
                    include 'Vue/accueil.php';
                    break;
                case 'boutique';
                    include 'Vue/boutique.php';
                    break;
                case 'voirProduit':
                    include 'Vue/produit.php';
                    break;
                case 'panier':
                    include 'Vue/panier.php';
                    break;
                case 'livraison':
                    include 'Vue/livraison.php';
                    break;
                    // case 'panierConfirmer':
                    //     include 'Vue/panierConfirmer.php';
                    //     break;
                case 'inscription':
                    if (isset($_SESSION['livraison']) && ($_SESSION['livraison'] === true)) {
                        include 'Vue/inscription.php';
                    } else include 'Vue/livraison.php';
                    break;
                case 'connexion':
                    include 'Vue/connexion.php';
                    break;
                case 'deconnexion':
                    include 'Vue/deconnexion.php';
                    break;
                case 'bienvenue':
                    include 'Vue/bienvenue.php';
                    break;
                case 'compte':
                    include 'Vue/compte.php';
                    break;
                case 'commander':
                    include 'Vue/commande.php';
                    break;
                case 'loterie':
                    include 'Vue/loterie.php';
                    break;
                case 'messages':
                    include 'Vue/messages.php';
                    break;
                case 'resultat':
                    include 'Vue/resultat.php';
                    break;
                case 'modifierCompte':
                    include 'Vue/modifierCompte.php';
                    break;
                case 'valideCommande':
                    include 'Vue/valideCommande.php';
                    break;
            }
            ?>
        </main>
    </div>
    <footer>
        <div class="centre foot">
            <p class="foot"> &copy;Lafleur-Lourmarin 2023 - crédits photos : <a href="https://www.pexels.com/fr-fr/">www.pexels.com</a></p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script defer src="Js/main.js"></script>

</body>

</html>