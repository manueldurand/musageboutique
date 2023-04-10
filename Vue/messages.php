<section>
    <h3 class="titre centre">
        <?php if(isset($_SESSION['message'])) { echo
         $_SESSION['message'] ;  
        }  ?>
    </h3>
    <div class="btn-container">
        <a href="index.php?uc=panier&action=infoPanier"><button class="btn centre">voir mon panier</button></a>
        <a href="index.php?uc=boutique&action=tousLesProduits"><button class="btn centre">voir la boutique</button></a>
        <a href="index.php?uc=inscription"><button class="btn centre">S'inscrire</button></a>
        <a href="index.php?uc=connexion"><button class="btn centre">Se connecter</button></a>
    </div>
</section>