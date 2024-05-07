const links = document.querySelectorAll('nav li');

icon.addEventListener("click", () => {
  nav.classList.toggle("active");
})

links.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove("active");
  });
});

// Manage nav li connect/space member

let connected = document.querySelector('.connected');
let disconnected = document.querySelector('.disconnected');

if (isset($_SESSION['id_user'])) {
  connected.classList.add('d-block');
  disconnected.classList.remove('d-none');
} else {
  connected.classList.add('d-none');
  disconnected.classList.remove('d-block');
}