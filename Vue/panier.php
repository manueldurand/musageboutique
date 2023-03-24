<section>
    <h1>
       Mon Panier
    </h1>        
    <?php 


<div class="panier-articles">
    <div class="detail-article">

    </div>
 <div >article n° :
    <?= $article[0] ?>
 </div>
 <p>quantité :</p>
 <p><?= $article[1]?></p>
</div>
<div class="panier-prix">

</div>


       <?php endforeach; } else echo 'votre panier est vide' ?>
    

    


</section>