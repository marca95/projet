<?php

$idService = isset($_POST['chooseDeleteService']) ? $_POST['chooseDeleteService'] : '';
$messageDeleteService = '';

if (isset($_POST['deleteService'])) {
  try {
    $stmt = $pdo->prepare('DELETE FROM services WHERE id_service = :id_service');
    $stmt->bindValue(':id_service', $idService);
    if ($stmt->execute()) {
      $messageDeleteService = "Le service a été supprimé avec succès.";
    } else {
      $messageDeleteService = "Erreur lors de la suppression du service.";
    }
  } catch (PDOException $e) {
    $messageDeleteService = "Erreur lors de la suppression du service : " . $e->getMessage();
  }
}
