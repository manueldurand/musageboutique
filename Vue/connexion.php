<section>
    <h3 class="titre centre">Entrez vos identifiants de connexion</h3>
    <div class="connexion-container">
        <form action="index.php?uc=connexion&action=connexion" method="POST" class="form-inscription">
            <p>
                <label for="pseudo">Email : </label>
                <input type="text" id="email" name="email">
            </p>
            <p>
                <label for="mdp">Mot de passe : </label>
                <input type="password" id="mdp" name="mdp">
            </p>
            <div class="btn-container">
                <input class="btn" type="submit" name="connexion" value="connexion">
            </div>
        </form>
    </div>
    <div class="center-box centre">
    <p class="m-2 centre">Vous n'avez pas de compte ?</p>
    <a href="index.php?uc=inscription"><div class="btn centre m-2">inscription</div></a>        
    </div>


</section>