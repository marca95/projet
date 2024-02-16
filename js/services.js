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

// fetch btn accueil/service 
const getResto = document.getElementById('resto')
const getHabitat = document.getElementById('habitat')
const getTrain = document.getElementById('train')


let url = window.location.hash.substring(1);

switch(url) {
  case 'train': 
  getTrain.style.border = 'solid yellow 3px'
  break
  case 'resto': 
  getResto.style.border = 'solid yellow 3px'
  break
  case 'habitat': 
  getHabitat.style.border = 'solid yellow 3px'
  break
}
