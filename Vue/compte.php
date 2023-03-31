<section>
    <h1 class="titre centre">ESPACE CLIENT</h1>
    <div class="compte-container bg">
        <div class="cadre-info">
                    <p>
            Nom: <?= $data[0]['nom'] ?>
        </p>
        <p>
            Prénom: <?= $data[0]['prenom'] ?>
        </p>
        <p>
            Adresse: <?= $data[0]['adresse'] ?>
        </p>
        <?php if(!empty($data[0]['complement_adresse'])): ?>
        <p>
            Complément: <?= $data[0]['complement_adresse'] ?>
        </p>
        <?php endif ?>
        <p>
            Code Postal: <?= $data[0]['cp'] ?>
        </p>
        <p>
            Ville: <?= $data[0]['ville'] ?>
        </p>
        </div>

    </div>

</section>