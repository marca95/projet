<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['first_name_user'], $_SESSION['token'], $_SESSION['id_role'])) {
  $idRole = $_SESSION['id_role'];
  $request = null;

  switch ($idRole) {
    case 1:
      $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user');
      break;
    case 2:
      $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user AND id_role = 2');
      break;
    case 3:
      $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user AND id_role = 3');
      break;
    default:
      header("Location: connexion.php");
      exit();
  }

  if ($request) {
    $request->execute(array(':id_user' => $_SESSION['id_user']));
    $user = $request->fetch();

    if ($user && $_SESSION['first_name_user'] == $user['first_name'] && $_SESSION['token'] == $user['token']) {
      // Utilisateur authentifié
    } else {
      header("Location: connexion.php");
      exit();
    }
  }
} else {
  header("Location: connexion.php");
  exit();
}
