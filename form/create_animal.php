<?php

if (isset($_POST['createNewAnimal']) && isset($_FILES['upload']) && $_FILES['upload']['error'] === 0) {
  $name = $_POST['name'];
  $type = $_POST['type'];
  $race = $_POST['race'];
  $location = $_POST['location'];
  $home = $_POST['home'];

  $imgRoot = $_FILES['upload']['tmp_name'];
  $commonName = $_POST['commonName'];

  $newAnimal = $pdo->prepare('INSERT INTO animals(name, type, race, id_location, id_home) VALUES (:name, :type, :race, :id_location, :id_home)');
  $newAnimal->bindValue(':name', $name);
  $newAnimal->bindValue(':type', $type);
  $newAnimal->bindValue(':race', $race);
  $newAnimal->bindValue(':id_location', $location);
  $newAnimal->bindValue(':id_home', $home);

  $newRootAnimal = $pdo->prepare('INSERT INTO img_animals(root, name) VALUES (:root, :commonName)');
  $newRootAnimal->bindValue(':root', $imgRoot);
  $newRootAnimal->bindValue(':commonName', $commonName);

  // code que j'avais avant if (move_uploaded_file($imgRoot, "../img/habitats/" . $_FILES['upload']['name'])) {
  // CODE A ESSAYER SI NOK SUPP ligne 26
  if (move_uploaded_file($_FILES['upload']['name'], "../img/habitats/" . $imgRoot)) {
    if ($newAnimal->execute() && $newRootAnimal->execute()) {
      echo 'Nouvel animal créé avec succès';
    } else {
      echo 'Erreur lors de la création du nouvel animal';
    }
  } else {
    echo 'Erreur lors du téléchargement de l\'image';
  }
}
