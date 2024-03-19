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

if ($_SESSION['id_role'] == 1) {
  echo '<button onclick="createArticle()">Créer un article</button>';
  echo '<button onclick="editArticle()">Modifier un article</button>';
  echo '<button onclick="deleteArticle()">Supprimer un article</button>';
}

function createArticle()
{
}

function updateArticle()
{
}

function deleteArticle()
{
}
function createAnimal()
{
}

function updateAnimal()
{
}

function deleteAnimal()
{
}
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

</body>

</html>