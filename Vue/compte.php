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
            Ville: <?= $data[0]['nom_ville'] ?>
        </p>
        <p>
            Email: <?= $data[0]['email_client'] ?>
        </p>
        <p>
            Téléphone: <?= $data[0]['telephone'] ?>
        </p>
        <form action="index.php?uc=modifierCompte&action=consulter" method="POST">
        <input type="hidden" name="id_client" value="$data[0]['id_client']">
            <!-- <button class="btn centre ">modifier mes informations</button> -->
        </form>
        </div>
        <div class="cadre-commandes">
            <table border="1" class="commandes-table">
                <caption>MES COMMANDES</caption>
                <thead>
                    <tr>
                        <th>date :</th>
                        <th>livraison prévue :</th>
                        <th>montant</th>
                        <th>état :</th>
                        <th>bonus</th>
                        <th>livrée le :</th>
                    </tr>
                </thead>
                <?php if(!empty($tableau_commandes)) : ?>
                    <?php foreach ($tableau_commandes as $index => $commande) : ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($commande['date_commande']) ) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($commande['livraison_souhaitee'])) ?></td>
                        <td><?= $commande['montant_commande']  ?> €</td>
                        <td><?= $commande['etat_commande'] ?></td>
                        <td><?= $commande['nom_lot']['nom_lot'] ?></td>
                        <td><?if(isset($commande['date_livraison'])) echo date('d/m/Y H:i', strtotime($commande['date_livraison'])) ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
            </table>
        </div>
        
    </div>

</section>