// Navbar 
const icon = document.getElementById('icon');
const nav = document.querySelector('nav');

icon.addEventListener("click", () => {
  if (nav.classList.toggle("active")) {
    nav.querySelector('ul').style.display = 'block';
  } else {
    nav.querySelector('ul').style.display = 'none'; 
  }
});