<section>
    <div class="annonce-container">
<?php if(!isset($_POST['resultat'])) : ?>
        <h1 class="titre">Tentez votre chance pour gagner un lot original !</h1>
          <p>
            des stylos “Lafleur”, 
            des sacs réutilisables en tissu “Lafleur”, 
          </p>
          <p>
            Un porte-clés “Lafleur”, 
            Une rose rouge à offrir, 
            Un bouquets de roses    
          </p>
          <?php endif ?>
          <?php
if(isset($_POST['resultat'])) : ?> 
     <h2><?= $_POST['resultat']['message'] ?></h2> 
     <?php endif ?> 
     
    </div>
    <div class="loterie-container">
  <div class="slot-item">
    <div class="slot-img">
      <img src="assets/img/bleu.jpg"class="img" alt="">
    </div>
  </div>
  <div class="slot-item">
    <div class="slot-img">
      <img src="assets/img/blanc.jpg"class="img" alt="">
    </div>
  </div>
  <div class="slot-item">
    <div class="slot-img">
      <img src="assets/img/rouge.jpg" class="img"alt="">
    </div>
  </div>
</div>
<div class="jackpot-container">

    <button class="jackpot btn">Jouer</button>
</div>
<h3 class="resultat centre "></h3>
  <script defer src="main.js"></script>

</section>