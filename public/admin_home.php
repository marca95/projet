<!DOCTYPE html>
<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/login_admin.php';
require_once '../mariadb/disconnect.php';

require_once '../form_admin/create_home.php';
require_once '../form_admin/update_home.php';
require_once '../form_admin/delete_home.php';

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/admin_home.css" rel="stylesheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/accueil/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <div id="icon"></div>
      <ul class="navigation">
        <li><a href="./administrateur.php">Page principal</a></li>
        <li><a href="./admin_animal.php">Animaux</a></li>
        <li><a href="./admin_services.php">Services</a></li>
        <li><a href="./admin_reports.php">Comptes rendus</a></li>
        <li><a href="./admin_dashboard.php">Dashboard</a></li>
        <li><a href="./index.php">Site officiel</a></li>
      </ul>
      <form method="POST" action="" class="form_logout">
        <button type="submit" name="logout" class="logout" title="déconnexion">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width='25px'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
          </svg>
        </button>
      </form>
    </nav>
  </header>
  <h1>Gestion des habitats et articles</h1>
  <div class="row">
    <section class="col-md-6 create_home">
      <h3>Créer un habitat</h3>
      <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Lieu de l'habitat :</label>
        <input type="text" name="name" required>
        <br />
        <label for="description">Description :</label>
        <textarea type="text" name="description" rows="8" cols="10" required></textarea>
        <br />
        <label for="main_img">Image principale :</label>
        <input type="file" name="main_img" required>
        <br />
        <label for="second_img">Image secondaire :</label>
        <input type="file" name="second_img" required>
        <br />
        <label for="url_image_accueil">Image accueil :</label>
        <input type="file" name="url_image_accueil" required>
        <br />
        <label for="commonName">Nom complet de l'habitation :</label>
        <input type="text" name="commonName" required>
        <br />
        <label for="second_title">2ème nom de l'habitation :</label>
        <input type="text" name="second_title" required>
        <br />
        <button type="submit" name="createNewHome" class="btn btn-success">Ajouter une nouvelle habitation</button>
        <?php if ((isset($messageCreate)) && (!empty($messageCreate))) : ?>
          <p class="message"><?php echo $messageCreate; ?></p>
        <?php endif; ?>
      </form>
    </section>
  </div>
  <br />
  <div class="row">
    <section class="col-md-6 update_article">
      <h3>Modifier un habitat / article</h3>
      <form action="" method="POST" id="update_form" enctype="multipart/form-data">
        <label for="habitat">Selectionner l'habitat à modifier : </label>
        <select name="habitat" id="habitat" required>
          <option></option>
          <?php foreach ($homes as $home) : ?>
            <option value="<?php echo $home['id_home']; ?>"><?php echo $home['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <br />
        <label for="choose">Que souhaitez-vous modifier : </label>
        <select name="choose" id="choose" required>
          <option></option>
          <option value="1">Le nom de l'habitat</option>
          <option value="2">La photo principale</option>
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
        <button type="submit" name="updateHome" class="btn btn-secondary">Modifier l'habitat</button>
        <br />
        <?php if ((isset($updateMessage)) && (!empty($updateMessage))) : ?>
          <p class="message"><?php echo $updateMessage; ?></p>
        <?php endif; ?>
      </form>
    </section>
    <br />
    <section class="col-md-6 delete_article">
      <h3>Suppression d'un habitat / article </h3>
      <form action="" method="POST" id="update_form" onsubmit="return confirmDelete()">
        <label for="delete_habitat">Supprimer l'habitat : </label>
        <select name="delete_habitat" id="habitat" required>
          <option></option>
          <?php foreach ($homes as $home) : ?>
            <option value="<?php echo $home['id_home']; ?>"><?php echo $home['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <br />
        <button type="submit" name="deleteHome" class="btn btn-danger">Supprimer l'habitat</button>
        <br />
        <?php if ((isset($messageDeleteHome)) && (!empty($messageDeleteHome))) : ?>
          <p class="message"><?php echo $messageDeleteHome; ?></p>
        <?php endif; ?>
      </form>
    </section>
  </div>
  <script src="./js/admin_home.js"></script>
</body>

</html>