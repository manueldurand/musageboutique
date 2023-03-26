<section>
    <h3 class="titre centre">VERIFIEZ SI NOUS POUVONS VOUS LIVRER</h3>
    <form action="index.php?uc=livraison" method="POST">
        <div class="btn-container">

            <label for="ville">Entrez votre commune : 
                <input class="centre" type="text" name="ville" value="">
                <input class="btn centre" type="submit" name="chercher" value="chercher">
            </label>
        </div>
    </form>
    <p>
        <?php if(isset($message)) {
          echo  $message;
        }  ?>
    </p>
</section>