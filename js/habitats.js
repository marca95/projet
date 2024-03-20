// Navbar responsive icon
const links = document.querySelectorAll('nav li');

icon.addEventListener("click", () => {
 nav.classList.toggle("active");
})

links.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove("active");
  });
});

 //get characteristic habitat
 // To be reworked for improvement, 1 function in 2

  function toggleDiv(divId) {
    let selectedDiv = document.getElementById(divId);

   let habitatDescriptions = document.querySelectorAll("div.hidden");

   habitatDescriptions.forEach(function(div) {
     if(div !== selectedDiv) {
       div.style.display = 'none';
     }
   });

    if(selectedDiv.style.display == 'none' || selectedDiv.style.display == '') {
      selectedDiv.style.display = 'block';
    } else {
      selectedDiv.style.display = 'none';
    }
  }

  function toggleImg(divId) {
   let selectedDiv = document.getElementById(divId);

  let animalDescr = document.querySelectorAll("div.hidAnimal");

  animalDescr.forEach(function(div) {
    if(div !== selectedDiv) {
      div.style.display = 'none';
    }
  });

   if(selectedDiv.style.display == 'none' || selectedDiv.style.display == '') {
     selectedDiv.style.display = 'block';
   } else {
     selectedDiv.style.display = 'none';
   }
 }




// Get destination animals 
const fetchTortule = document.getElementById('tortue');
const fetchBird = document.getElementById('oiseau');
const fetchCow = document.getElementById('vache');
const fetchKango = document.getElementById('kango');
const fetchBear = document.getElementById('ours');
const fetchCameleon = document.getElementById('cameleon');
const fetchPanda = document.getElementById('panda');
const fetchMonkey = document.getElementById('gorille');

const getFarm = document.getElementById('getClickFarm');
const getOcean = document.getElementById('getClickOcean');
const getPond = document.getElementById('getClickPond');
const getTaniere = document.getElementById('getClickTaniere');
const getVivarium = document.getElementById('getClickVivarium');
const getBird = document.getElementById('getClickBird');
const getForest = document.getElementById('getClickForest');
const getRanch = document.getElementById('getClickRanch');

let url = window.location.hash.substring(1);

switch(url) {
  case 'vache' :
  getFarm.style.display = 'block';
  fetchCow.style.display = 'block';
  break
  case 'ours' :
    getTaniere.style.display = 'block';
    fetchBear.style.display = 'block';
  break
  case 'tortue' :
    getOcean.style.display = 'block';
    fetchTortule.style.display = 'block';
  break
  case 'panda' :
    getTaniere.style.display = 'block';
    fetchPanda.style.display = 'block';
  break
  case 'oiseau' :
    getBird.style.display = 'block';
    fetchBird.style.display = 'block';
  break
  case 'gorille' :
    getTaniere.style.display = 'block';
    fetchMonkey.style.display = 'block';
  break
  case 'kango' :
    getTaniere.style.display = 'block';
    fetchKango.style.display = 'block';
  break
  case 'cameleon' :
    getVivarium.style.display = 'block';
    fetchCameleon.style.display = 'block';
  break



  case 'foret' :
    getForest.style.display = 'block';
    getForest.style.border = 'yellow 3px solid';
  break
  case 'etang' :
    getPond.style.display = 'block';
    getPond.style.border = 'yellow 3px solid';
  break
  case 'vivarium' :
    getVivarium.style.display = 'block';
    getVivarium.style.border = 'yellow 3px solid';
  break
  case 'pature' :
    getFarm.style.display = 'block';
    getFarm.style.border = 'yellow 3px solid';
  break
  case 'ranch' :
    getRanch.style.display = 'block';
    getRanch.style.border = 'yellow 3px solid';
  break
  case 'taniere' :
    getTaniere.style.display = 'block';
    getTaniere.style.border = 'yellow 3px solid';
  break
  case 'oceanarium' :
    getOcean.style.display = 'block';
    getOcean.style.border = 'yellow 3px solid';
  break
  case 'terre' :
    getForest.style.display = 'block';
    getForest.style.border = 'yellow 3px solid';
  break
}

// Get bouton CRUD articles/animals

const createArticle = document.getElementById('#createArticle');
const updateArticle = document.getElementById('#updateArticle');
const deleteArticle = document.getElementById('#deleteArticle');
const createAnimal = document.getElementById('#createAnimal');
const updateAnimal = document.getElementById('#updateAnimal');
const deleteAnimal = document.getElementById('#deleteAnimal');

createArticle.addEventListener('click', () => {
  console.log('create article ok');
})

updateArticle.addEventListener('click', () => {
  console.log('updateArticle ok');
})

deleteArticle.addEventListener('click', () => {
  console.log('deleteArticle ok');
})

createAnimal.addEventListener('click', () => {
  console.log('createAnimal ok');
})

updateAnimal.addEventListener('click', () => {
  console.log('updateAnimal ok');
})

deleteAnimal.addEventListener('click', () => {
  console.log('deleteAnimal ok');
})