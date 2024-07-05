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
  $messageAnimal = '';

  $name = htmlspecialchars($_POST['name']);
  $type = htmlspecialchars($_POST['type']);
  $race = htmlspecialchars($_POST['race']);
  $location = htmlspecialchars($_POST['location']);
  $home = htmlspecialchars($_POST['home']);
  $imgRoot = $_FILES['upload']['tmp_name'];
  $commonName = htmlspecialchars($_POST['commonName']);
  $destination = "./img/habitats/" . $_FILES['upload']['name'];

  $maxFileSize = 2 * 1024 * 1024; // 2MB
  if ($_FILES['upload']['size'] > $maxFileSize) {
    $messageAnimal = "Fichier trop volumineux.";
  } else {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
      $messageAnimal = "Extension de fichier non autorisée.";
    } else {
      if (move_uploaded_file($imgRoot, $destination)) {
        $newAnimal = $pdo->prepare('INSERT INTO animals(name, type, race, id_location, id_home, root, commonName) 
                    VALUES (:name, :type, :race, :id_location, :id_home, :root, :commonName)');
        $newAnimal->bindValue(':name', $name);
        $newAnimal->bindValue(':type', $type);
        $newAnimal->bindValue(':race', $race);
        $newAnimal->bindValue(':id_location', $location);
        $newAnimal->bindValue(':id_home', $home);
        $newAnimal->bindValue(':root', $destination);
        $newAnimal->bindValue(':commonName', $commonName);

        if ($newAnimal->execute()) {
          $messageAnimal = 'Nouvel animal créé avec succès';
        } else {
          $messageAnimal = 'Erreur lors de la création du nouvel animal';
        }
      } else {
        $messageAnimal = 'Erreur lors du téléchargement de l\'image';
      }
    }
  }
} else {
  $messageAnimal = 'Erreur lors du téléchargement de l\'image';
}
