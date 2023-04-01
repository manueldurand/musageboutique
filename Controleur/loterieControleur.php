<?php
if(isset($_POST['resultat'])) {
    var_dump($_POST['resultat']['message']);
    die;
    $resultat = json_decode($_POST['resultat'], true);
    // Traiter le résultat ici
    // Récupérer le résultat en tant que chaîne de caractères JSON envoyée depuis JavaScript
$resultat_json = $_POST['resultat'];

// Convertir la chaîne JSON en tableau associatif
$resultat = json_decode($resultat_json, true);

// Extraire le message de l'objet résultat et l'afficher sur la page
$message = $resultat['message'];
echo $message;
  } else {
    echo "Le résultat n'a pas été envoyé.";
  }

?>
