<!DOCTYPE html>
<?php
session_start();
// Connect DB
$userDB = 'root';
$passwordDB = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', $userDB, $passwordDB);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

// Login session 

$request = $pdo->prepare('SELECT * FROM users WHERE id_role = 1');
$request->execute();
$user = $request->fetch();
if (
  isset($_SESSION['id_role'], $_SESSION['username'], $_SESSION['password']) &&
  $_SESSION['id_role'] == 1 &&
  $_SESSION['username'] == $user['username'] &&
  password_verify($_SESSION['password'], $user['password'])
) {
} else {
  header("Location: connexion.php");
  exit();
}

require_once('../form/create_animal.php');
require_once('../form/create_article.php');
require_once('../form/update_animal.php');
require_once('../form/update_article.php');
require_once('../form/delete_animal.php');
require_once('../form/delete_article.php');

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrateur</title>
</head>

<body>
  <h3>Modification des habitats et des animaux</h3>
  <?php
  include 'test.php';
  ?>

  <!-- enctype sert spécifier comment les données du formulaire sont encodées aux serveur
multipart/form data est souvent utilisé quand il contient des fichiers -->

  <form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Nom de l'animal :</label>
    <input type="text" name="name">
    <br />
    <label for="type">Le type d'animal :</label>
    <input type="text" name="type">
    <br />
    <label for="race">Race de l'animal :</label>
    <input type="text" name="race">
    <br />
    <label for="location">Lieu d'origine de l'animal :</label>
    <input type="text" name="location">
    <br />
    <label for="home">Dans quelle habitat va se trouver l'animal :</label>
    <input type="text" name="home">
    <br />
    <label for="commonName">Nom commun de ou des animaux :</label>
    <input type="text" name="commonName">
    <br />
    <label for="upload">Sélectionner une image</label>
    <input type="file" name="upload">
    <br />
    <button type="submit" name="createNewAnimal">Inscrire le nouvelle animal</button>
  </form>
</body>

</html>