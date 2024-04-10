<!DOCTYPE html>
<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/login_admin.php';
require_once '../mariadb/disconnect.php';

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
  <link href="../style/css/admin_home.css" rel="stylesheet">
  <link href="../img/logo.png" rel="icon">
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
        <button type="submit" name="createNewHome" class="btn btn-success">Ajouter une nouvelle habitation</button>
        <?php echo $messageCreate ?>
      </form>
    </section>
    <section class="col-md-6 create_article">
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
        <label for="third_title">Troisième titre :</label>
        <input type="text" name="third_title">
        <?php echo $messageArticle ?>
        <button type="submit" name="createNewArticle" class="btn btn-primary">Ajouter un nouvel article</button>
        <br />
      </form>
    </section>
  </div>
  <br />
  <div class="row">
    <section class="col-md-6 update_article">
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
        <button type="submit" name="updateHome" class="btn btn-secondary">Modifier l'habitat</button>
        <br />
        <?php echo $updateMessage ?>
      </form>
    </section>
    <br />
    <section class="col-md-6 delete_article">
      <h3>Suppression d'un habitat / article </h3>
      <form action="" method="POST" id="update_form" onsubmit="return confirmDelete()">
        <label for="delete_habitat">Supprimer l'habitat : </label>
        <select name="delete_habitat" id="habitat">
          <?php foreach ($optionsHomes as $optionsHome) : ?>
            <option value="<?php echo $optionsHome['id_home']; ?>"><?php echo $optionsHome['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <br />
        <button type="submit" name="deleteHome" class="btn btn-danger">Supprimer l'habitat</button>
        <br />
        <?php echo $messageDeleteHome ?>
      </form>
    </section>
  </div>
  <script src="../js/admin_home.js"></script>
</body>

</html>