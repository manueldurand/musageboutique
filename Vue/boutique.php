<section class="boutique">
    <div class="aside-menu">
        <ul>
            <li class="item" id="menu1">
                <a class="btn" href="#menu1">
                    Catégories</a>
                <div class="sous-menu">
                    <a href="#">Mariage</a>
                    <a href="#">Amour</a>
                    <a href="#">Remerciements</a>
                    <a href="#">Anniversaire</a>
                    <a href="#">Naissance</a>
                </div>

            </li>
            <li class="item" id="menu2">
            <a class="btn" href="#menu2">
                Couleurs</a>
                <div class="sous-menu">
                <a href="#">rouge</a>
                    <a href="#">rose</a>
                    <a href="#">bleu</a>
                    <a href="#">orange</a>
                    <a href="#">blanc</a>
                </div>
            </li>
            <li class="item">
            <a href="#">Fleurs à l'unité</a></li>
            <li class="item">
            <a href="#">Bouquets</a></li>
            <li class="item">
            <a href="#">Fleurs séchées</a></li>
            <li class="item">
            <a href="#">Orchidées</a></li>
        </ul>
    </div>
    <div class="boutique-container">
      <h1 class="titre-container">BOUTIQUE</h1>

    <div class="produits-container">

        <?php 
        foreach ($produits  as $produit) : ?>
            <div class="card-produit">
                <a href="index.php?uc=voirProduit&action=voir&idProduit=<?= $produit['idProduit'] ?>">
                    <div class="card-image">
                        <img class="image-card" src="assets/img/comp/<?= $produit['image1'] ?>" alt="photo de fleur">
                    </div>
                    <div class="card-nom">
                        <p><?= $produit['nom_plante']." ". $produit['nom_couleur'] ?></p>
                        <p><?= $produit['type_unite']?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>   
    </div>
   




</section>