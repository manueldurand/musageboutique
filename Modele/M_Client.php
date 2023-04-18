<?php

class M_Client
{

    public static function existeEmail($email)
    {
        $conn = AccesDonnees::getpdo();
        $stmt = $conn->prepare("SELECT * FROM musage_clients WHERE email_client = :d");
        $stmt->bindParam(":d", $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public static function creerClient($nom, $prenom, $mdp, $email, $adresse, $complement_adresse, $tel, $cp, $ville)
    {

        $conn = AccesDonnees::getpdo();
        $conn->beginTransaction();

        try {
            $mdp = password_hash($mdp, PASSWORD_BCRYPT);

            $idVille = M_Client::verifieVille($ville);
            $idCp = M_Client::verifieCp($cp);

            $req3 = "INSERT INTO musage_adresses(adresse, complement_adresse, code_postal_id_id, ville_id_id) ";
            $req3 .= "VALUES (:adresse, :complement_adresse, :code_postal_id, :ville_id)";
            $statement3 = $conn->prepare($req3);
            $statement3->bindParam(':adresse', $adresse);
            $statement3->bindParam(':complement_adresse', $complement_adresse);
            $statement3->bindParam(':code_postal_id', $idCp);
            $statement3->bindParam(':ville_id', $idVille);
            $statement3->execute();
            $idAdresse = $conn->lastInsertId();

            $req4 = "INSERT INTO musage_clients(nom_client, prenom_client, email_client, mot_de_passe, telephone, adresse_id_id) ";
            $req4 .= "VALUES (:nom,:prenom, :email, :mdp, :tel, :adId)";
            $statement4 = $conn->prepare($req4);
            $statement4->bindParam(':nom', $nom);
            $statement4->bindParam(':prenom', $prenom);
            $statement4->bindParam(':email', $email);
            $statement4->bindParam(':mdp', $mdp);
            $statement4->bindParam(':tel', $tel);
            $statement4->bindParam(':adId', $idAdresse);
            $statement4->execute();

            $conn->commit();
            // afficheMessage('inscription réussie');
            return $conn->query('SELECT LAST_INSERT_ID()')->fetchColumn();
        } catch (PDOException $e) {

            $conn->rollback();
            afficheMessage($e);
        }
    }

    /**
     * vérifie si une ville existe dans la table musage_villes et récupère son id si elle existe,
     * crée une entrée dans la table musage_villes sinon
     *
     * @param string $ville
     * @return int $idVille
     */
    public static function verifieVille($ville)
    {
        $conn = AccesDonnees::getpdo();
        $req = "SELECT id FROM musage_villes WHERE nom_ville = :v";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':v', $ville);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data != null) {
            return $data['id'];
        } else {
            $req3 = "INSERT INTO musage_villes(nom_ville) VALUES (:v)";
            $statement = $conn->prepare($req3);
            $statement->bindParam(':v', $ville);
            $statement->execute();
            return $conn->lastInsertId();
        }
    }


    /**
     * récupère l'id du code postal de la table code_postal s'il existe, ou en crée un nouveau
     *
     * @param string $cp
     * @return int $idCp
     */
    public static function verifieCp($cp)
    {
        $conn = AccesDonnees::getpdo();
        $req = "SELECT id FROM musage_code_postal WHERE code_postal = :c";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':c', $cp);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data != null) {
            return $data['id'];
        } else {
            $req2 = "INSERT INTO musage_code_postal(code_postal) VALUES (:cp)";
            $statement = $conn->prepare($req2);
            $statement->bindParam(':cp', $cp);
            $statement->execute();
            return $conn->lastInsertId();
        }
    }


    /**
     * récupère les informatons du client à partir de son id
     *
     * @param int $idClient
     * @return void
     */
    public static function chercherClient($id_client)
    {
        $conn = AccesDonnees::getPdo();
        $req = "SELECT nom_client, prenom_client, email_client, telephone, adresse, complement_adresse, code_postal, nom_ville ";
        $req .= "FROM musage_clients JOIN musage_adresses ON musage_adresses.id = musage_clients.adresse_id_id ";
        $req .= "JOIN musage_code_postal ON musage_code_postal.id = musage_adresses.code_postal_id_id ";
        $req .= "JOIN musage_villes ON musage_villes.id = musage_adresses.ville_id_id WHERE musage_clients.id = :id";
        $statement = $conn->prepare($req);
        $statement->bindParam(':id', $id_client);
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
    public static function getPrenom($idClient)
    {
        $conn = AccesDonnees::getPdo();
        $req = 'SELECT prenom_client FROM musage_clients ';
        $req .= 'WHERE id = :id';
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
        $req = 'SELECT id FROM musage_clients ';
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
        $req = "SELECT id, mot_de_passe FROM musage_clients WHERE email_client = :email";
        $stmt = $conn->prepare($req);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $data = $stmt->fetch();

        $mdp_bdd = $data['mot_de_passe'];

        if (!password_verify($mdp, $mdp_bdd)) {
            $data['id'] = false;
        }
        return $data['id'];
    }
}
