<?php


    
    // Récupération des données envoyées via la requête AJAX
    $message = $_POST['message'];
    $idLot = $_POST['idLot'];
    $counter = $_POST['counter'];
 
    
    // Stockage des données dans la variable de session
    $_SESSION['resultat'] = array(
        'message' => $message,
        'idLot' => $idLot,
        'counter' => $counter
    );
    // echo $message;
    echo $_SESSION['resultat']['message'];









