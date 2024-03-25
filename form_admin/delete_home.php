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
    $messageDeleteHome = "Erreur lors de la suppression de l'habitation : " . $e->getMessage() . ".<br> Vous ne pouvez pas supprimer cette habitation car des animaux sont toujours placés dans ce logement. Veuillez d'abord changer les animaux d'habitation.";
  }
}
