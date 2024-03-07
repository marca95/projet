// Condition form 
console.log('error');
let form = document.getElementById('form');
let nameInput = document.getElementById('name');
let firstNameInput = document.getElementById('first_name');
let emailInput = document.getElementById('email');
let passwordInput = document.getElementById('password');

nameInput.addEventListener('input', function() {
  upperCaseFirstLetter(nameInput);
});

firstNameInput.addEventListener('input', function() {
  upperCaseFirstLetter(firstNameInput);
});

form.addEventListener('submit', (e) => {

  if (passwordInput.value.length > 6) {
    // errorPassword = 'Il faut au minimum 6 caractères';
    alert('Pas assez de caracteres');
    e.preventDefault()
  }
})


function upperCaseFirstLetter(input) {
  let value = input.value.trim();
  value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();

  input.value = value;
}