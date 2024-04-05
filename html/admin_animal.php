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

// btn logout session
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: connexion.php");
  exit();
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin_animal.css" rel="stylesheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <div id="icon"></div>
      <ul class="navigation">
        <li><a href="./administrateur.php">Page principal</a></li>
        <li><a href="./admin_home.php">Habitations</a></li>
        <li><a href="./admin_services.php">Services</a></li>
        <li><a href="./admin_reports.php">Comptes rendus</a></li>
        <li><a href="./admin_dashboard.php">Dashboard</a></li>
      </ul>
      <form method="POST" action="" class="form_logout">
        <button type="submit" name="logout" class="logout" title="déconnexion">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="25px"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
          </svg>
        </button>
      </form>
    </nav>
  </header>
  <h1>Gestion des animaux</h1>

  <section class="create_animal">
    <h3>Créer un animal </h3>
    <!-- enctype sert spécifier comment les données du formulaire sont encodées aux serveur
multipart/form data est souvent utilisé quand il contient des fichiers -->
    <form action="" method="POST" enctype="multipart/form-data" class="form_create_animal">
      <label for="name">Nom de l'animal :</label>
      <br />
      <input type="text" name="name">
      <br />
      <label for="type">Le type d'animal :</label>
      <br />
      <input type="text" name="type">
      <br />
      <label for="race">Race de l'animal :</label>
      <br />
      <input type="text" name="race">
      <br />
      <label for="location">Lieu d'origine de l'animal :</label>
      <br />
      <select name="location" id="location">
        <?php foreach ($optionsLocations as $optionsLocation) : ?>
          <option value="<?php echo $optionsLocation['id_location']; ?>"><?php echo $optionsLocation['NAME']; ?></option>
        <?php endforeach; ?>
      </select>
      <br />
      <label for="home">Dans quelle habitat va se trouver l'animal :</label>
      <br />
      <select name="home" id="home">
        <?php foreach ($optionsHomes as $optionsHome) : ?>
          <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <br />
      <label for="commonName">Nom commun de ou des animaux :</label>
      <br />
      <input type="text" name="commonName">
      <br />
      <label for="upload">Sélectionner une image</label>
      <br />
      <input type="file" name="upload" class="upload_file">
      <br />
      <button type="submit" name="createNewAnimal" class="btn btn-success">Inscrire le nouvelle animal</button>
      <br />
      <?php echo isset($inscriptionAnimal) ? $inscriptionAnimal : '' ?>
    </form>
  </section>


  <section class="update_animal">
    <h3>Modifier un animal </h3>
    <form action="" method="POST" enctype="multipart/form-data" id="form_update_animal">
      <label for="choice_animal">Choissisez votre animal :</label>
      <br />
      <select name="choice_animal" id="choice_animal">
        <?php foreach ($viewAllAnimals as $viewAnimal) : ?>
          <option value="<?php echo $viewAnimal['id_animal']; ?>"><?php echo $viewAnimal['name']; ?> (<?php echo $viewAnimal['type'] ?>)</option>
        <?php endforeach; ?>
      </select>
      <br />
      <label for="attribut_animal">Que souhaitez-vous modifier :</label>
      <br />
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
      <div id="show_choice_origin">
        <label for="update_origin">Sa nouvelle origine : </label>
        <select name="update_origin" id="option_location">
          <?php foreach ($optionsLocations as $optionsLocation) : ?>
            <option value="<?php echo $optionsLocation['id_location']; ?>"><?php echo $optionsLocation['NAME']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div id="show_choice_home">
        <label for="update_habitat">Son nouveau habitat : </label>
        <select name="update_habitat" id="option_home">
          <?php foreach ($optionsHomes as $optionsHome) : ?>
            <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <br />
      <button type="submit" name="formUpdateAnimal" class="btn btn-secondary">Modifier l'animal</button>
      <br />
      <?php echo isset($updateAnimal) ? $updateAnimal : '' ?>
    </form>
  </section>

  <section class="delete_animal">
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
      <button type="submit" name="formDeleteAnimal" class="btn btn-danger">Supprimer l'animal</button>
      <br />
      <?php echo isset($message) ? $message : '' ?>
    </form>
  </section>


  <script src="../js/admin_animal.js"></script>
</body>


</html>