<?php

if (
  isset($_SESSION['first_name_user'], $_SESSION['token'], $_SESSION['id_role']) &&
  $_SESSION['id_role'] == 2
) {
  $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user AND id_role = 2');
  $request->execute(array(':id_user' => $_SESSION['id_user']));
  $vetUser = $request->fetch();

  if ($vetUser && $_SESSION['first_name_user'] == $vetUser['first_name'] && $_SESSION['token'] == $vetUser['token']) {
  } else {
    header("Location: connexion.php");
    exit();
  }
} else {
  header("Location: connexion.php");
  exit();
}
