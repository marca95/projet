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
  <form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Nom de l'habitat :</label>
    <input type="text" name="name">
    <br />
    <label for="main_img">Image principal :</label>
    <input type="file" name="main_img">
    <br />
    <label for="second_img">Image secondaire :</label>
    <input type="file" name="second_img">
    <br />
    <label for="url_image_accueil">Image accueil :</label>
    <input type="file" name="url_image_accueil">
    <br />
    <label for="commonName">Nom commun de l'habitation :</label>
    <input type="text" name="commonName">
    <br />
    <button type="submit" name="createNewHome">Ajouter une nouvelle habitation</button>
    <?php echo $messageCreate ?>
  </form>
  <br />
  <br />
  <br />
  <h3>Créer un article</h3>
  <form action="" method="POST">
    <label for="main_title">Titre principal :</label>
    <input type="text" name="main_title">
    <br />
    <label for="second_title">Second titre :</label>
    <input type="text" name="second_title">
    <br />
    <label for="content">Contenu :</label>
    <textarea rows="5" cols="50" name="content"></textarea>
    <br />
    <label for="homes">Habitation :</label>
    <select name="homes" id="homes">
      <?php foreach ($optionsHomes as $optionsHome) : ?>
        <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="third_title">Troisième titre :</label>
    <input type="text" name="third_title">
    <br />
    <button type="submit" name="createNewArticle">Ajouter un nouvel article</button>
    <br />
    <?php echo $messageArticle ?>
  </form>
  <br />
  <br />
  <br />
  <h3>Modifier un habitat / article</h3>
  <form action="" method="POST" id="update_form" enctype="multipart/form-data">
    <label for="habitat">Selectionner l'habitat à modifier : </label>
    <select name="habitat" id="habitat">
      <?php foreach ($optionsHomes as $optionsHome) : ?>
        <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="choose">Que souhaitez-vous modifier : </label>
    <select name="choose" id="choose">
      <option value="">Choix par défaut</option>
      <option value="1">Le nom de l'habitat</option>
      <option value="2">La photo principal</option>
      <option value="3">La photo secondaire</option>
      <option value="4">Le titre principal</option>
      <option value="5">Le second titre</option>
      <option value="6">Le contenu</option>
      <option value="7">Le troisième titre</option>
      <option value="8">L'image de l'accueil</option>
      <option value="9">Le nom pour l'accueil</option>
    </select>
    <div id="chooseAdmin"></div>
    <br />
    <button type="submit" name="updateHome">Modifier l'habitat</button>
    <br />
    <?php echo $updateMessage ?>
  </form>
  <br />
  <br />
  <br />
  <h3>Suppression d'un habitat / article </h3>
  <form action="" method="POST" id="update_form" onsubmit="return confirmDelete()">
    <label for="delete_habitat">Supprimer l'habitat : </label>
    <select name="delete_habitat" id="habitat">
      <?php foreach ($optionsHomes as $optionsHome) : ?>
        <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <button type="submit" name="deleteHome">Supprimer l'habitat</button>
    <br />
    <?php echo $messageDeleteHome ?>
  </form>

  <script src="../js/admin_home.js"></script>
</body>

</html>