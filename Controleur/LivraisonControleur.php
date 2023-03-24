<?php
$listeLivraison = [
    "LOURMARIN",
    "LAURIS",
    "CADENET",
    "CUCURON",
    "PUYVERT",
    "VAUGINES",
    "ANSOUIS",
];
// on récupère la ville entrée dans le formulaire, on filtre, 
// et met en majuscules pour chercher si la ville est dans la liste de livraison $listeLivraison
if(isset($_POST['chercher'])){
$ville = trim(strtoupper(filter_input(INPUT_POST, 'ville')));
if(in_array($ville, $listeLivraison)){
    $message = "Nous pouvons vous livrer, vous pouvez continuer votre commande !";
} else {
    $message = "Nous sommes désolés, votre adresse ne figure pas encore dans notre rayon de livraison, venez visiter la boutique !";
}

}
