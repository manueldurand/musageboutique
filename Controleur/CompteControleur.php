<?php

include_once 'Modele/M_Produit.php';
include_once 'Modele/M_Client.php';
include_once 'Modele/M_Commande.php';



switch ($action) {
    case 'inscription':
        if (isset($_POST['valider'])) {
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $email = filter_input(INPUT_POST, 'email');
            $mdp = filter_input(INPUT_POST, 'mdp');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $complement_adresse = filter_input(INPUT_POST, 'complement_adresse');
            $tel = filter_input(INPUT_POST, 'telephone');
            $cp = filter_input(INPUT_POST, 'cp');
            $ville = filter_input(INPUT_POST, 'ville');
        }
        $champs = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdp,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville
        );

        $erreurs = validerFormulaire($champs);

        if (count($erreurs) > 0) {
            // Affichage des erreurs
            afficheErreurs($erreurs);
            // vérifie si l'email existe déjà
        } else if (M_Client::existeEmail($email)) {
            afficheMessage("cet email existe déjà, si c'est bien vous allez à la  page de connexion. Sinon veuillez choisir une autre adresse mail.");
            $uc = 'inscription';
        } else {
            try {
                $id_nouveau_client = M_Client::creerClient($nom, $prenom, $mdp, $email, $adresse, $complement_adresse, $tel, $cp, $ville);
                // afficheMessage("Félicitations, votre compte a bien été créé");

            } catch (\PDOException $e) {
                echo $e;
                afficheMessage("erreur, veuillez recommencer la saisie");
                die;
            }
        }
        $_SESSION['prenom_client'] = $prenom;
        $_SESSION['id_client'] = $id_nouveau_client;

header('location: index.php?uc=bienvenue&action=consulter');
        break;

    case 'connexion': {
            if (isset($_POST['connexion'])) {
                $email = trim(filter_input(INPUT_POST, 'email'));
                $mdp = filter_input(INPUT_POST, 'mdp');

                if (M_Client::clientExiste($email) && (M_Client::checkMdp($email, $mdp))) {
                    $id_client = $_SESSION['id_client'] = M_Client::checkMdp($email, $mdp);

                    // var_dump($_SESSION);
                    $prenom = $_SESSION['prenom_client'] = M_Client::getPrenom($id_client);
                    
                    // afficheMessage("Bienvenue $prenom");
                    $uc = 'bienvenue';
                    break;
                } else $_SESSION['message'] = "Erreur d'authentification, veuillez esssayer à nouveau";
                header('location: index.php?uc=messages');

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
                $prenom = $_SESSION['prenom_client'] = M_Client::getPrenom($id_client);
                $_SESSION['message'] = "Bienvenue de nouveau, $prenom ;)";
                header('location: index.php?uc=messages');
                var_dump($_SESSION['id_client']);
                break;
            }
        }
    case 'consulter':
        $id_client = intval($_SESSION['id_client']);
        $data = M_Client::chercherClient($id_client);
        $commandes = M_Commande::trouveLesCommandes($id_client);
        // var_dump($commandes);
        foreach ($commandes as $commande) {
            foreach ($commande as $id_commande) {
                $infos_commandes[] = M_Commande::trouveLesInfos($id_commande);
                $montants_commandes[] = M_Commande::calculeLeMontant($id_commande);
            }
        }
        $tableau_commandes = recapCommandes($infos_commandes, $montants_commandes);
        // var_dump($infos_commandes);
        // var_dump($montants_commandes);
        // var_dump($tableau_commandes);
        break;
    case 'modifier':
        $idClient = $_SESSION['id_client'];
        $data = M_Client::chercherClient($id_client);
        break;


}
