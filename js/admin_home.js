
const choose = document.getElementById('choose');
const updateForm = document.getElementById("update_form");
const chooseAdmin = document.getElementById('chooseAdmin');

choose.addEventListener('change', function() {
  const chooseValue = choose.value;

  let oldLabel = document.getElementById("label");
  let oldInput = document.getElementById("input");

  if (oldLabel) {
    oldLabel.remove();
  }
  if (oldInput) {
    oldInput.remove();
  }
 
  switch (chooseValue) {
    case "1":
      let label1 = document.createElement("label");
      label1.setAttribute("for", "update_name");
      label1.setAttribute("id", "label")
      label1.textContent = "Le nouveau nom de l'habitat :";

      let input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("id", "input")
      input1.setAttribute("name", "update_name");

      chooseAdmin.appendChild(label1);
      chooseAdmin.appendChild(input1);
      break;
    case "2":
      let label2 = document.createElement("label");
      label2.setAttribute("for", "main_image");
      label2.setAttribute("id", "label")
      label2.textContent = "Sélectionner une nouvelle photo principale :";

      let input2 = document.createElement("input");
      input2.setAttribute("type", "file");
      input2.setAttribute("id", "input")
      input2.setAttribute("name", "main_image");


      chooseAdmin.appendChild(label2);
      chooseAdmin.appendChild(input2);
      break;
    case "3":
      let label3 = document.createElement("label");
      label3.setAttribute("for", "second_image");
      label3.setAttribute("id", "label")
      label3.textContent = "Sélectionner une nouvelle photo secondaire :";

      let input3 = document.createElement("input");
      input3.setAttribute("type", "file");
      input3.setAttribute("id", "input")
      input3.setAttribute("name", "second_image");

      chooseAdmin.appendChild(label3);
      chooseAdmin.appendChild(input3);
      break;
    case "4":
      let label4 = document.createElement("label");
      label4.setAttribute("for", "update_main_title");
      label4.setAttribute("id", "label")
      label4.textContent = "Le nouveau titre principal :";

      let input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("id", "input")
      input4.setAttribute("name", "update_main_title");

      chooseAdmin.appendChild(label4);
      chooseAdmin.appendChild(input4);
      break;
    case "5":
      let label5 = document.createElement("label");
      label5.setAttribute("for", "update_second_title");
      label5.setAttribute("id", "label")
      label5.textContent = "Le nouveau titre secondaire :";

      let input5 = document.createElement("input");
      input5.setAttribute("type", "text");
      input5.setAttribute("id", "input")
      input5.setAttribute("name", "update_second_title");

      chooseAdmin.appendChild(label5);
      chooseAdmin.appendChild(input5);
      break;
    case "6":
      let label6 = document.createElement("label");
      label6.setAttribute("for", "update_content");
      label6.setAttribute("id", "label")
      label6.textContent = "Le nouveau contenu :";

      let input6 = document.createElement("textarea");
      input6.setAttribute("type", "text");
      input6.setAttribute("name", "update_content");
      input6.setAttribute("id", "input")
      input6.setAttribute("rows", "5");
      input6.setAttribute("cols", "50");

      chooseAdmin.appendChild(label6);
      chooseAdmin.appendChild(input6);
      break;
    case "7":
      let label7 = document.createElement("label");
      label7.setAttribute("for", "update_third_title");
      label7.setAttribute("id", "label")
      label7.textContent = "Le nouveau troisième titre :";

      let input7 = document.createElement("input");
      input7.setAttribute("type", "text");
      input7.setAttribute("id", "input")
      input7.setAttribute("name", "update_third_title");

      chooseAdmin.appendChild(label7);
      chooseAdmin.appendChild(input7);
      break;
  }
})

// form delete habitat

function confirmDelete() {
  let confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet habitat ?");
  if (confirmation) {
    return true;
  } else {
    return false;
  }
}