<section>
    <h1 class="titre centre">MODIFIER MES INFORMATIONS</h1>
    <div class="compte-container bg">
        <div class="cadre-info">
            <p>
                Nom: <?= $data[0]['nom_client'] ?>
            </p>
            <p>
                Prénom: <?= $data[0]['prenom_client'] ?>
            </p>
            <form action="index.php?uc=compte&action=modifierCompte" method="POST">
                <div class="col">
                    <p>
                        <label for="adresse">Adresse :</label>
                        <input type="text" name="adresse" required id="adresse" value="<?= $data[0]['adresse'] ?>" placeholder="<?= $data[0]['adresse'] ?>">
                    </p>
                    <p>
                        <label for="adresse">Complément :</label>
                        <input type="text" name="complement_adresse" id="complement" value="<?= $data[0]['complement_adresse'] ?>" placeholder="<?= $data[0]['complement_adresse'] ?>">
                    </p>
                    <p>
                        <label for="telephone">Téléphone</label>
                        <input type="text" name="telephone" required id="telephone" value="<?= $data[0]['telephone'] ?>" placeholder="<?= $data[0]['telephone'] ?>">
                    </p>
                    <p>
                        <label for="code_postal">Code postal :</label>
                        <input type="int" name="cp" required id="code_postal" value="<?= $data[0]['code_postal'] ?>" placeholder="<?= $data[0]['code_postal'] ?>">
                    </p>
                    <p>
                        <label for="ville">ville :</label>
                        <input type="text" name="ville" required id="ville" value="<?= $data[0]['ville'] ?>" placeholder="<?= $data[0]['ville'] ?>">
                    </p>
                </div>

                <input type="hidden" name="id_client" value="$data[0]['id_client']">
                <button class="btn centre  " name="modifier" >modifier mes informations</button>
            </form>
        </div>
    </div>


</section>