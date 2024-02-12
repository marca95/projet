// Bar nivagation responsive "icon".
const links = document.querySelectorAll('nav li');

icon.addEventListener("click", () => {
 nav.classList.toggle("active");
})

links.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove("active");
  });
});

// Récupération avis form

let form = document.getElementById('form');

form.addEventListener('submit', function(e) {
  let name = document.getElementById('name').value;
  let email = document.getElementById('email').value;
  let avisTrain = document.getElementById('avis_train').value;
  let avisRestaurant = document.getElementById('avis_restaurant').value;
  let avisVisite = document.getElementById('avis_visite').value;
  let avisDivers = document.getElementById('avis_divers').value;


  let regex = /^[a-zA-Z-\s]+$/; //allow 1 space, Up and Lowercase
  
  if (name.value.trim() == '') {
    let error = document.getElementById('error');
    error.innerHTML = "Le champs prénom est requis.";
    error.style.color = 'red';
    e.preventDefault();
  } else if (regex.test(name.value) == false) {
    let error = document.getElementById('error');
    error.innerHTML = "Le prénom de peut comporter que des lettres et un '-'.";
    error.style.color = 'red';
    e.preventDefault();
  }
  
  

})