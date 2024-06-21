<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require 'connect.php';

if (isset($_POST['name'], $_POST['explication'])) {
  if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $firstName = htmlspecialchars($_POST['name']);
    $content = htmlspecialchars($_POST['explication']);
    $status = 'pending';

    $addAvis = $pdo->prepare('INSERT INTO avis(first_name, content, status) VALUES (:first_name, :content, :status)');
    $addAvis->bindValue(':first_name', $firstName);
    $addAvis->bindValue(':content', $content);
    $addAvis->bindValue(':status', $status);

    if ($addAvis->execute()) {
      $message = 'Votre avis a été envoyé avec succès, merci !';
    } else {
      $message = "Il y a eu un problème lors de l'envoie de votre avis.";
    }
  } else {
    die('Invalid CSRF token');
  }
}
