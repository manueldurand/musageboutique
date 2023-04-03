const items = [
  "blanc", "blanc","blanc","blanc","blanc","blanc","blanc",
  "bleu","bleu","bleu","bleu","bleu","bleu","bleu",
  "rouge","rouge","rouge","rouge","rouge","rouge","rouge",
  "jaune","jaune","jaune","jaune","jaune",
  "jaune","jaune","jaune","jaune","jaune",
  "jaune","jaune","jaune","jaune","jaune",
  "jaune","jaune","jaune","jaune","jaune",
  "lotus","lotus",
];
const RESULTAT = document.querySelector('.resultat')
let jackpotCounter = 0;
const jackpotButton = document.querySelector(".jackpot");
jackpotButton.addEventListener("click", () => {
  jackpotCounter++;
if (jackpotCounter>=3){
  jackpotButton.disabled = true;
}
  document.querySelectorAll(".img").forEach((imgElmt, index) => {
    const randomTime = 2500 + 1000 * index;
    randomizeImgs(imgElmt, randomTime);
    RESULTAT.textContent = '...';
  });

  setTimeout(() => {
    const resultat = evaluerLoterie();
    envoyerResultat(resultat)
  }, 6000);
});

const randomizeImgs = (imgElmt, time) => {
  const timeInterval = setInterval(() => {
    imgElmt.classList.remove("animate");
    chooseRandom(imgElmt);
  }, 100);
  setTimeout(() => {
    imgElmt.classList.remove("animate");
    clearInterval(timeInterval);
  }, time);
};
const chooseRandom = (imgElmt) => {
  const random = Math.floor(Math.random() * items.length);
  const selectedItem = items[random];
  imgElmt.src = `assets/img/${selectedItem}.jpg`;
  imgElmt.classList.add("animate");
};

function evaluerLoterie() {
  const counts = {
    blanc: 0,
    bleu: 0,
    jaune: 0,
    rouge: 0,
    lotus: 0,
  };
  let jackpot = false;
  const images = [];

  document.querySelectorAll(".img").forEach((imgElmt) => {
    const src = imgElmt.src.split("/").pop();
    images.push(src);
    counts[src.split(".")[0]]++;
  });

  for (const color in counts) {
    if (counts[color] === 3) {
      if (color === "lotus") {
        return {
          message: "Trois lotus ! vous gagnez un bouquet !",
          idLot: 5,
          counter: jackpotCounter,
        }
      }
      else if (color === "bleu" || color === "rouge" || color === "blanc"){
        return {
        message: `Trois ${color}! une rose à offrir !`,
          idLot: 4,
        counter: jackpotCounter,
      };
      }
      else if (color === "jaune") {
        return {
          message: "Trois jaunes ! un porte-clés !",
          idLot: 3,
          counter: jackpotCounter,
        }
      }
    }
    else if (counts[color] == 2) {
      if (color === "bleu" || color === "blanc" || color === "rouge") {
        return {
          message: `Deux ${color} ! vous gagnez un sac Lafleur!`,
          idLot: 1,
          counter: jackpotCounter,
        }
      }else if (color === "lotus") {
        return {
          message: "Deux lotus ! vous gagnez une rose !",
          idLot: 4,
          counter: jackpotCounter,
        }
      }
      else if (color === "jaune") {
        return {
          message: "Deux jaunes ! vous gagnez un stylo !",
          idLot: 1,
          counter: jackpotCounter,
        }
      }
    }    
  }

  return {
    message: "Désolé, vous n'avez pas gagné.",
    idLot:0,
    counter: jackpotCounter,
  };
}

function envoyerResultat (resultat) {
  $.ajax({
    type: "POST",
    url: "Controleur/LoterieControleur.php",
    data: {
        message: resultat.message,
        idLot: resultat.idLot,
        counter: resultat.counter
    },
    withCredentials: true,
    success: function(response) {
        RESULTAT.textContent = resultat.message
        console.log(response)
    }
});

}

// function envoyerResultat(resultat) {
//   console.log(resultat)
//   $.ajax({
//     type: "POST",
//     url: "Controleur/LoterieControleur.php",
//     withCredentials: true,
//     data: {resultat: resultat},
//     success: function(response) {
//         console.log(response);
//         RESULTAT.textContent = response;
//     }
//   })
// }
// La première ligne utilise la méthode querySelectorAll pour sélectionner tous les éléments de la page HTML qui ont la classe CSS "img". Cela renvoie un tableau de tous les éléments correspondants.

// La deuxième ligne utilise la méthode forEach pour boucler sur chaque élément du tableau renvoyé par querySelectorAll. Pour chaque élément, une fonction est exécutée.

// La troisième ligne utilise la propriété src de l'élément de l'image pour obtenir l'URL de la source de l'image. Ensuite, nous utilisons la méthode split pour diviser l'URL en parties en utilisant le caractère slash "/" comme délimiteur. Cela nous donne un tableau de parties qui composent l'URL.

// La quatrième ligne utilise la méthode pop pour extraire le dernier élément du tableau retourné par split. Cela donne le nom du fichier image sans le chemin d'accès.

// La cinquième ligne utilise la méthode push pour ajouter le nom du fichier image au tableau images.

// La sixième ligne utilise le nom du fichier image pour incrémenter un compteur dans l'objet counts. Nous utilisons la méthode split pour séparer le nom de fichier en parties en utilisant le caractère point "." comme délimiteur. Cela nous donne un tableau de parties qui composent le nom de fichier. Nous utilisons ensuite la première partie (l'élément 0) pour déterminer la couleur de l'image et incrémenter le compteur de cette couleur dans l'objet counts.

// En résumé, cette partie de code permet de récupérer le nom de chaque image affichée sur la page, de stocker ces noms dans un tableau et d'incrémenter un compteur pour chaque couleur d'image. Cela nous permet de déterminer si le joueur a gagné la loterie en vérifiant si le tableau counts contient trois occurrences de chaque couleur.
// function envoyerResultat(resultat) {
//   // Créez une instance de l'objet XMLHttpRequest
// const xhr = new XMLHttpRequest();

// // Configurez la requête AJAX
// xhr.open('POST', 'Controleur/LoterieControleur.php');
// xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
// xhr.withCredentials = true;

// // Les résultats de la loterie sont stockés dans cet objet
// // const lotteryResults = { /* ... */ };

// // Convertissez l'objet en JSON et envoyez-le au contrôleur PHP
// xhr.send(JSON.stringify(resultat));

// // Gérez la réponse de la requête AJAX
// xhr.onreadystatechange = function(response) {
//   if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
//     // Traitez la réponse de votre contrôleur PHP
//  console.log(response);
//   }
// };

// }