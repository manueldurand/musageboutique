<section>
   <h1 class="titre-container">
      MON PANIER
   </h1>
   <div class="panier-container">


      
      
      
      <?php
            if (isset($_SESSION['panier']) && (!empty($articlesPanier))) {
               ?>
                  <table class="panier-articles">
                     <tbody>
                     <?php foreach ($articlesPanier as $article) : ?>
                  <tr scope="row" class="detail-article">
                     <td>
                        <img src="assets/img/comp/<?= $article[2]['image'] ?>" class="border" alt="image_produit">
                     </td>
                     <td> <?= $article[1]['nom_produit'] ?></td>
                     <td><?= $article[4] ?> X <?= $article[3]['prix'] ?> = <?= $article[4] * $article[3]['prix']  ?> €</td>
                     <td><a class="aligne-droite" href="index.php?uc=panier&produit=<?= $article[0] ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                           <span><img class="centre" src="assets/icones/bin.svg"></span></a></td>

                  </tr>
               <?php endforeach; ?>
         </tbody>
      </table>
      <div class="panier-prix">
         <?php $sous_total = 0;
               foreach ($articlesPanier as $article) {
                  $sous_total += floatval($article[3]['prix'] * $article[4]);
               }

         ?>
         <p><span class="aligne-gauche">Sous-total : </span><span class="aligne-droite"><?= number_format($sous_total, '2', '.', '') ?> €</span>
         </p>
         <p><span class="aligne-gauche">Livraison : </span><span class="aligne-droite"><?php if ($sous_total < 50) {
                                                                                          echo $prixLivraison = 2.99;
                                                                                       } else {
                                                                                          echo 'offerte';
                                                                                          $prixLivraison = 0;
                                                                                       } ?> €</span></p>
         <p><span class="aligne-gauche">Total : </span><span class="aligne-droite"><?= number_format($sous_total + $prixLivraison, '2', '.', ''); ?> €</span></p>
         <p>
            <span class="aligne-gauche">Date de la livraison :</span>
            <span class="aligne-droite">
               <input class="date-form" type="number" name="date_jour" value="<?php echo date('d'); ?>" min="1" max="31" step="1" size="2" />
               <input class="date-form" type="number" name="date_mois" value="<?php echo date('m'); ?>" min="1" max="12" step="1" size="2" />
               <input class="date-form" type="number" name="date_annee" value="<?php echo date('Y'); ?>" step="1" size="5" />
            </span>
         <div class="btn-container">
            <a href="index.php?uc=commander"><button class="btn centre marge-40">Commander</button></a>
         </div>
         <p class="centre text-comment">La livraison est offerte à partir de 50€ de commande.</p>

      <?php   } else echo 'votre panier est vide' ?>

      </div>
   </div>









</section>