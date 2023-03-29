const items = [
    'gerbera-blanc',
    'gerbera-blanc',
    'gerbera-bleu',
    'gerbera-bleu',
    'gerbera-jaune',
    'gerbera-jaune',
    'gerbera-jaune',
    'gerbera-jaune',
    'gerbera-jaune',
    'gerbera-jaune',
    'gerbera-rouge',
    'gerbera-rouge',
    'lotus',

  ]
  document.querySelector('.jackpot')
.addEventListener('click', () => {


  document.querySelectorAll('.img').forEach((imgElmt, index) => {
    const randomTime = 2500 + 1000 * index 
    randomizeImgs(imgElmt, randomTime)
  })
})

const randomizeImgs = (imgElmt, time) => {
  const timeInterval = setInterval(() => {
    imgElmt.classList.remove('animate')

    chooseRandom(imgElmt)
  }, 100)
  setTimeout(() => {
    imgElmt.classList.remove('animate')
    clearInterval(timeInterval)
    checkResults()
  }, time);

}
const chooseRandom = (imgElmt) => {
  const random = Math.floor(Math.random()*items.length);
  const selectedItem = items[random];
  imgElmt.src = `assets/img/${selectedItem}.jpg`
  imgElmt.classList.add('animate')
}

const checkResults = () => {
  const imgSrcs = []
  document.querySelectorAll('img').forEach(img => {
    imgSrcs.push(img.src)
  })

  const counters = {
    'gerbera': 0,
    'gerbera-blanc': 0,
    'gerbera-bleu': 0,
    'gerbera-jaune': 0,
    'gerbera-rouge': 0,
    'lotus': 0,
    'rose': 0,
    'tournesol': 0
  }

  imgSrcs.forEach(src => {
    const selectedItem = src.split('/').pop().split('.')[0]
    counters[selectedItem]++
  })

  const matchingItems = Object.entries(counters).filter(([item, count]) => count === 2)

  if (matchingItems.length === 1) {
    const selectedItem = matchingItems[0][0]

    if (selectedItem.startsWith('gerbera')) {
      // Attribuer un lot "gerbera"
      console.log('un stylo')
    } else if (selectedItem === 'rose') {
      // Attribuer un lot "rose"
      console.log('une rose')
    } else if (selectedItem === 'lotus') {
      // Attribuer un lot "lotus"
      console.log('un bouquet au choix !')
    } else if (selectedItem === 'tournesol') {
      // Attribuer un lot "tournesol"
      console.log('un porte-clefs')
    } else {
      // Attribuer un lot par défaut
      console.log('un BISOU')
    }
  }
  else {
    console.log('un grand MERCI');
  }
}



//const checkResults = () => {
  //const imgSrcs = []
  //document.querySelectorAll('img').forEach(img => {
  //  imgSrcs.push(img.src)
 //})

 // if (imgSrcs.every(src => src === imgSrcs[0])) {
  //  const selectedItem = imgSrcs[0].split('/').pop().split('.')[0]

    //if (selectedItem.startsWith('gerbera')) {
      // Attribuer un lot "gerbera"
      //console.log('un stylo')
   // } else if (selectedItem === 'rose') {
      // Attribuer un lot "rose"
  //    console.log('une rose')
//    } else if (selectedItem === 'lotus') {
      // Attribuer un lot "lotus"
    //  console.log('un bouquet au choix !')
//    } else if (selectedItem === 'tournesol') {
      // Attribuer un lot "tournesol"
  //    console.log('un porte-clefs')
  //  } else {
      // Attribuer un lot par défaut
   // }
 // }
//}

