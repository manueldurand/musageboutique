<section>
    <form action="index.php?uc=livraison" method="POST">
        <label for="ville">Entrez votre commune : 
        <input type="text" name="ville" value="">
        <input type="submit" name="chercher" value="chercher">
        </label>
    </form>
    <p>
        <?php if(isset($message)) {
          echo  $message;
        }  ?>
    </p>
</section>