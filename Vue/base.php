<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Recursive:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Css/style.css" type="text/css">
    <title>Header</title>
</head>
<body>
    <header>
        <div >
            <img class="vignette" src="assets/img/comp/rue_lourmarin_carre.jpg" alt="rue Lourmarin">
        </div>
        <div class="titre_header">
            <img src="assets/img/comp/logo.png" alt="logo lafleur">
        </div>
        <div class="aside_head">
            <div class="inside_aside">
            <div class="icone_panier"><a href="#"><img src="assets/icones/icons8-shopping-cart-48.png" alt="panier"></a></div>
            <p class="legende_aside">
            <?php if(!isset($_SESSION['id'])):?>
                <a href="index.php?uc=inscription"><span>inscription</span></a><a href="index.php?uc=connexion"><span>connexion</span></a>
            <?php endif ?>
                <?php if(isset($_SESSION['id'])):?>
                    <a href="index.php?uc=compte&action=consulter"><span>Mon compte</span></a><a href="index.php?uc=deco"><span>Déconnexion</span></a>
                <?php endif ?>
             </p>
        </div>
        </div>
    </header>
    <nav id="wrap">
        <ul class="menu">
            <li><a href="index.php?$uc=accueil">
              Accueil
            </a></li>
            <li><a href="index.php?uc=boutique&action=tousLesProduits">
                Boutique
            </a></li>
            <li><a href="index.php?$uc=livraison">
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
                case 'commander':
                    include 'Vue/panier.php';

            }



        ?>
    </main>
    <script defer src="Js/main.js"></script>
</body>
</html>