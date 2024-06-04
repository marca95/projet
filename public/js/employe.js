// Update services 

document.getElementById('selectedPartService').addEventListener('change', function () {
  const response = document.getElementById('inputAndLabel');
  const selectValue = this.value;


  let oldLabel = document.getElementById("label");
  let oldInput = document.getElementById("input");

  if (oldLabel) {
    oldLabel.remove();
  }
  if (oldInput) {
    oldInput.remove();
  }

  switch (selectValue) {
    case "1":
      let label1 = document.createElement("label");
      label1.setAttribute("for", "update_main_title");
      label1.setAttribute("id", "label");
      label1.textContent = "Veuillez inscrire un nouveau titre principal :";

      let input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("id", "input");
      input1.setAttribute("name", "update_main_title");

      response.appendChild(label1);
      response.appendChild(input1);
      break;
    case "2":
      let label2 = document.createElement("label");
      label2.setAttribute("for", "update_second_title");
      label2.setAttribute("id", "label");
      label2.textContent = "Veuillez inscrire un nouveau second titre : ";

      let input2 = document.createElement("input");
      input2.setAttribute("type", "text");
      input2.setAttribute("id", "input");
      input2.setAttribute("name", "update_second_title");


      response.appendChild(label2);
      response.appendChild(input2);
      break;
    case "3":
      let label3 = document.createElement("label");
      label3.setAttribute("for", "update_main_img");
      label3.setAttribute("id", "label");
      label3.textContent = "Sélectionner une nouvelle image : ";

      let input3 = document.createElement("input");
      input3.setAttribute("type", "file");
      input3.setAttribute("id", "input");
      input3.setAttribute("name", "update_main_img");
      input3.classList.add("file-input");

      response.appendChild(label3);
      response.appendChild(input3);
      break;
    case "4":
      let label4 = document.createElement("label");
      label4.setAttribute("for", "update_main_content");
      label4.setAttribute("id", "label");
      label4.textContent = "Ecrivez votre nouveau contenu : ";

      let input4 = document.createElement("input");
      input4.setAttribute("type", "text");
      input4.setAttribute("id", "input")
      input4.setAttribute("name", "update_main_content");
      input4.setAttribute("rows", "5");
      input4.setAttribute("cols", "50");

      response.appendChild(label4);
      response.appendChild(input4);
      break;
    case "5":
      let label5 = document.createElement("label");
      label5.setAttribute("for", "update_third_title");
      label5.setAttribute("id", "label");
      label5.textContent = "Le nouveau titre secondaire : ";

      let input5 = document.createElement("input");
      input5.setAttribute("type", "text");
      input5.setAttribute("id", "input");
      input5.setAttribute("name", "update_third_title");

      response.appendChild(label5);
      response.appendChild(input5);
      break;
    case "6":
      let label6 = document.createElement("label");
      label6.setAttribute("for", "update_second_content");
      label6.setAttribute("id", "label");
      label6.textContent = "Le nouveau contenu : ";

      let input6 = document.createElement("textarea");
      input6.setAttribute("type", "text");
      input6.setAttribute("name", "update_second_content");
      input6.setAttribute("id", "input");
      input6.setAttribute("rows", "5");
      input6.setAttribute("cols", "50");

      response.appendChild(label6);
      response.appendChild(input6);
      break;
    case "7":
      let label7 = document.createElement("label");
      label7.setAttribute("for", "update_name");
      label7.setAttribute("id", "label");
      label7.textContent = "Ecrivez le nom en bref : ";

      let input7 = document.createElement("input");
      input7.setAttribute("type", "text");
      input7.setAttribute("id", "input");
      input7.setAttribute("name", "update_name");

      response.appendChild(label7);
      response.appendChild(input7);
      break;
    case "8":
      let label8 = document.createElement("label");
      label8.setAttribute("for", "update_class_link");
      label8.setAttribute("id", "label");
      label8.textContent = "Ecrivez la nouvelle classe du lien : ";

      let input8 = document.createElement("input");
      input8.setAttribute("type", "text");
      input8.setAttribute("id", "input");
      input8.setAttribute("name", "update_class_link");

      response.appendChild(label8);
      response.appendChild(input8);
      break;
    case "9":
      let label9 = document.createElement("label");
      label9.setAttribute("for", "update_url_link");
      label9.setAttribute("id", "label");
      label9.textContent = "Ecrivez la nouvelle classe du lien : ";

      let input9 = document.createElement("input");
      input9.setAttribute("type", "text");
      input9.setAttribute("id", "input");
      input9.setAttribute("name", "update_url_link");

      response.appendChild(label9);
      response.appendChild(input9);
      break;
    case "10":
      let label10 = document.createElement("label");
      label10.setAttribute("for", "update_img_link");
      label10.setAttribute("id", "label");
      label10.textContent = "Sélectionner la nouvelle imge du lien : ";

      let input10 = document.createElement("input");
      input10.setAttribute("type", "file");
      input10.setAttribute("id", "input");
      input10.setAttribute("name", "update_img_link");
      input10.classList.add("file-input");

      response.appendChild(label10);
      response.appendChild(input10);
      break;
    case "11":
      let label11 = document.createElement("label");
      label11.setAttribute("for", "update_class_btn");
      label11.setAttribute("id", "label");
      label11.textContent = "Ecrivez la nouvelle classe du bouton : ";

      let input11 = document.createElement("input");
      input11.setAttribute("type", "text");
      input11.setAttribute("id", "input");
      input11.setAttribute("name", "update_class_btn");

      response.appendChild(label11);
      response.appendChild(input11);
      break;
    case "12":
      let label12 = document.createElement("label");
      label12.setAttribute("for", "update_url_btn");
      label12.setAttribute("id", "label");
      label12.textContent = "Ecrivez la nouvelle URL du bouton : ";

      let input12 = document.createElement("input");
      input12.setAttribute("type", "text");
      input12.setAttribute("id", "input");
      input12.setAttribute("name", "update_url_btn");

      response.appendChild(label12);
      response.appendChild(input12);
      break;
    case "13":
      let label13 = document.createElement("label");
      label13.setAttribute("for", "update_title_btn");
      label13.setAttribute("id", "label");
      label13.textContent = "Ecrivez le nouveau titre du bouton : ";

      let input13 = document.createElement("input");
      input13.setAttribute("type", "text");
      input13.setAttribute("id", "input");
      input13.setAttribute("name", "update_title_btn");

      response.appendChild(label13);
      response.appendChild(input13);
      break;
  }
})

// Valid file from form
function checkFiles(event, form) {
  debugger;
  let messageElement = form.querySelector('.extension');
  messageElement.textContent = "";
  let fileInputs = form.querySelectorAll('.file-input');
  let allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  let maxFileSizeMB = 2;
  let isValid = true;
  debugger;
  fileInputs.forEach(function (fileInput) {
    let file = fileInput.files[0];
    if (file) {
      let fileSizeMB = file.size / 1024 / 1024;
      let fileExtension = file.name.split('.').pop().toLowerCase();

      if (fileSizeMB > maxFileSizeMB) {
        messageElement.textContent = "Fichier trop volumineux";
        isValid = false;
      }

      if (!allowedExtensions.includes(fileExtension)) {
        messageElement.textContent = "Extension du fichier non autorisée";
        isValid = false;
      }
    }
  });

  if (!isValid) {
    event.preventDefault();
  }
}