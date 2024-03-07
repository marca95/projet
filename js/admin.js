// Condition form 
console.log('test');
let form = document.getElementById('form');
let nameInput = document.getElementById('name');
let firstNameInput = document.getElementById('first_name');
let emailInput = document.getElementById('email');
let passwordInput = document.getElementById('password');
let errorForm = document.getElementById('errorForm');

nameInput.addEventListener('input', function() {
  upperCaseFirstLetter(nameInput);
});

firstNameInput.addEventListener('input', function() {
  upperCaseFirstLetter(firstNameInput);
});

form.addEventListener('submit', (e) => {

  errorForm.value = '';

  if (nameInput.value.length === '') {
    errorForm.innerHTML = 'Vous devez avoir un nom.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (nameInput.value.length > 50) {
    errorForm.innerHTML = 'Votre nom est trop long.';
    nameInput.value = '';
    e.preventDefault(); 
  }
  if (firstNameInput.value.length === '') {
    errorForm.innerHTML = 'Vous devez avoir un nom.';
    e.preventDefault(); 
  } else if (firstNameInput.value.length > 50) {
    errorForm.innerHTML = 'Votre prénom est trop long.';
    firstNameInput.value = '';
    e.preventDefault(); 
  }

  if (emailInput.value.length === '') {
    errorForm.innerHTML = 'Vous devez avoir une adresse mail.';
    e.preventDefault(); 
  } else if (emailInput.value.length > 50) {
    errorForm.innerHTML = 'Votre adresse mail est trop longue.';
    emailInput.value = '';
    e.preventDefault(); 
  }

  if (passwordInput.value.length < 6) {
    errorForm.innerHTML = 'Mot de passe trop court, il vous faut au minimum 6 caractères.';
    e.preventDefault()
  } else if (passwordInput.value.length > 50) {
    errorForm.innerHTML = 'Votre mot de passe est trop long.';
    passwordInput.value = '';
    e.preventDefault(); 
  }
})


function upperCaseFirstLetter(input) {
  let value = input.value.trim();
  value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();

  input.value = value;
}