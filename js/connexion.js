// Bar navigation responsive "icon".

const links = document.querySelectorAll('nav li');

icon.addEventListener("click", () => {
 nav.classList.toggle("active");
})

links.forEach((link) => {
  link.addEventListener('click', () => {
    nav.classList.remove("active");
  });
});

//Change background-img 
//Search function preload because it takes a long time


// let image = document.getElementById("image");

// let images = ["../img/menu/cameleon.jpg", "../img/menu/alpaga.jpg", "../img/menu/lion.jpg"];
// let n = 0;

// function changeImage() {
//   n++;
//   if (n > images.length - 1) {
//     n = 0;
//   }

//   image.style.backgroundImage = "url(" + images[n] + ")";

// }

// changeImage();
// setInterval(changeImage, 8000);
