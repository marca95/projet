<?php

if (isset($_POST['name'], $_POST['explication'])) {
  $firstName = htmlspecialchars($_POST['name']);
  $content = htmlspecialchars($_POST['explication']);
  $status = 'pending';

  $addAvis = $pdo->prepare('INSERT INTO avis(first_name, content, status)  VALUES (:first_name, :content, :status)');
  $addAvis->bindValue(':first_name', $firstName);
  $addAvis->bindValue(':content', $content);
  $addAvis->bindValue(':status', $status);

  if ($addAvis->execute()) {
    $message = 'Votre avis à été envoyé avec succès, merci !';
  } else {
    $message = "Il y a eu un problème lors de l'envoie de votre avis.";
  }
}
