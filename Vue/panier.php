<section>
   <h1 class="titre-container" >
      MON PANIER
   </h1>
   <div class="panier-container">
      <ul class="panier-articles">
         <?php
         if (isset($_SESSION['panier']) && (!empty($articlesPanier))) {
            foreach ($articlesPanier as $article) :
         ?>
               <li class="detail-article">
                  <img src="assets/img/comp/<?= $article[2]['image'] ?>" class="border" alt="image_produit">
                  <?= $article[1]['nom_produit'] ?>
                  <?= $article[4] ?> X <?= $article[3]['prix'] ?> = <?=$article[4]*$article[3]['prix']  ?> €
                  <a href="index.php?uc=panier&produit=<?= $article[0] ?>&action=supprimerUnProduit"  onclick="return confirm('Voulez-vous vraiment retirer cet article ?');"> 
                  <span><img src="assets/icones/bin.svg" ></span></a>

               </li>
         <?php endforeach; ?>

      </ul>
      <div class="panier-prix">
         <?php $sous_total = 0;
         foreach ($articlesPanier as $article) {
            $sous_total += floatval($article[3]['prix'] * $article[4]);
         }

         ?>
         <p>         <span class="aligne-gauche">Sous-total : </span><span class="aligne-droite"><?= number_format($sous_total, '2', '.','') ?> €</span>
</p>
         <p>Livraison : <?php if ($sous_total < 50) {
                           echo $prixLivraison = 2.99;
                        } else {
                           echo 'offerte';
                           $prixLivraison = 0;
                        } ?></p>
         <p>Total : <?= number_format($sous_total + $prixLivraison, '2','.',''); ?> €</p>

         <?php   } else echo 'votre panier est vide' ?>

      </div>
   </div>









</section>