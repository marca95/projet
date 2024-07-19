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
let title = document.getElementById('title');
let email = document.getElementById('email');
let description = document.getElementById('description');
let errorTitle = document.getElementById('errorTitle');
let errorEmail = document.getElementById('errorEmail');
let errorDesc = document.getElementById('errorDescr');

form.addEventListener('submit', (e) => {
  let titleValue = title.value.trim();
  let emailValue = email.value.trim();
  let descValue = description.value.trim();
  let regexTitle = /^[a-zA-Z0-9\s.,;:'"éàè!?-]*$/;
  let regexEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
  let maxwords = descValue.split(/\s+/).length;

  // Validation title

  if (titleValue === '') {
    errorTitle.innerHTML = 'Vous devez avoir un titre.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (titleValue.length > 50) {
    errorTitle.innerHTML = 'Votre titre est trop long.';
    title.value = '';
    e.preventDefault();
  } else if (titleValue.length < 2) {
    errorTitle.innerHTML = 'Votre titre est trop court.';
    e.preventDefault();
  } else if (!regexTitle.test(titleValue)) {
    errorTitle.innerHTML = 'Votre titre ne peut comporter que des lettres, des chiffres ou des points de ponctuations.';
    e.preventDefault();
  }

  // Validation email 

  if (emailValue === '') {
    errorEmail.innerHTML = 'Vous devez avoir une adresse mail.';
    e.preventDefault();
  } else if (emailValue.length > 50) {
    errorEmail.innerHTML = 'Votre adresse mail est trop longue.';
    email.value = '';
    e.preventDefault();
  } else if (!regexEmail.test(emailValue)) {
    errorEmail.innerHTML = 'Adresse mail invalide.';
    e.preventDefault();
  }

  // Validation description

  if (descValue === '') {
    errorDesc.innerHTML = 'Il doit y avoir une description.';
    e.preventDefault();
  } else if (!regexTitle.test(descValue)) {
    errorDesc.innerHTML = 'Vous ne pouvez utiliser que des chiffres, des lettres ou des points de ponctuactions';
    e.preventDefault();
  } else if (maxwords > 1000) {
    errorDesc.innerHTML = 'Vous devez écrire - de 1000 mots.';
    e.preventDefault();
  } else if (descValue.length > 6000) {
    errorDesc.innerHTML = 'Il y a trop de caractères.';
    e.preventDefault();
  }
});


// Peut etre essayé si j'essaye sur le form.addEventListener
title.addEventListener('input', () => {
  errorTitle.innerHTML = '';
});

email.addEventListener('input', () => {
  errorEmail.innerHTML = '';
});

description.addEventListener('input', () => {
  errorDesc.innerHTML = '';
});