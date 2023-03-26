<?php

include_once 'Modele/M_Produit.php';
include_once 'Modele/M_Client.php';



switch ($action) {
    case 'inscription':
        if (isset($_POST['valider'])) {
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $pseudo = filter_input(INPUT_POST, 'pseudo');
            $mdp = filter_input(INPUT_POST, 'mdp');
            $email = filter_input(INPUT_POST, 'email');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $complement_adresse = filter_input(INPUT_POST, 'complement_adresse');
            $cp = filter_input(INPUT_POST, 'cp');
            $ville = filter_input(INPUT_POST, 'ville');
        }
        $champs = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'mdp' => $mdp,
            'email' => $email,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville
        );

        $erreurs = validerFormulaire($champs);

        if (count($erreurs) > 0) {
            // Affichage des erreurs
            afficheErreurs($erreurs);
            // verifie si le pseudo existe déjà
        } else if (M_Client::existePseudo($pseudo)) {
            afficheMessage("ce pseudo existe déjà, si c'est bien vous allez à la  page de connexion. Sinon veuillez choisir un autre pseudo.");
            $uc = 'inscription';
            // vérifie si l'email existe déjà
        } else if (M_Client::existeEmail($email)) {
            afficheMessage("cet email existe déjà, si c'est bien vous allez à la  page de connexion. Sinon veuillez choisir une autre adresse mail.");
            $uc = 'inscription';
        } else {
            try {
                M_Client::creerClient($nom, $prenom, $pseudo, $mdp, $email, $adresse, $complement_adresse, $cp, $ville);
                afficheMessage("Félicitations, votre compte a bien été créé");
                $uc = '';
            } catch (\PDOException $e) {
                echo $e;
                afficheMessage("erreur, veuillez recommencer la saisie");
                die;
            }
        }
        break;

    case 'connexion': {
            if (isset($_POST['connexion'])) {
                $pseudo = trim(filter_input(INPUT_POST, 'pseudo'));
                $mdp = filter_input(INPUT_POST, 'mdp');

                if (M_Client::clientExiste($pseudo) && (M_Client::checkMdp($pseudo, $mdp))) {
                    $_SESSION['id'] = M_Client::checkMdp($pseudo, $mdp);
                    $_SESSION['pseudo'] = $pseudo;
                    var_dump($_SESSION);
                    afficheMessage('Bienvenue ' . $pseudo);
                    $uc = '';
                    break;
                } else afficheMessage('Erreur d\'authentification, veuillez esssayer à nouveau');
                break;
            } else afficheMessage('Erreur');
            break;
        }

    case 'deconnexion': {
            $confirmation = filter_input(INPUT_POST, 'ok');
            $annul = filter_input(INPUT_POST, 'annuler');
            if (isset($confirmation)) {
                $_SESSION = [];
    
                session_destroy();
                header('location: index.php?uc=accueil');
                break;
            }
    
            if (isset($annul)) {
                afficheMessage('welcome back, ' . $_SESSION['pseudo'] . ' !');
                $uc = '';
                break;
            }
    }
}