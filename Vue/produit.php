<section >
    <div class="detail-produit">
    <div class="images">
        <div class="image-container">
            <img src="assets/img/comp/<?= $produit['image'] ?>" class="image-grande" alt="photo du produit">
        </div class="card-prix">
        <p class="prix">9.99 €</p>

    </div>
    <div class="cadre-produit">
        <h2 class="nom-produit"><?= $produit['nom_produit'] ?></h2>
        <p class="description-produit">
            <?= $produit['description'] ?>
        </p>
        <form class="ajouter-panier" method="POST" action="index.php?uc=commander&action=ajoutPanier&produit=<?= $produit['id'] ?>">
            <label for="quantite">Quantité
            <input type="number" size="2" value="1" min="1" max="50" id="quantite"></label>
            <input type="submit" value="Ajouter" class="btn btn-ajouter">
        </form>


    </div>        
    </div>

    <form class="btn-retour">
  <input class="btn centre" type="button" value="Retour" onclick="history.go(-1)">
</form>

</section>