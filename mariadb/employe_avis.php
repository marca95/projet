
<?php
if (isset($_POST['update_avis'])) {
  $employeValidated = $user['id_user'];

  if (!empty($_POST['status'])) {
    $stmtAvis = $pdo->prepare("UPDATE avis SET status = :status, id_employe = :employeValidated WHERE id_avis = :idAvis");

    foreach ($_POST['status'] as $id_avis => $status) {
      if ($status === '') {
        continue;
      }

      switch ($status) {
        case 'pending':
          $messageAvis = 'Commentaire numéro :' . $id_avis . ' a été mis en attente.';
          break;
        case 'published':
          $messageAvis = 'Commentaire numéro :' . $id_avis . ' a été mis en ligne.';
          break;
        case 'delete':
          $stmtAvis = $pdo->prepare("DELETE FROM avis WHERE id_avis = :idAvis");
          $messageAvis = 'Commentaire numéro :' . $id_avis . ' a été supprimé.';
          break;
        default:
          $messageAvis = "Vous n'avez pas effectué de changement..";
          break;
      }

      if (!empty($status)) {
        if ($status == 'pending' || $status == 'published') {
          $stmtAvis->bindValue(':status', $status);
          $stmtAvis->bindValue(':employeValidated', $employeValidated);
          $stmtAvis->bindValue(':idAvis', $id_avis);
          $stmtAvis->execute();
        } else {
          $stmtAvis->bindValue(':idAvis', $id_avis);
          $stmtAvis->execute();
        }
      }
    }
  }
}
?>