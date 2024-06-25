// Search bar
document.getElementById('input_search').addEventListener('keyup', (e) => {
  let keyword = e.target.value.toLowerCase().trim();
  let rows = document.querySelectorAll('#firstTable tbody tr');

  rows.forEach(row => {
    let nameAnimal = row.querySelector('td:nth-child(1)');
    let typeAnimal = row.querySelector('td:nth-child(2)');
    let found = false;

    if (isNaN(keyword) && nameAnimal.textContent.toLowerCase().includes(keyword) || typeAnimal.textContent.toLowerCase().includes(keyword)) {
      found = true;
    }

    if (found) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});

// Requete AJAX

function sendData(formId) {
  let form = document.getElementById(formId);

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    let data = new FormData(this);
    let xhr = new XMLHttpRequest();
    let message = this.querySelector('.message');

    message.innerHTML = '';

    // Récupérer la valeur du cookie id_user et l'ajouter à FormData
    let idUserCookie = document.cookie.split('; ')
      .find(cookie => cookie.startsWith('id_user='))
      .split('=')[1];
    data.append('id_user', idUserCookie);

    xhr.onreadystatechange = function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          message.innerHTML = 'Données bien enregistrées.';
        } else {
          message.innerHTML = '<span style="color: red; font-weight: bold;">Une erreur est survenue. Veuillez réessayer.</span>';
        }
      }
    };

    xhr.open("POST", "./veterinaire.php", true);
    xhr.send(data);
  });
}

sendData('data-animal');
sendData('data-habitat');
