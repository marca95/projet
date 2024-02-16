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

let btns = document.querySelectorAll("button");
let habitatDescriptions = document.querySelectorAll("div.hidden");
let lis = document.querySelectorAll("li.li_animals");
let hidAnimals = document.querySelectorAll("div.hidAnimal");

btns.forEach((btn, index) => {
    btn.addEventListener('click', () => hideDiv(habitatDescriptions, index))
})

 lis.forEach((li, index) => {
   li.addEventListener('click', () => {hideDiv(hidAnimals, index);}
     )
 })

 function hideDiv(x, index) {
   if(x[index].style.display == "block"){
     x[index].style.display = "none";
 } else {
   x[index].style.display = "block";
 }
 }


//  function toggleAnimalDescriptions(index) {
//    hideAllAnimals();
//    showAnimal(index);
//  }
//  function hideAllAnimals() {
//    hidAnimals.forEach((description) => description.classList.add("hidAnimal"));
//  }
//  function showAnimal(index) {
//    hidAnimals[index].classList.remove("hidAnimal");
//  }


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