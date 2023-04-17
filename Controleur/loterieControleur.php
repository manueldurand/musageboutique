<?php
session_start();

include_once 'Modele/M_Lot.php';




    
    // Récupération des données envoyées via la requête AJAX
    $message = $_POST['message'];
    $idLot = $_POST['idLot'];
    $counter = $_POST['counter'];

    //test si le lot est en stock 

    //   if (M_Lot::verifieStockLot($idLot)) {
    //     $idLot = $idLot;
    //   }  
    //   else {
    //     while(($idLot>1) && (!M_Lot::verifieStockLot($idLot-1))) {
    //         $idLot--;
    //     } 
    // };



 

    $_SESSION['loterie'] = array(
        'message' => $message,
        'idLot' => $idLot,
        'counter' => $counter
    );
    // echo $_SESSION['resultat']['message'];

    // var_dump($_POST['resultat']);
//   $_SESSION['loterie'] = $_POST['resultat'];
//   $idLot = $_SESSION['loterie']['idLot'];
//   $compteur = $_SESSION['loterie']['counter'] ;
//  $message = $_SESSION['loterie']['message'] ;
 $resultatsLoterie = [];
 $resultatsLoterie[] = [$compteur, $idLot];
 $_SESSION['resultatsLoterie'] = $resultatsLoterie;



  echo "$message (essai $compteur)";
    // var_dump($message);








