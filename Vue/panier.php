<section>
   <h1 class="titre-container">
      MON PANIER
   </h1>
   <div class="panier-container">





      <?php
      if (isset($_SESSION['panier']) && (!empty($articles_panier))) {
      ?>
         <table class="panier-articles">
            <tbody>
               <?php foreach ($articles_panier as $article) : ?>
                  <tr scope="row" class="detail-article">
                     <td>
                        <img src="assets/img/comp/<?= $article[4] ?>" class="border" alt="image_produit">
                     </td>
                     <td> <?= $article[1] . " " . $article[2] . ", " . $article[3] ?></td>
                     <td><?= $article[6] ?> X <?= $article[5] ?> = <?= $article[6] * $article[5]  ?> €</td>
                     <td><a class="aligne-droite" href="index.php?uc=panier&produit=<?= $article[0] ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
                           <span><img class="centre" src="assets/icones/bin.svg"></span></a></td>

                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
         <div class="panier-prix">
            <?php $sous_total = 0;
            foreach ($articles_panier as $article) {
               $sous_total += floatval($article[5] * $article[6]);
            }

            ?>
            <p><span class="aligne-gauche">Sous-total : </span><span class="aligne-droite"><?= number_format($sous_total, '2', '.', '') ?> €</span>
            </p>
            <p><span class="aligne-gauche">Livraison : </span><span class="aligne-droite"><?php if ($sous_total < 50) {
                                                                                             echo $prix_livraison = 2.99;
                                                                                          } else {
                                                                                             echo 'offerte';
                                                                                             $prix_livraison = 0;
                                                                                          } ?> €</span></p>
            <p><span class="aligne-gauche">Total : </span><span class="aligne-droite"><?= number_format($sous_total + $prix_livraison, '2', '.', ''); ?> €</span></p>

            <form action="index.php?uc=commander&action=passerCommande" method="POST">
               <input type="hidden" name="prixTotal" value="<?= $sous_total + $prix_livraison ?>">
               <p>
                  <span class="aligne-gauche">Date de la livraison :</span>
                  <span class="aligne-droite">
                     <input class="date-form" type="number" name="jour" value="<?php echo date('d', strtotime('+1 day')); ?>" min="1" max="31" step="1" size="2"  onchange="this.value = this.value.replace(/^(\d)$/, '0$1')"/>
                     <input class="date-form" type="number" name="mois" value="<?php echo date('m'); ?>" min="1" max="12" step="1" size="2" onchange="this.value = this.value.replace(/^(\d)$/, '0$1')" />
                     <input class="date-form" type="number" name="annee" value="<?php echo date('Y'); ?>" step="1" size="5" />
                  </span><br>
               <p>
                  <span class="aligne-gauche">Heure de la livraison :</span>
                  <span class="aligne-droite">
                     <select name="heure">
                        <option value="09" selected>09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                     </select>
                     <select name="minute">
                        <option value="00">00</option>
                        <option value="30">30</option>
                     </select>
                  </span>
               </p><br>
  <?php if(isset($_SESSION['loterie']) && $_SESSION['loterie']['idLot']>0): ?>
   <p>
 <span class="aligne-gauche">Loterie "Fête des mères" :</span>
<span class="aligne-droite"><?= $_SESSION['lot']['nom_lot'] ?></span>     
   </p>


   <div class="btn-container">
      <input type="submit" name="commander" value="Commander" class="btn centre marge-25" onclick="return confirm('Valider votre commande et procéder au paiement ?')">
   </div>
   <?php endif ?>
   <?php if(!isset($_SESSION['loterie']) || $_SESSION['loterie']['idLot'] == 0) :?>
   <input type="submit" name="commander" value="Commander" class="btn centre marge-25">
   <?php endif ?>
            </form>
            <p class="centre text-comment">La livraison est offerte à partir de 50€ de commande.</p>

         <?php   } else echo 'votre panier est vide' ?>

         </div>
   </div>









</section>