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
    $req3 .= "VALUES (':adresse', ':complement_adresse', ':code_postal_id', ':ville_id')";
    $statement3 = $conn->prepare($req3);
    $statement3->bindParam(':adresse', $adresse);
    $statement3->bindParam(':complement_adresse', $complement_adresse);
    $statement3->bindParam(':code_postal_id', $idCp);
    $statement3->bindParam(':ville_id', $idVille);
    $statement3->execute();
    $idAdresse = $conn->lastInsertId();

    $req4 = "INSERT INTO lafleur_clients(nom_client, prenom_client, email_client, mot_de_passe, telephone, lafleur_adresses_id) ";
    $req4 .= "VALUES (':nom',':prenom', ':email', ':mdp', ':tel', ':adId')";
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
        afficheErreurs();
        afficheMessage($e);
    }


   
}


public static function chercherClient($id) {
    $conn = AccesDonnees::getPdo();
    $req = "SELECT nom, prenom, email, adresse, complement_adresse, cp, ville FROM lafleur_clients WHERE id = :id";
    $statement = $conn->prepare($req);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

public static function clientExiste($email): bool
{
    $conn = AccesDonnees::getPdo();
    $req = 'SELECT id FROM lafleur_clients ';
    $req .= 'WHERE pseudo = :login';
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
$req = "SELECT id, mdp FROM lafleur_clients WHERE email = :email";
$stmt = $conn->prepare($req);
$stmt->bindParam(':email', $email);
$stmt->execute();

$data = $stmt->fetch();

$mdp_bdd = $data['mdp'];

if(!password_verify($mdp, $mdp_bdd))
{
    $data['id'] = false;
}
return $data['id'];
}


}

