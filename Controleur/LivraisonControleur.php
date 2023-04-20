<?php

// on récupère la ville entrée dans le formulaire, on filtre, 
// et met en majuscules pour chercher si la ville est dans la liste de livraison $listeLivraison
if(isset($_POST['chercher'])){
    $ville = trim(filter_input(INPUT_POST, 'ville'));
    if(verifieVille($ville)){
        $_SESSION['message'] = "Nous pouvons vous livrer, vous pouvez continuer votre commande !";
        $_SESSION['livraison'] = true;
    } else {
        $_SESSION['message'] = "Nous sommes désolés, votre adresse ne figure pas encore dans notre rayon de livraison. 
        Nous livrons pour le moment quelques communes autour de Lourmarin, veuillez-nous contacter pour plus de précisions. 
        Venez commander en boutique, la région est magnifique, si vou ne l'avez pas fait, visitez notre Blog !";
        $_SESSION['livraison'] = false;
}
    header('Location: index.php?uc=messages');
}
