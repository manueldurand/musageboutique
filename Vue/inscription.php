<section class="inscription-container">

<div class="connexion-container">
        <h3 class="marge-40">
            Vous avez déjà un compte ?
        </h3>
        <div class="btn-container">
            <a href="index.php?uc=connexion"><button class="marge-40 btn">Connexion</button></a>
        </div>
    </div>
    <div class="form-inscription">
    <form action="index.php?uc=inscription&action=inscription" method="POST">
  <h1 class="titre-container">CREER UN COMPTE</h1>
  <div class="row">
    <div class="col">
      <p>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" maxlength="45">
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
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" maxlength="45">
      </p>
      <p>
          <label for="email">Adresse mail :</label>
          <input type="email" name="email" required id="email">
        </p>   
    </div>
    <div class="col">
      <p>
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse"required id="adresse">
      </p>
      <p>
        <label for="adresse">Complément :</label>
        <input type="text" name="complement_adresse" id="adresse">
      </p>
      <p>
        <label for="code_postal">Code postal :</label>
        <input type="int" name="cp" required id="code_postal">
      </p>
      <p>
        <label for="ville">ville :</label>
        <input type="text" name="ville" required id="ville">
      </p>
    </div>
  </div>
  <p class="btn-container">
    <input type="submit" value="S'enregistrer" name="valider" class="btn centre">
  </p>
</form>

    </div>

    

</section>
