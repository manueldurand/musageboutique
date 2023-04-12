<section >
    <div class="detail-produit">
    <div class="images">
        <div class="image-container">
            <img src="assets/img/comp/<?= $produit['image1'] ?>" class="image-grande" alt="photo du produit">
        </div class="card-prix">
        <p class="prix"><?= $produit['prix']?>€</p>

    </div>
    <div class="cadre-produit">
        <h2 class="nom-produit"><?= $produit['nom_plante']." ".$produit['nom_couleur'] ?></h2>
        <h4><?= $produit['type_unite']?></h4>
        <p class="description-produit">
            <?= $produit['description'] ?>
        </p>
        <form class="ajouter-panier" method="POST" action="index.php?uc=panierConfirmer&action=ajoutPanier&produit=<?= $produit['id_produit'] ?>">
            <label for="quantite">Quantité
            <input type="number" size="2" value="1" min="1" max="50" name="quantite" id="quantite"></label>
            <input type="hidden" value="<?=$produit?>" name="produit">
            <input type="submit" name="ajouter" value="ajouter" class="btn btn-ajouter">
        </form>


    </div>        
    </div>

    <form class="centre">
  <input class="btn centre m-2" type="button" value="Retour" onclick="history.go(-1)">
</form>

</section>