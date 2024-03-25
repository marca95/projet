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

require_once('../form_admin/create_animal.php');
require_once('../form_admin/update_animal.php');
require_once('../form_admin/delete_animal.php');

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin_animal.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <h3>Modification des habitats et des animaux</h3>
  <?php
  // include 'test.php';
  ?>

  <!-- enctype sert spécifier comment les données du formulaire sont encodées aux serveur
multipart/form data est souvent utilisé quand il contient des fichiers -->
  <h3>Créer un animal </h3>
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
    <select name="location" id="location">
      <?php foreach ($optionsLocations as $optionsLocation) : ?>
        <option value="<?php echo $optionsLocation['id_location']; ?>"><?php echo $optionsLocation['NAME']; ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="home">Dans quelle habitat va se trouver l'animal :</label>
    <select name="home" id="home">
      <?php foreach ($optionsHomes as $optionsHome) : ?>
        <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="commonName">Nom commun de ou des animaux :</label>
    <input type="text" name="commonName">
    <br />
    <label for="upload">Sélectionner une image</label>
    <input type="file" name="upload">
    <br />
    <button type="submit" name="createNewAnimal">Inscrire le nouvelle animal</button>
    <br />
    <?php echo isset($inscriptionAnimal) ? $inscriptionAnimal : '' ?>
  </form>


  <h3>Modifier un animal </h3>
  <form action="" method="POST" enctype="multipart/form-data" id="form_update_animal">
    <label for="choice_animal">Choissisez votre animal :</label>
    <select name="choice_animal" id="choice_animal">
      <?php foreach ($viewAllAnimals as $viewAnimal) : ?>
        <option value="<?php echo $viewAnimal['id_animal']; ?>"><?php echo $viewAnimal['name']; ?> (<?php echo $viewAnimal['type'] ?>)</option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="attribut_animal">Que souhaitez-vous modifier :</label>
    <select name="attribut_animal" id="attribut_animal">
      <option value="0"></option>
      <option value="1">Son nom</option>
      <option value="2">Son type</option>
      <option value="3">Sa race</option>
      <option value="4">Son habitat</option>
      <option value="5">Son origine</option>
      <option value="6">Sa photo</option>
      <option value="7">Son nom commun</option>
    </select>
    <div id="result_value"></div>
    <div id="show_choice">
      <select name="update_origin" id="option_location">
        <?php foreach ($optionsLocations as $optionsLocation) : ?>
          <option value="<?php echo $optionsLocation['id_location']; ?>"><?php echo $optionsLocation['NAME']; ?></option>
        <?php endforeach; ?>
      </select>
      <select name="update_habitat" id="option_home">
        <?php foreach ($optionsHomes as $optionsHome) : ?>
          <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br />
    <button type="submit" name="formUpdateAnimal">Modifier l'animal</button>
    <br />
    <?php echo isset($updateAnimal) ? $updateAnimal : '' ?>
  </form>

  <h3>Supprimer un animal </h3>
  <form action="" method="POST" id="form_delete_animal" onsubmit="return confirmDelete()">
    <label for="animal_delete">Quel animal voulez-vous supprimer?</label>
    <select name="animal_delete" id="choice_animal">
      <?php foreach ($viewAllAnimals as $viewAnimal) : ?>
        <option value="<?php echo $viewAnimal['id_animal']; ?>"><?php echo $viewAnimal['name']; ?> (<?php echo $viewAnimal['type'] ?>)</option>
      <?php endforeach; ?>
    </select>
    <br />
    <div id="confirm_message"></div>
    <button type="submit" name="formDeleteAnimal">Supprimer l'animal</button>
    <br />
    <?php echo isset($message) ? $message : '' ?>
  </form>

  <script src="../js/admin_animal.js"></script>
</body>


</html>