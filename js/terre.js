//icon responsive

const links = document.querySelectorAll('nav li');

icon.addEventListener("click", () => {
 nav.classList.toggle("active");
})

links.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove("active");
  });
});

// fetch img accueil/terre

let url = window.location.hash.substring(1);

if(url == 'ecologie') {
  getPond.style.display = 'block';
  getPond.style.border = 'yellow 3px solid';
} 

