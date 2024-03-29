<?php

// Fetch option form for homes
$recupHomes = $pdo->prepare('SELECT * FROM homes');
$recupHomes->execute();
$optionsHomes = $recupHomes->fetchAll(PDO::FETCH_ASSOC);

// Fetch option form for locations
$recuplocations = $pdo->prepare('SELECT * FROM locations');
$recuplocations->execute();
$optionsLocations = $recuplocations->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['createNewAnimal']) && isset($_FILES['upload']) && $_FILES['upload']['error'] === 0) {
  $inscriptionAnimal = '';


  $name = $_POST['name'];
  $type = $_POST['type'];
  $race = $_POST['race'];
  $location = $_POST['location'];
  $home = $_POST['home'];
  $imgRoot = $_FILES['upload']['tmp_name'];
  $commonName = $_POST['commonName'];
  $destination = "../img/habitats/" . $_FILES['upload']['name'];

  $newAnimal = $pdo->prepare('INSERT INTO animals(name, type, race, id_location, id_home, root, commonName) VALUES (:name, :type, :race, :id_location, :id_home, :root, :commonName)');
  $newAnimal->bindValue(':name', $name);
  $newAnimal->bindValue(':type', $type);
  $newAnimal->bindValue(':race', $race);
  $newAnimal->bindValue(':id_location', $location);
  $newAnimal->bindValue(':id_home', $home);
  $newAnimal->bindValue(':root', $destination);
  $newAnimal->bindValue(':commonName', $commonName);


  if (move_uploaded_file($imgRoot, $destination)) {
    if ($newAnimal->execute()) {
      $inscriptionAnimal = 'Nouvel animal créé avec succès';
    } else {
      $inscriptionAnimal = 'Erreur lors de la création du nouvel animal';
    }
  } else {
    $inscriptionAnimal = 'Erreur lors du téléchargement de l\'image';
  }
}
