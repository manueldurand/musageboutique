const items = [
  "blanc",
  "blanc",
  "bleu",
  "bleu",
  "jaune",
  "jaune",
  "blanc",
  "blanc",
  "bleu",
  "bleu",
  "jaune",
  "jaune",
  "jaune",
  "jaune",
  "jaune",
  "jaune",
  "jaune",
  "jaune",
  "rouge",
  "rouge",
  "lotus",
  "lotus",
  "lotus",

];
const RESULTAT = document.querySelector('.resultat')
let jackpotCounter = 0;
document.querySelector(".jackpot").addEventListener("click", () => {
  jackpotCounter++;
  console.log(jackpotCounter);

  document.querySelectorAll(".img").forEach((imgElmt, index) => {
    const randomTime = 2500 + 1000 * index;
    randomizeImgs(imgElmt, randomTime);
  });

  setTimeout(() => {
    const resultat = evaluerLoterie();
    console.log(resultat);
    RESULTAT.textContent = resultat[resultat]
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
        jackpot = true;
      }
      return {
        resultat: `Trois ${color}!`,
        jackpot: jackpot,
        images: images,
      };
    }
  }

  return {
    resultat: "Désolé, vous n'avez pas gagné.",
    jackpot: false,
    images: images,
  };
}

// La première ligne utilise la méthode querySelectorAll pour sélectionner tous les éléments de la page HTML qui ont la classe CSS "img". Cela renvoie un tableau de tous les éléments correspondants.

// La deuxième ligne utilise la méthode forEach pour boucler sur chaque élément du tableau renvoyé par querySelectorAll. Pour chaque élément, une fonction est exécutée.

// La troisième ligne utilise la propriété src de l'élément de l'image pour obtenir l'URL de la source de l'image. Ensuite, nous utilisons la méthode split pour diviser l'URL en parties en utilisant le caractère slash "/" comme délimiteur. Cela nous donne un tableau de parties qui composent l'URL.

// La quatrième ligne utilise la méthode pop pour extraire le dernier élément du tableau retourné par split. Cela donne le nom du fichier image sans le chemin d'accès.

// La cinquième ligne utilise la méthode push pour ajouter le nom du fichier image au tableau images.

// La sixième ligne utilise le nom du fichier image pour incrémenter un compteur dans l'objet counts. Nous utilisons la méthode split pour séparer le nom de fichier en parties en utilisant le caractère point "." comme délimiteur. Cela nous donne un tableau de parties qui composent le nom de fichier. Nous utilisons ensuite la première partie (l'élément 0) pour déterminer la couleur de l'image et incrémenter le compteur de cette couleur dans l'objet counts.

// En résumé, cette partie de code permet de récupérer le nom de chaque image affichée sur la page, de stocker ces noms dans un tableau et d'incrémenter un compteur pour chaque couleur d'image. Cela nous permet de déterminer si le joueur a gagné la loterie en vérifiant si le tableau counts contient trois occurrences de chaque couleur.
