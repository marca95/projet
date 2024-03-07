<!DOCTYPE html>

<?php

// Connect DB
$user = 'root';
$passwordBD = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=zoo', $user, $passwordBD);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

// Login session 

session_start();
$request = $pdo->prepare('SELECT * FROM users WHERE id_role = 3');
$request->execute();
$empUsers = $request->fetchAll(PDO::FETCH_ASSOC);

$loggedIn = false;

foreach ($empUsers as $empUser) {
  if (
    isset($_SESSION['id_role'], $_SESSION['email'], $_SESSION['password']) &&
    $_SESSION['id_role'] == 3 &&
    $_SESSION['email'] == $empUser['email'] &&
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

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>EMPLOYE</h1>
</body>

</html>