<?php

//login employe
session_start();
$request = $pdo->prepare('SELECT * FROM users WHERE id_role = 3');
$request->execute();
$empUsers = $request->fetchAll(PDO::FETCH_ASSOC);

$loggedIn = false;

foreach ($empUsers as $empUser) {
  if (
    isset($_SESSION['id_role'], $_SESSION['username'], $_SESSION['password']) &&
    $_SESSION['id_role'] == 3 &&
    $_SESSION['username'] == $empUser['username'] &&
    password_verify($_SESSION['password'], $empUser['password'])
  ) {
    $loggedIn = true;
    break;
  }
}

if (!$loggedIn) {
  header("Location: connexion.php");
  exit();
}
