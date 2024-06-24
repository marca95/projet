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

// Condition form and ajax request

let form = document.getElementById('form');
let username = document.getElementById('name')
let description = document.getElementById('textarea');
let errorName = document.getElementById('errorName');
let errorDesc = document.getElementById('errorDesc');

form.addEventListener('submit', (e) => {
  // e.preventDefault();


  let usernameValue = username.value.trim();
  let regexName = /^[a-zA-Z0-9\s.,;:'"éàè!?-]*$/;
  let descriptionValue = description.value.trim();
  let regexDescription = /^[a-zA-Z0-9\s.,;:'"éàè!?-]*$/;
  let maxwords = descriptionValue.split(/\s+/).length;

  // Validation name

  if (usernameValue === '') {
    errorName.innerHTML = 'Vous devez avoir un prénom.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (usernameValue.length > 30) {
    errorName.innerHTML = 'Votre prénom est trop long.';
    username.value = '';
    e.preventDefault();
  } else if (usernameValue.length < 2) {
    errorName.innerHTML = 'Votre prénom doit contenir au moins 2 lettres.';
    e.preventDefault();
  } else if (!regexName.test(usernameValue)) {
    errorName.innerHTML = 'Votre prénom ne peut comporter que des lettres ou des tirets.';
    e.preventDefault();
  }

  // Validation description

  if (descriptionValue === '') {
    errorDesc.innerHTML = 'Vous devez écrire un avis pour envoyer le formulaire.';
    e.preventDefault(); // Empeche soumission du formulaire
  } else if (!regexDescription.test(descriptionValue)) {
    errorDesc.innerHTML = 'Vous ne pouvez utiliser que des chiffres, des lettres ou des points de ponctuactions';
    e.preventDefault();
  } else if (maxwords > 1000) {
    errorDesc.innerHTML = 'Vous devez écrire - de 1000 mots.';
    e.preventDefault();
  } else if (descriptionValue.length > 6000) {
    errorDesc.innerHTML = 'Il y a trop de caractères.';
    e.preventDefault();
  }

  let data = new FormData(form);
  let xhr = new XMLHttpRequest();
  let message = document.querySelector('.message');
  message.innerHTML = '';

  xhr.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        message.innerHTML = 'Votre avis a été envoyé avec succès, merci !';
        // console.log(this.response);
      } else {
        message.innerHTML = '<span style="color: red; font-weight: bold;">Il y a eu un problème lors de l\'envoi de votre avis.</span>';
        console.log(this.response);
      }
    }
  };

  xhr.open("POST", "../mariadb/form_avis.php", true);
  xhr.send(data);
});


username.addEventListener('input', () => {
  errorName.innerHTML = '';
});

description.addEventListener('input', () => {
  errorDesc.innerHTML = '';
});