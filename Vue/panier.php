<section>
    <h1>
        Panier
    </h1>
<?php

if(isset($_SESSION['id'])) {

} else {
    ?>
    <h3>
        <?= $message ?>
    </h3>
<?php } ?>
</section>