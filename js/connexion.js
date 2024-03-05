// Bar navigation responsive "icon".

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
let email = document.getElementById('email');
let password = document.getElementById('password');
let errorEmail = document.getElementById('errorEmail');
let errorPassword = document.getElementById('errorPassword');

form.addEventListener('submit', (e) => {
  let emailValue = email.value.trim();
  let passwordValue = password.value.trim();
  let regexEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

  // Validation email

  if(emailValue === '') {
    errorEmail.innerHTML = 'Vous devez avoir une adresse mail.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (emailValue.length > 50) {
    errorEmail.innerHTML = 'Votre adresse mail est trop longue.';
    email.value = '';
    e.preventDefault(); 
  } else if (!regexEmail.test(emailValue)) {
    errorEmail.innerHTML = 'Votre adresse mail est invalide.';
    e.preventDefault(); 
  }

  // Validation password 

  if(passwordValue === '') {
    errorPassword.innerHTML = 'N\'oubliez pas votre mot de passe.';
    e.preventDefault(); 
  } else if (passwordValue.length > 50) {
    errorPassword.innerHTML = 'Votre mot de passe est trop long.';
    password.value = '';
    e.preventDefault(); 
  } 
});

email.addEventListener('input', () => {
  errorEmail.innerHTML = '';
});

password.addEventListener('input', () => {
  errorPassword.innerHTML = '';
});

// Create waiting time
// TO REWORK IF WAITING TIME
// document.getElementById('submit').addEventListener('click', function () {
//   setTimeout(function () {
//     alert("Fonction exécutée après un délai de 2 secondes");
//   }, 5000);
// });