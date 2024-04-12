<?php

$allFoods = $pdo->prepare('SELECT foods.*, animals.name, animals.type FROM foods INNER JOIN animals ON animals.id_animal = foods.id_animal');
$allFoods->execute();
$viewFoods = $allFoods->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['sendDatas'])) {
  $nameAnimal = isset($_POST['nameAnimal']) ? $_POST['nameAnimal'] : '';
  $food = isset($_POST['food']) ? $_POST['food'] : '';
  $grams = isset($_POST['grams']) ? $_POST['grams'] : '';
  $datePass = isset($_POST['datePass']) ? $_POST['datePass'] : '';
  $idEmploye = $empUser['id_user'];

  $animalExists = false;
  foreach ($viewFoods as $foods) {
    if ($foods['id_animal'] == $nameAnimal) {
      $animalExists = true;
      break;
    }
  }

  if ($animalExists) {
    $updateFoods = $pdo->prepare('UPDATE foods SET food = :food, grams = :grams, date_pass = :datepass, id_employed = :id_employe WHERE id_animal = :id_animal');
  } else {
    $updateFoods = $pdo->prepare('INSERT INTO foods(food, grams, date_pass, id_employed, id_animal) VALUES (:food, :grams, :datepass, :id_employe, :id_animal)');
  }

  $updateFoods->bindValue(':food', $food);
  $updateFoods->bindValue(':grams', $grams);
  $updateFoods->bindValue(':datepass', $datePass);
  $updateFoods->bindValue(':id_employe', $idEmploye);
  $updateFoods->bindValue(':id_animal', $nameAnimal);

  if ($updateFoods->execute()) {
    echo "Données bien enregistrées.";
  } else {
    echo "Problème lors de l'enregistrement des données";
  }
}
