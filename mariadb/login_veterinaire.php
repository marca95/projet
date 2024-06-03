<?php

// Login session

$request = $pdo->prepare('SELECT * FROM users WHERE id_role = 2');
$request->execute();
$vetUsers = $request->fetchAll(PDO::FETCH_ASSOC);

$loggedIn = false;

foreach ($vetUsers as $vetUser) {
  if (
    isset($_SESSION['id_role'], $_SESSION['username'], $_SESSION['password']) &&
    $_SESSION['id_role'] == 2 &&
    $_SESSION['username'] == $vetUser['username'] &&
    password_verify($_SESSION['password'], $vetUser['password'])
  ) {
    $loggedIn = true;
    break;
  }
}

if (!$loggedIn) {
  header("Location: connexion.php");
  exit();
}
