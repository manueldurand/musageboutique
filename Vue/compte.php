<section>
    <h1 class="titre centre">ESPACE CLIENT</h1>
    <div class="compte-container bg">
        <div class="cadre-info">
                    <p>
            Nom: <?= $data[0]['nom_client'] ?>
        </p>
        <p>
            Prénom: <?= $data[0]['prenom_client'] ?>
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
            Code Postal: <?= $data[0]['code_postal'] ?>
        </p>
        <p>
            Ville: <?= $data[0]['ville'] ?>
        </p>
        <p>
            Email: <?= $data[0]['email_client'] ?>
        </p>
        <p>
            Téléphone: <?= $data[0]['telephone'] ?>
        </p>
        <form action="index.php?uc=modifierCompte&action=consulter" method="POST">
        <input type="hidden" name="id_client" value="$data[0]['id_client']">
            <button class="btn centre ">modifier mes informations</button>
        </form>
        </div>
    </div>


</section>