<?php

class M_Client {


// public static function existePseudo($pseudo){
//     $conn = AccesDonnees::getpdo();
//     $stmt = $conn->prepare("SELECT * FROM lafleur_clients WHERE pseudo = :p" );
//     $stmt->bindParam(":p", $pseudo);
//     $stmt->execute();
//     $user = $stmt->fetch();
//     if($user){
//         return true;
//     }else {
//         return false;
//     }       
// }
public static function existeEmail($email){
    $conn = AccesDonnees::getpdo();
    $stmt = $conn->prepare("SELECT * FROM lafleur_clients WHERE email_client = :d" );
    $stmt->bindParam(":d", $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
        return true;
    }else {
        return false;
    }       
}

public static function creerClient($nom, $prenom, $mdp, $email, $adresse, $complement_adresse, $tel, $cp, $ville) {
        
    $conn = AccesDonnees::getpdo();
    $conn->beginTransaction();

try {
    $mdp = password_hash($mdp, PASSWORD_BCRYPT);
    $req1 = "INSERT INTO lafleur_villes(ville) VALUES (:ville)";
    $statement1 = $conn->prepare($req1);
    $statement1->bindParam(':ville', $ville);
    $statement1->execute();
    $idVille = $conn->lastInsertId();

    $req2 = "INSERT INTO lafleur_code_postal(code_postal) VALUES (:cp)";
    $statement2 = $conn->prepare($req2);
    $statement2->bindParam(':cp', $cp);
    $statement2->execute();
    $idCp = $conn->lastInsertId();

    $req3 = "INSERT INTO lafleur_adresses(adresse, complement_adresse, code_postal_id, ville_id) "; 
    $req3 .= "VALUES (:adresse, :complement_adresse, :code_postal_id, :ville_id)";
    $statement3 = $conn->prepare($req3);
    $statement3->bindParam(':adresse', $adresse);
    $statement3->bindParam(':complement_adresse', $complement_adresse);
    $statement3->bindParam(':code_postal_id', $idCp);
    $statement3->bindParam(':ville_id', $idVille);
    $statement3->execute();
    $idAdresse = $conn->lastInsertId();

    $req4 = "INSERT INTO lafleur_clients(nom_client, prenom_client, email_client, mot_de_passe, telephone, lafleur_adresses_id) ";
    $req4 .= "VALUES (:nom,:prenom, :email, :mdp, :tel, :adId)";
    $statement4 = $conn->prepare($req4);
    $statement4->bindParam(':nom', $nom);
    $statement4->bindParam(':prenom', $prenom);
    $statement4->bindParam(':email', $email);
    $statement4->bindParam(':mdp', $mdp);
    $statement4->bindParam(':tel', $tel);
    $statement4->bindParam(':adId', $idAdresse);
    $statement4->execute();
    $idClient = $conn->lastInsertId();

    $conn->commit();
    afficheMessage('inscription réussie');

    } catch (PDOException $e) {

        $conn->rollback();
        afficheMessage($e);
    }  
}

/**
 * vérifie si une ville existe dans la table lafleur_villes et récupère son id si elle existe,
 * sinon créee une nouvelle donnée ville
 *
 * @param string $ville
 * @return int $idVille
 */
public static function verifieVille($ville) {
    $conn = AccesDonnees::getpdo();
    $req = "SELECT * FROM lafleur_villes";
    $stmt = $conn->prepare($req);
    $stmt->execute();
    $villes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $index = array_search($ville, array_column($villes, 'ville'));
    if ($index !== false) {
        return $villes[$index['id_ville']];
    } else {
        return creerVille($ville);
        }
    }

public static function creerVille($ville) {
            $conn = AccesDonnees::getPdo();
            $req = "INSERT INTO lafleurvilles(ville) VALUES (:v)";
            $statement = $conn->prepare($req);
            $statement->bindParam(':v', $ville);
            $statement->execute();
            return $conn->lastInsertId();
}

/**
 * met à jour les informations client récupérées dans le formulaire 'modifier' de la page modifierCompte.php
 *
 * @param string $adresse
 * @param string $complement_adresse
 * @param string $tel
 * @param string $cp
 * @param string $ville
 * @return void
 */
public static function modifierClient($idClient, $adresse, $complement_adresse, $tel, $cp, $ville) {
$conn = AccesDonnees::getPdo();
$conn->beginTransaction();
//mise à jour de la ville
$req0 = "UPDATE lafleur_villes SET ville = :v JOIN lafleur_adresses ON lafleur_adresses.ville_id = lafleur_villes.id_ville ";
$req0 .="JOIN lafleur_clients ON lafleur_clients.lafleur_adresse_id = lafleur_adresses.id_adresse WHERE lafleur_clients.id_client = :cli";
$stmt0 = $conn->prepare($req0);
$stmt0->bindParam(':v', $ville);
$stmt0->bindParam(':cli', $idClient);
$stmt0->execute();
// mise à jour du code postal
$req1 = "UPDATE lafleur_code_postal SET code_postal = :c JOIN lafleur_adresses ON lafleur_adresses.id__code_postal = lafleur_code_postal.id_code_postal";
$req1 .= "JOIN lafleur_clients ON lafleur_clients.lafleur_adresse_id = lafleur_adresses.id_adresse WHERE lafleur_clients.id_client = :cli";
$stmt1 = $conn->prepare($req1);
$stmt1->bindParam(':c', $cp);
$stmt1->bindParam(':cli', $idCllient);

// mise à jour de l'adresse et du complément d'adresse
$req2 = "UPDATE lafleur_adresses SET adresse = :a, complement_adresse = :comp ";
$req2 .= "JOIN lafleur_clients ON lafleur_clients.lafleur_adresses_id = lafleur_adresses.id_adresse WHERE id_client = :cli";
$stmt2 = $conn->prepare($req1);
$stmt2->bindParam(':a', $adresse);
$stmt2->bindParam(':comp', $complement_adresse);
$stmt2->bindParam(':cli', $_SESSION['id_client']);
$stmt2->execute();

$req3 = "UPDATE lafleur_clients SET telephone = :tel";
$stmt3 = $conn->prepare($req3);
$stmt3->bindParam(':tel', $tel);
$stmt3->execute();
}

/**
 * récupère les informatons du client à partir de son id
 *
 * @param int $idClient
 * @return void
 */
public static function chercherClient($idClient) {
    $conn = AccesDonnees::getPdo();
    $req = "SELECT nom_client, prenom_client, email_client, telephone, adresse, complement_adresse, code_postal, ville ";
    $req .= "FROM lafleur_clients JOIN lafleur_adresses ON lafleur_adresses.id_adresse = lafleur_clients.lafleur_adresses_id ";
    $req .= "JOIN lafleur_code_postal ON lafleur_code_postal.id_code_postal = lafleur_adresses.code_postal_id ";
    $req .= "JOIN lafleur_villes ON lafleur_villes.id_ville = lafleur_adresses.ville_id WHERE lafleur_clients.id_client = :id";
    $statement = $conn->prepare($req);
    $statement->bindParam(':id', $idClient);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}
/**
 * récupère le prénom du client à partir de son Id
 *
 * @param int $idClient
 * @return void
 */
public static function getPrenom($idClient) {
    $conn = AccesDonnees::getPdo();
    $req = 'SELECT prenom_client FROM lafleur_clients ';
    $req .= 'WHERE id_client = :id';
    $stmt = $conn->prepare($req);
    $stmt->bindParam(":id", $idClient);
    $stmt->execute();
    return $stmt->fetch()['prenom_client'];
    
}
/**
 * vérifie si un client existe à partir de son email
 *
 * @param string $email
 * @return boolean
 */
public static function clientExiste($email): bool
{
    $conn = AccesDonnees::getPdo();
    $req = 'SELECT id_client FROM lafleur_clients ';
    $req .= 'WHERE email_client = :login';
    $stmt = $conn->prepare($req);
    $stmt->bindParam(":login", $email);
    $stmt->execute();

    // L'identification est bonne si la requête a retourné
    // une ligne (l'utilisateur existe )
    // Si c'est le cas $existe contient 1, sinon elle est
    // vide. Il suffit de la retourner en tant que booléen.
    if ($stmt->rowCount() > 0) {
        // ok, il existe
        $existe = true;
    } else {
        $existe = false;
    }
    return $existe;
}
/**
 * Vérifie le mot de passe entré pour la connexion 
 * et l'association avec le pseudo
 *
 * @param String $pseudo
 * @param String $mdp
 * @return void
 */
public static function checkMdp(String $email, String $mdp)
{
$conn = AccesDonnees::getPdo();
$req = "SELECT id_client, mot_de_passe FROM lafleur_clients WHERE email_client = :email";
$stmt = $conn->prepare($req);
$stmt->bindParam(':email', $email);
$stmt->execute();

$data = $stmt->fetch();

$mdp_bdd = $data['mot_de_passe'];

if(!password_verify($mdp, $mdp_bdd))
{
    $data['id_client'] = false;
}
return $data['id_client'];
}


}

