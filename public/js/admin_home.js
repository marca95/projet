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

// Update home

const choose = document.getElementById('choose');
const chooseAdmin = document.getElementById('chooseAdmin');

choose.addEventListener('change', function () {
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
      label1.textContent = "Nom de l'habitation :";

      let input1 = document.createElement("input");
      input1.setAttribute("type", "text");
      input1.setAttribute("id", "input")
      input1.setAttribute("name", "update_name");
      input1.setAttribute("maxlength", "50");

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
      input2.classList.add("file-input");

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
      input3.classList.add("file-input");

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
      input4.setAttribute("maxlength", "50");

      chooseAdmin.appendChild(label4);
      chooseAdmin.appendChild(input4);
      break;
    case "5":
      let label5 = document.createElement("label");
      label5.setAttribute("for", "update_second_title");
      label5.setAttribute("id", "label")
      label5.textContent = "Le nouveau sous-titre :";

      let input5 = document.createElement("input");
      input5.setAttribute("type", "text");
      input5.setAttribute("id", "input")
      input5.setAttribute("name", "update_second_title");
      input5.setAttribute("maxlength", "255");

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
      input6.setAttribute("maxlength", "2000");

      chooseAdmin.appendChild(label6);
      chooseAdmin.appendChild(input6);
      break;
    case "8":
      let label8 = document.createElement("label");
      label8.setAttribute("for", "update_img_accueil");
      label8.setAttribute("id", "label")
      label8.textContent = "L'image de l'accueil :";

      let input8 = document.createElement("input");
      input8.setAttribute("type", "file");
      input8.setAttribute("id", "input")
      input8.setAttribute("name", "update_img_accueil");
      input8.classList.add("file-input");

      chooseAdmin.appendChild(label8);
      chooseAdmin.appendChild(input8);
      break;
    case "9":
      let label9 = document.createElement("label");
      label9.setAttribute("for", "update_common_name");
      label9.setAttribute("id", "label")
      label9.textContent = "Le titre pour l'accueil :";

      let input9 = document.createElement("input");
      input9.setAttribute("type", "text");
      input9.setAttribute("id", "input")
      input9.setAttribute("name", "update_common_name");
      input9.setAttribute("maxlength", "255");

      chooseAdmin.appendChild(label9);
      chooseAdmin.appendChild(input9);
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

// Valid file from form
function checkFiles(event, form) {
  let messageElement = form.querySelector('.extension');
  messageElement.textContent = "";
  let fileInputs = form.querySelectorAll('.file-input');
  let allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  let maxFileSizeMB = 2;
  let isValid = true;

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
    } else {
      messageElement.textContent = "Veuillez sélectionner un fichier à télécharger";
      isValid = false;
    }
  });

  if (!isValid) {
    event.preventDefault();
  }
}