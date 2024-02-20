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

// Condition form

let form = document.getElementById('form');
let username = document.getElementById('name')
let description = document.getElementById('textarea');

form.addEventListener('submit', (e) => {
  let usernameValue = username.value.trim();
  let regexName = /^[a-zA-Z-\s]+$/;
  let errorName = document.getElementById('errorName');
  errorName.style.color = 'red';

  // Validation name
  if(usernameValue === '') {
    errorName.innerHTML = 'Vous devez avoir un prénom.'; 
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (usernameValue.length > 30) {
    errorName.innerHTML = 'Votre prénom est trop long.'; 
    e.preventDefault(); 
  } else if (usernameValue.length < 2) {
    errorName.innerHTML = 'Votre prénom est trop court.'; 
    e.preventDefault(); 
  } else if (!regexName.test(usernameValue)) {
    errorName.innerHTML = 'Votre prénom ne peut comporter que des lettres ou des tirets.'; 
    e.preventDefault(); 
  }



/* Plusieurs probleme a corriger, notamment le regex description 
ainsi que des petits bug (lorsque c 'est bon toujours le message d'erreur) 
et ajouter des conditions pour la description, ex supp a 1000mots stop etc..

*/

  let descriptionValue = description.value.trim();
  let regexDescription = /^[a-zA-Z0-9,:;!?.]*$/;
  let errorDesc = document.getElementById('errorDesc');
  errorDesc.style.color = 'red';


  // Validation description
  if (descriptionValue === ''){
    errorDesc.innerHTML = 'Vous devez écrire un avis pour envoyer le formulaire.'; 
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (!regexDescription.test(descriptionValue)) {
    errorDesc.innerHTML = 'Vous ne pouvez utiliser que des chiffres, des lettres ou , . : ;'; 
    e.preventDefault(); 
}
});
