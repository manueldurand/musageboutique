<section>
    <div class="titre centre">

        <h3 class="w-50 mt-5 line-height">
            <?php if (isset($_SESSION['message'])) {
                echo
                $_SESSION['message'];
            }  ?>
    </h3>
</div>
    <div class="btn-container">
        <a href="index.php?uc=panier&action=infoPanier"><button class="btn centre">voir mon panier</button></a>
        <a href="index.php?uc=boutique&action=tousLesProduits"><button class="btn centre">voir la boutique</button></a>
        <?php if (!isset($_SESSION['id_client'])) : ?>
            <a href="index.php?uc=inscription"><button class="btn centre">S'inscrire</button></a>
            <a href="index.php?uc=connexion"><button class="btn centre">Se connecter</button></a>
        <?php endif ?>
        <?php if (isset($_SESSION['id_client'])) : ?>
            <a href="index.php?uc=compte&action=consulter"><button class="btn centre">Mon compte</button></a>
            <a href="index.php?uc=deconnexion"><button class="btn centre">Déconnexion</button></a>
        <?php endif ?>
    </div>
        <form class="centre mt-5">
            <input class="btn centre" type="button" value="Retour" onclick="history.go(-1)">
        </form>


</section>