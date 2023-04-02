<section>
  <div class="annonce-container">
    <?php if (!isset($_POST['resultat'])) : ?>
      <h2 class="titre">Tentez votre chance pour gagner un lot original ! (3 essais)</h2>
      <div id="annonce">
        <p id="annonce-texte">Loterie spéciale 'Fête des mères' ... 
          des stylos “Lafleur”  ...
          des sacs réutilisables en tissu “Lafleur”  ...
          Un porte-clés “Lafleur”   ...
          Une rose rouge à offrir  ...
          Un bouquets de roses  ...
        </p>

      </div>

    <?php endif ?>
    <?php
    if (isset($_POST['resultat'])) : ?>
      <h2><?= $_POST['resultat']['message'] ?></h2>
    <?php endif ?>

  </div>
  <div class="loterie-container">
    <div class="slot-item">
      <div class="slot-img">
        <img src="assets/img/bleu.jpg" class="img" alt="">
      </div>
    </div>
    <div class="slot-item">
      <div class="slot-img">
        <img src="assets/img/blanc.jpg" class="img" alt="">
      </div>
    </div>
    <div class="slot-item">
      <div class="slot-img">
        <img src="assets/img/rouge.jpg" class="img" alt="">
      </div>
    </div>
  </div>
  <div class="jackpot-container">

    <button class="jackpot btn">Jouer</button>
  </div>
  <h3 class="resultat centre "></h3>
  <div class="btn-container">
  <a href="index.php?uc=panier&action=infoPanier"><button class="btn centre">retour au panier</button></a>
  </div>
  <script defer src="main.js"></script>

</section>