<?php

$idHome = isset($_POST['delete_habitat']) ? $_POST['delete_habitat'] : '';
$messageDeleteHome = '';

if (isset($_POST['deleteHome'])) {
  try {
    $stmt = $pdo->prepare('DELETE FROM homes WHERE id_home = :id_home');
    $stmt->bindValue(':id_home', $idHome);
    if ($stmt->execute()) {
      $messageDeleteHome = "L'habitation a été supprimée avec succès.";
    } else {
      $messageDeleteHome = "Erreur lors de la suppression de l'habitation.";
    }
  } catch (PDOException $e) {
    error_log($e->getMessage());
    $messageDeleteHome = "Erreur lors de la suppression de l'habitation : ";
  }
}
