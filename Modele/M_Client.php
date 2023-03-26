<?php

class M_Client {


public static function existePseudo($pseudo){
    $conn = AccesDonnees::getpdo();
    $stmt = $conn->prepare("SELECT * FROM lafleur_clients WHERE pseudo = :p" );
    $stmt->bindParam(":p", $pseudo);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
        return true;
    }else {
        return false;
    }       
}
public static function existeEmail($email){
    $conn = AccesDonnees::getpdo();
    $stmt = $conn->prepare("SELECT * FROM lafleur_clients WHERE email = :d" );
    $stmt->bindParam(":d", $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if($user){
        return true;
    }else {
        return false;
    }       
}

public static function creerClient($nom, $prenom, $pseudo, $mdp, $email, $adresse, $complement_adresse, $cp, $ville) {
        
    $conn = AccesDonnees::getpdo();
    $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $req = "INSERT INTO lafleur_clients(nom, prenom, pseudo, mdp, email, adresse, complement_adresse, cp, ville) ";   
        $req .= "VALUES (:nom, :prenom, :pseudo, :mdp, :email, :adresse, :complement_adresse, :cp, :ville)";
        $statement = $conn->prepare($req);
        $statement->bindParam(":nom", $nom);
        $statement->bindParam(":prenom", $prenom);
        $statement->bindParam(":pseudo", $pseudo);
        $statement->bindParam(":mdp", $mdp);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":adresse", $adresse);
        $statement->bindParam(":complement_adresse", $complement_adresse);
        $statement->bindParam(":cp", $cp);
        $statement->bindParam(":ville", $ville);
        return $statement->execute();
            
}
public static function clientExiste($pseudo): bool
{
    $conn = AccesDonnees::getPdo();
    $req = 'SELECT id FROM lafleur_clients ';
    $req .= 'WHERE pseudo = :login';
    $stmt = $conn->prepare($req);
    $stmt->bindParam(":login", $pseudo);
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
public static function checkMdp(String $pseudo, String $mdp)
{
$conn = AccesDonnees::getPdo();
$req = "SELECT id, mdp FROM lafleur_clients WHERE pseudo = :pseudo";
$stmt = $conn->prepare($req);
$stmt->bindParam(':pseudo', $pseudo);
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

