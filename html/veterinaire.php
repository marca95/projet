<!DOCTYPE html>

<?php

// Connect DB
$userDB = 'root';
$passwordBD = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', $userDB, $passwordBD);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

// Login session 

session_start();
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

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>VETERINAIRE</h1>
</body>

</html>