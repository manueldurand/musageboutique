<?php

include_once 'Modele/M_Produit.php';
include_once 'Modele/M_Client.php';



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
                $id = M_Client::creerClient($nom, $prenom, $mdp, $email, $adresse, $complement_adresse, $tel, $cp, $ville);
                afficheMessage("Félicitations, votre compte a bien été créé");
                $_SESSION['id_client'] = $idClient;
                $_SESSION['prenom_client'] = $prenom;
                $uc = 'bienvenue';
            } catch (\PDOException $e) {
                echo $e;
                afficheMessage("erreur, veuillez recommencer la saisie");
                die;
            }
        }
        break;

    case 'connexion': {
            if (isset($_POST['connexion'])) {
                $email = trim(filter_input(INPUT_POST, 'email'));
                $mdp = filter_input(INPUT_POST, 'mdp');

                if (M_Client::clientExiste($email) && (M_Client::checkMdp($email, $mdp))) {
                    $idClient = $_SESSION['id_client'] = M_Client::checkMdp($email, $mdp);
                    
                    // var_dump($_SESSION);
                    $prenom = $_SESSION['prenom_client'] = M_Client::getPrenom($idClient);
                    afficheMessage("Bienvenue $prenom");
                    $uc = 'bienvenue';
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
                afficheMessage('welcome back, ' . $_SESSION['prenom_client'] . ' !');
                $uc = '';
                break;
            }
    }
    case 'consulter': 
        $idClient = $_SESSION['id_client'];
        $data = M_Client::chercherClient($idClient);
        break;
    case 'modifier':
        $idClient = $_SESSION['id_client'];
        $data = M_Client::chercherClient($idClient);
        break;
    case 'modifierCompte':
        if(isset($_POST['modifier'])) {
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $email = filter_input(INPUT_POST, 'email');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $complement_adresse = filter_input(INPUT_POST, 'complement_adresse');
            $tel = filter_input(INPUT_POST, 'telephone');
            $cp = filter_input(INPUT_POST, 'cp');
            $ville = filter_input(INPUT_POST, 'ville');
            
        // $champs = array(
        //     'nom' => $nom,
        //     'prenom' => $prenom,
        //     'email' => $email,
        //     'adresse' => $adresse,
        //     'cp' => $cp,
        //     'ville' => $ville
        // );

        // $erreurs = validerFormulaire($champs);       
        // if (count($erreurs) > 0) {
        //     // Affichage des erreurs
        //     afficheErreurs($erreurs);
        // } else {
            try {
                M_Client::modifierClient($adresse, $complement_adresse, $tel, $cp, $ville);
                afficheMessage("Vos informations ont bien été modifiées");
                $_SESSION['id_client'] = $idClient;
                $_SESSION['prenom_client'] = $prenom;
                $uc = 'compte';
            } catch (\PDOException $e) {
                echo $e;
                afficheMessage("erreur, veuillez recommencer la saisie");
                die;
            }
        }
        $data = M_Client::chercherClient($idClient);
        break;
    }




