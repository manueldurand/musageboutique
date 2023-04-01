<section>
    <h3 class="titre centre">
        Bienvenue, <?= $_SESSION['prenom_client'] ?>
    </h3>
<div class="btn-container">
    <a href="index.php?uc=compte&action=consulter"><button class="btn">voir mon compte</button></a>
    <a href="index.php?uc=panier&action=infoPanier"><button class="btn">voir mon panier</button></a>
    <a href="index.php?uc=boutique&action=tousLesProduits"><button class="btn">voir la boutique</button></a>
</div>
</section>