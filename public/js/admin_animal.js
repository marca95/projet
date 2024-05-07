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

// form update animal

const updateForm = document.getElementById('form_update_animal');
const attributAnimal = document.getElementById('attribut_animal');
const resultValue = document.getElementById('result_value');
const optionLocation = document.getElementById('show_choice_origin');
const optionHome = document.getElementById('show_choice_home');

attributAnimal.addEventListener('change', function() {
  const attributValue = attributAnimal.value;

  let oldLabel = document.getElementById("label");
  let oldInput = document.getElementById("input");
  optionHome.value = null;
  optionLocation.value = null;
  optionHome.style.display = 'none';
  optionLocation.style.display = 'none';

  if (oldLabel) {
    oldLabel.remove();
  }
  if (oldInput) {
    oldInput.remove();
  }

switch (attributValue) {
  case "1":
    let label1 = document.createElement("label");
    label1.setAttribute("for", "update_name");
    label1.setAttribute("id", "label")
    label1.textContent = "Le nouveau nom de l'animal : ";

    let input1 = document.createElement("input");
    input1.setAttribute("type", "text");
    input1.setAttribute("id", "input")
    input1.setAttribute("name", "update_name");

    resultValue.appendChild(label1);
    resultValue.appendChild(input1);
    break;

  case "2":
    let label2 = document.createElement("label");
    label2.setAttribute("for", "update_type");
    label2.setAttribute("id", "label")
    label2.textContent = "Son nouveau type : ";

    let input2 = document.createElement("input");
    input2.setAttribute("type", "text");
    input2.setAttribute("id", "input")
    input2.setAttribute("name", "update_type");

    resultValue.appendChild(label2);
    resultValue.appendChild(input2);
    break;

  case "3":
    let label3 = document.createElement("label");
    label3.setAttribute("for", "update_race");
    label3.setAttribute("id", "label")
    label3.textContent = "La nouvelle race de l'animal : ";

    let input3 = document.createElement("input");
    input3.setAttribute("type", "text");
    input3.setAttribute("id", "input")
    input3.setAttribute("name", "update_race");

    resultValue.appendChild(label3);
    resultValue.appendChild(input3);
    break;

  case "4":
    optionHome.style.display = "block";
    break;  

  case "5":
   optionLocation.style.display = "block";
  break;

case "6":
  let label6 = document.createElement("label");
  label6.setAttribute("for", "image");
  label6.setAttribute("id", "label")
  label6.textContent = "Sélectionner une nouvelle photo : ";

  let input6 = document.createElement("input");
  input6.setAttribute("type", "file");
  input6.setAttribute("id", "input")
  input6.setAttribute("name", "image");

  resultValue.appendChild(label6);
  resultValue.appendChild(input6);
  break;

case "7":
  let label7 = document.createElement("label");
  label7.setAttribute("for", "update_common_name");
  label7.setAttribute("id", "label")
  label7.textContent = "Le nouveau nom commun : ";

  let input7 = document.createElement("input");
  input7.setAttribute("type", "text");
  input7.setAttribute("id", "input")
  input7.setAttribute("name", "update_common_name");

  resultValue.appendChild(label7);
  resultValue.appendChild(input7);
  break;
}
    })

// form delete animal

function confirmDelete() {
  let confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet animal ?");
  if (confirmation) {
    return true;
  } else {
    return false;
  }
}