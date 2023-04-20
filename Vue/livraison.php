<section>
    <h3 class="titre centre">VERIFIONS AVANT TOUT SI NOUS POUVONS VOUS LIVRER</h3>

    <div class="light-bg-50 centre">
        <div class="form-cont">
            <form action="index.php?uc=livraison" method="POST">
                <label for="ville">Entrez votre commune :
                    <input type="text" class="centre" name="ville" value="">
                </label>
                <div class="btn-container">
                    <input class="btn centre" type="submit" name="chercher" value="chercher">
                </div>
            </form>
        </div>
        <div class="fake-height">
            <p class=" centre reponse">
                    <?php if (isset($message)) : ?>
                    <?= $message; ?>
                    <?php endif ?>
                </p>
        </div>
    </div>



</section>