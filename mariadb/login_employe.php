<?php

if (
  isset($_SESSION['first_name_user'], $_SESSION['token'], $_SESSION['id_role']) &&
  $_SESSION['id_role'] == 3
) {
  $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user AND id_role = 3');
  $request->execute(array(':id_user' => $_SESSION['id_user']));
  $empUser = $request->fetch();

  if ($empUser && $_SESSION['first_name_user'] == $empUser['first_name'] && $_SESSION['token'] == $empUser['token']) {
  } else {
    header("Location: connexion.php");
    exit();
  }
} else {
  header("Location: connexion.php");
  exit();
}
