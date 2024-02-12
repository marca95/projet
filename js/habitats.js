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