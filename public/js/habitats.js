    // Navbar responsive icon
    const links = document.querySelectorAll('nav li');

    icon.addEventListener("click", () => {
      nav.classList.toggle("active");
    })

    links.forEach((link) => {
      link.addEventListener('click', () => {
        nav.classList.remove("active");
      });
    });

    //get characteristic habitat
    // To be reworked for improvement, 1 function in 2

    function toggleDiv(divId) {
      let selectedDiv = document.getElementById(divId);

      let habitatDescriptions = document.querySelectorAll("div.hidden");

      habitatDescriptions.forEach(function(div) {
        if (div !== selectedDiv) {
          div.style.display = 'none';
        }
      });

      if (selectedDiv.style.display == 'none' || selectedDiv.style.display == '') {
        selectedDiv.style.display = 'block';
      } else {
        selectedDiv.style.display = 'none';
      }
    }

    function toggleImg(divId) {
      let selectedDiv = document.getElementById(divId);

      let animalDescr = document.querySelectorAll("div.hidAnimal");

      animalDescr.forEach(function(div) {
        if (div !== selectedDiv) {
          div.style.display = 'none';
        }
      });

      if (selectedDiv.style.display == 'none' || selectedDiv.style.display == '') {
        selectedDiv.style.display = 'block';
      } else {
        selectedDiv.style.display = 'none';
      }
    }

    // Get destination accueil animals 
    // TO REWORK IF NEW HABITAT NO LINK

    let animalURL = window.location.hash.substring(1);

     switch (animalURL) {
       case 'foret':
         toggleDisplay('foret');
         break;
       case 'etang':
         toggleDisplay('etang');
         break;
       case 'vivarium':
         toggleDisplay('vivarium');
         break;
       case 'pature':
         toggleDisplay('pature');
         break;
       case 'ranch':
         toggleDisplay('ranch');
         break;
       case 'taniere':
         toggleDisplay('taniere');
         break;
       case 'oceanarium':
         toggleDisplay('oceanarium');
         break;
       case 'voliere':
         toggleDisplay('voliere');
         break;
       case 'cerf':
         toggleDisplay('foret');
         toggleDisplay('cerf');
         break;
       case 'poisson':
         toggleDisplay('etang');
         toggleDisplay('poisson');
         break;
       case 'araignée':
         toggleDisplay('vivarium');
         toggleDisplay('araignée');
         break;
       case 'bison':
         toggleDisplay('pature');
         toggleDisplay('bison');
         break;
       case 'ours':
         toggleDisplay('taniere');
         toggleDisplay('ours');
         break;
       case 'dauphin':
         toggleDisplay('oceanarium');
         toggleDisplay('dauphin');
         break;
       case 'lion':
         toggleDisplay('ranch');
         toggleDisplay('lion');
         break;
       case 'perroquet':
         toggleDisplay('voliere');
         toggleDisplay('perroquet');
         break;
       default:
         break;
     }

     function toggleDisplay(elementId) {
       const element = document.getElementById(elementId);
       if (element) {
         element.style.display = 'block';
       }
     }


    // Gestionnaire d'événements pour le clic sur $animal['type']

    function showType(animalType) {
      fetch(`habitats.php?type=${animalType}`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Une erreur s\'est produite.');
          }
          return response.text();
        })
        .catch(error => {
          console.error('Erreur :', error);
        });
    }