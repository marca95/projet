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
let nameInput = document.getElementById('name');
let firstNameInput = document.getElementById('first_name');
let usernameInput = document.getElementById('username');
let emailInput = document.getElementById('email');
let passwordInput = document.getElementById('password');
let passwordInput2 = document.getElementById('password2');
let birthDate = document.getElementById('birthday');
let hiring = document.getElementById('hire');
let errorInput = document.getElementById('errorInput');

nameInput.addEventListener('input', function () {
  upperCaseFirstLetter(nameInput);
});

firstNameInput.addEventListener('input', function () {
  upperCaseFirstLetter(firstNameInput);
});

form.addEventListener('submit', (e) => {

  let regex = /^[a-zA-Z\s-]+$/;
  let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  // Condition to be 18 years
  let dateBirthday = new Date(birthDate.value);
  let today = new Date();
  let controlAge = today.getFullYear() - dateBirthday.getFullYear();
  let dateHiring = new Date(hiring.value);

  if (nameInput.value.length === '') {
    errorInput.innerHTML = 'Vous devez avoir un nom.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (nameInput.value.length > 50) {
    errorInput.innerHTML = 'Maximum 50 caractères.';
    nameInput.value = '';
    e.preventDefault();
  } else if (!regex.test(nameInput.value)) {
    errorInput.innerHTML = 'Vous ne pouvez utiliser que des lettres ou des -';
    nameInput.value = '';
    e.preventDefault();
  }

  if (firstNameInput.value.length === '') {
    errorInput.innerHTML = 'Vous devez avoir un prénom.';
    e.preventDefault();
  } else if (firstNameInput.value.length > 50) {
    errorInput.innerHTML = 'Maximum 50 caractères.';
    firstNameInput.value = '';
    e.preventDefault();
  } else if (!regex.test(firstNameInput.value)) {
    errorInput.innerHTML = 'Vous ne pouvez utiliser que des lettres ou des -';
    firstNameInput.value = '';
    e.preventDefault();
  }

  if (usernameInput.value.length === '') {
    errorInput.innerHTML = 'Vous devez avoir un username.';
    e.preventDefault();
  } else if (usernameInput.value.length > 50) {
    errorInput.innerHTML = 'Votre username est trop long.';
    usernameInput.value = '';
    e.preventDefault();
  } else if (!regexEmail.test(usernameInput.value)) {
    errorInput.innerHTML = 'Votre username n\'a pas un format correct.';
    usernameInput.value = '';
    e.preventDefault();
  }

  if (emailInput.value.length === '') {
    errorInput.innerHTML = 'Vous devez avoir une adresse mail.';
    e.preventDefault();
  } else if (emailInput.value.length > 50) {
    errorInput.innerHTML = 'Votre adresse mail est trop longue.';
    emailInput.value = '';
    e.preventDefault();
  } else if (!regexEmail.test(emailInput.value)) {
    errorInput.innerHTML = 'Votre adresse mail n\'a pas un format correct.';
    emailInput.value = '';
    e.preventDefault();
  }

  if (passwordInput.value.length < 6) {
    errorInput.innerHTML = 'Mot de passe trop court, il vous faut au minimum 6 caractères.';
    e.preventDefault()
  } else if (passwordInput.value.length > 100) {
    errorInput.innerHTML = 'Votre mot de passe est trop long.';
    passwordInput.value = '';
    e.preventDefault();
  }

  if (passwordInput2.value !== passwordInput.value) {
    errorInput.innerHTML = 'Mot de passe pas identique.';
    e.preventDefault()
  }

  if (dateBirthday > today) {
    errorInput.innerHTML = 'Date invalide.';
    e.preventDefault()
  } else if (controlAge < 18) {
    errorInput.innerHTML = 'Cette personne n\'est pas majeur.';
    e.preventDefault()
  } else if (controlAge > 100) {
    errorInput.innerHTML = "Il y a une erreur avec l'âge de la personne";
    e.preventDefault()
  }

  if (dateHiring > today) {
    errorInput.innerHTML = 'Vous avez dépassé la date d\'aujourd\'hui.';
    e.preventDefault()
  } else if (dateHiring < today.getFullYear() - 100) {
    errorInput.innerHTML = 'Date d\'engagement invalide.';
    e.preventDefault()
  }
})

function upperCaseFirstLetter(input) {
  let value = input.value.trim();
  value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();

  input.value = value;
}

function clearSuccess() {
  let successMessage = document.getElementById('success');
  if (successMessage) {
    successMessage.innerHTML = '';
  }
}

// Fonction de validation de l'heure
function validateHour(value) {
  let regex = /^(\d{2}h\d{0,2})?$/;

  if (!regex.test(value)) {
    return false;
  }
  return true;
}

document.querySelector('.form_hour').addEventListener('submit', function (event) {
  let timeInputs = document.querySelectorAll('.form_hour input[type="text"]');

  for (let input of timeInputs) {
    if (!validateHour(input.value)) {
      alert('Veuillez saisir les heures au format HHhMM.');
      event.preventDefault();

      return;
    }
  }
});

// form delete animal

function confirmDelete() {
  let confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
  if (confirmation) {
    return true;
  } else {
    return false;
  }
}