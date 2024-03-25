
const updateForm = document.getElementById("form_update_animal");
const attributAnimal = document.getElementById('attribut_animal');
const showChoice = document.getElementById('show_choice');

attributAnimal.addEventListener('change', function() {
  const attributValue = attributAnimal.value;

  let oldLabel = document.getElementById("label");
  let oldInput = document.getElementById("input");

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
      label1.textContent = "Le nouveau nom de l'animal :";

      let input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("id", "input")
      input1.setAttribute("name", "update_name");

      showChoice.appendChild(label1);
      showChoice.appendChild(input1);
      break;
    case "2":
      let label2 = document.createElement("label");
      label2.setAttribute("for", "update_type");
      label2.setAttribute("id", "label")
      label2.textContent = "Son nouveau type :";

      let input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("id", "input")
      input2.setAttribute("name", "update_type");


      showChoice.appendChild(label2);
      showChoice.appendChild(input2);
      break;
    case "3":
      let label3 = document.createElement("label");
      label3.setAttribute("for", "update_race");
      label3.setAttribute("id", "label")
      label3.textContent = "Sa nouvelle race :";

      let input3 = document.createElement("input");
      input3.setAttribute("type", "text");
      input3.setAttribute("id", "input")
      input3.setAttribute("name", "update_race");

      showChoice.appendChild(label3);
      showChoice.appendChild(input3);
      break;
    case "4":
      let label4 = document.createElement("label");
      label4.setAttribute("for", "update_origine");
      label4.setAttribute("id", "label")
      label4.textContent = "Sa nouvelle origine :";

      let input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("id", "input")
      input4.setAttribute("name", "update_origine");

      showChoice.appendChild(label4);
      showChoice.appendChild(input4);
      break;
      case "5":
        let label5 = document.createElement("label");
        label5.setAttribute("for", "update_habitat");
        label5.setAttribute("id", "label")
        label5.textContent = "Son habitat :";
  
        let input5 = document.createElement("input");
        input5.setAttribute("type", "text");
        input5.setAttribute("id", "input")
        input5.setAttribute("name", "update_habitat");
  
        showChoice.appendChild(label5);
        showChoice.appendChild(input5);
        break;
      case "6":
        let label6 = document.createElement("label");
        label6.setAttribute("for", "image");
        label6.setAttribute("id", "label")
        label6.textContent = "Sélectionner une nouvelle photo :";
  
        let input6 = document.createElement("input");
        input6.setAttribute("type", "file");
        input6.setAttribute("id", "input")
        input6.setAttribute("name", "image");
  
        showChoice.appendChild(label6);
        showChoice.appendChild(input6);
        break;
    case "7":
      let label7 = document.createElement("label");
      label7.setAttribute("for", "update_common_name");
      label7.setAttribute("id", "label")
      label7.textContent = "Le nouveau nom commun :";

      let input7 = document.createElement("input");
      input7.setAttribute("type", "text");
      input7.setAttribute("id", "input")
      input7.setAttribute("name", "update_common_name");

      showChoice.appendChild(label7);
      showChoice.appendChild(input7);
      break;
  }
})