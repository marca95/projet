<?php

// DELETE ANIMAL
$idAnimal = isset($_POST['animal_delete']) ? $_POST['animal_delete'] : '';

$message = '';

if (isset($_POST['formDeleteAnimal'])) {

  $stmt = $pdo->prepare('DELETE FROM animals WHERE id_animal = :id_animal');
  $stmt->bindValue(':id_animal', $idAnimal);
  if ($stmt->execute()) {
    $message = "L'animal a été supprimé avec succès.";
  } else {
    $message = "Erreur lors de la suppression de l'animal";
  }
}
