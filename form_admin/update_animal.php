<?php

// Fetch animals
$recupAnimals = $pdo->prepare('SELECT * FROM animals');
$recupAnimals->execute();
$viewAllAnimals = $recupAnimals->fetchAll(PDO::FETCH_ASSOC);

$updateAnimal = '';

if (isset($_POST['formUpdateAnimal'])) {
  // $choiceAnimal = isset($_POST['choice_animal']) ? $_POST['choice_animal'] : '';
  $selectedAnimal = explode('|', $_POST['choice_animal']);
  $choiceAnimal = $selectedAnimal[0];
  // USE ONLY JAVASCRIPT $attributAnimal = $_POST['attribut_animal'];
  $input1 = isset($_POST['update_name']) ? $_POST['update_name'] : '';
  $input2 = isset($_POST['update_type']) ? $_POST['update_type'] : '';
  $input3 = isset($_POST['update_race']) ? $_POST['update_race'] : '';
  $input7 = isset($_POST['update_common_name']) ? $_POST['update_common_name'] : '';
  $files = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
  $updateOrigin = isset($_POST['update_origin']) ? $_POST['update_origin'] : '';
  $updateHome = isset($_POST['update_habitat']) ? $_POST['update_habitat'] : '';


  if (!empty($input1)) {
    $stmt = $pdo->prepare('UPDATE animals SET name = :update_name WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':update_name', $input1);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  if (!empty($input2)) {
    $stmt = $pdo->prepare('UPDATE animals SET type = :update_type WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':update_type', $input2);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  if (!empty($input3)) {
    $stmt = $pdo->prepare('UPDATE animals SET race = :update_race WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':update_race', $input3);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  if (!empty($input7)) {
    $stmt = $pdo->prepare('UPDATE animals SET commonName = :update_common_name WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':update_common_name', $input7);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  if ((!empty($files)) && $_FILES['image']['error'] === 0) {
    $destinationImage = "./img/habitats/" . $_FILES['image']['name'];
    $stmt = $pdo->prepare('UPDATE animals SET root = :image WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':image', $destinationImage);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    if (move_uploaded_file($files, $destinationImage)) {
      $stmt->execute();
    } else {
      $updateAnimal = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if ((!empty($updateOrigin)) && isset($updateOrigin)) {
    $stmt = $pdo->prepare('UPDATE animals SET id_location = :origin WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':origin', $updateOrigin);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  if ((!empty($updateHome)) && isset($updateHome)) {
    $stmt = $pdo->prepare('UPDATE animals SET id_home = :home WHERE id_animal = :choiceAnimal');
    $stmt->bindValue(':home', $updateHome);
    $stmt->bindValue(':choiceAnimal', $choiceAnimal);
    $stmt->execute();
  }
  $updateAnimal = 'La mise à jour à été éffectuée avec succès.';
};
