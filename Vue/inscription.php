<section class="inscription">
    <form action="index.php?uc=inscription&action=inscription" method="POST">
        <fieldset>
            <legend>Créer un compte</legend>
            <p>
                <label for="nom">Nom :
                <input type="text" name="nom" id="nom" maxlength="45">
            </label>
            </p>
            <p>
                <label for="Prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" maxlength="45">
            </p>
            <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" required id="pseudo">
            </p>
            <p>
                <label for="mdp">Mot de passe :</p></label>
                <input type="password" name="mdp" id="mdp" maxlength="45">
            </p>
            <p>
            <label for="email">Adresse mail :</label>
            <input type="email" name="email" required id="email">
            </p>   
            <p>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse"required id="adresse">
            </p>
            <p>
            <label for="adresse">Complément :</label>
            <input type="text" name="complement_adresse" id="adresse">
            </p>
            <p>
            <label for="code_postal">Code postal</label>
            <input type="int" name="cp" required id="code_postal">
            </p>
            <p>
            <label for="ville">ville</label>
            <input type="text" name="ville" required id="ville">
            </p>
            <p>
                <input type="submit" value="S'enregistrer" name="valider">
                <input type="reset" value="Annuler" name="annuler"> 
            </p>




        </fieldset>
    </form>

</section>
