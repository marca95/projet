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

// search bar 

document.getElementById('input_search').addEventListener('keyup', (e) => {
  let keyword = e.target.value.toLowerCase().trim();
  let rows = document.querySelectorAll('tbody tr');

  rows.forEach(row => {
    let nameAnimal = row.querySelector('td:nth-child(1)');
    let typeAnimal = row.querySelector('td:nth-child(2)');
    let datePass = row.querySelector('td:nth-child(5)');
    let found = false;

    if (isNaN(keyword) && nameAnimal.textContent.toLowerCase().includes(keyword) || typeAnimal.textContent.toLowerCase().includes(keyword)) {
      found = true;
    } else if (datePass.textContent.includes(keyword)) {
      found = true;
    }

    if (found) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});