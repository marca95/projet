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

require_once('../form_admin/create_home.php');
require_once('../form_admin/update_home.php');
require_once('../form_admin/delete_home.php');

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>

  <h3>Créer un habitat</h3>
  <form action="" method="POST">
    <label for="name">Nom de l'habitat :</label>
    <input type="text" name="name">
    <br />
    <label for="main_img">Image principal :</label>
    <input type="file" name="main_img">
    <br />
    <label for="second_img">Image secondaire :</label>
    <input type="file" name="second_img">
    <br />
    <label for="main_title">Titre principal :</label>
    <input type="text" name="main_title">
    <br />
    <label for="second_title">Second titre :</label>
    <input type="text" name="second_title">
    <br />
    <label for="content">Contenu :</label>
    <input type="text" name="content">
    <br />
    <label for="third_title">Troisième titre :</label>
    <input type="text" name="third_title">
    <br />
    <button type="submit" name="createNewHome">Ajouter une nouvelle habitation</button>
  </form>

</body>

</html>