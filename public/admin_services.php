<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/login_admin.php';
require_once '../mariadb/disconnect.php';

require_once '../form_admin/create_services.php';
require_once '../form_admin/update_services.php';
require_once '../form_admin/delete_services.php';

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services administateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/admin_services.css" rel="stylesheet">
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
        <li><a href="./admin_home.php">Habitations</a></li>
        <li><a href="./admin_reports.php">Comptes rendus</a></li>
        <li><a href="./admin_dashboard.php">Dashboard</a></li>
        <li><a href="./index.php">Site officiel</a></li>
      </ul>
      <form method="POST" action="" class="form_logout">
        <button type="submit" name="logout" class="logout" title="déconnexion"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width='25px'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
          </svg></button>
      </form>
    </nav>
  </header>

  <h1>Créer, modifier ou supprimer un service</h1>

  <div class="centrage">
    <select id="action">
      <option></option>
      <option value="create">Créer</option>
      <option value="modify">Modifier</option>
      <option value="delete">Supprimer</option>
    </select>
  </div>


  <form action="" method="POST" id="formCreate" enctype="multipart/form-data" onsubmit="checkFiles(event, this);">
    <h3>Création d'un service</h3>
    <label for="main_title">Titre principal* : </label>
    <input type="text" name="main_title" maxlength="255" required>
    <br />
    <label for="second_title">Second titre : </label>
    <input type="text" name="second_title" maxlength="255">
    <br />
    <label for="main_img">Image du service* : </label>
    <input type="file" name="main_img" class="file-input" required>
    <br />
    <label for="content">Contenu* : </label>
    <input type="text" name="content" maxlength="2000" required>
    <br />
    <label for="third_title">Troisième titre : </label>
    <input type="text" name="third_title" maxlength="255">
    <br />
    <label for="second_content">Second contenu : </label>
    <input type="text" name="second_content" maxlength="2000">
    <br />
    <label for="name">Nom bref de l'activité* : </label>
    <input type="text" name="name" maxlength="255" required>
    <br />
    <label for="btn_link_url">Lien de l'URL du bouton : </label>
    <input type="text" name="btn_link_url" maxlength="255">
    <br />
    <label for="title_btn">Titre du bouton : </label>
    <input type="text" name="title_btn" maxlength="255">
    <br />
    <label for="btn_classes">Classes du bouton : </label>
    <input type="text" name="btn_classes" maxlength="255" value="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
    <p>Valeur par défaut</p>
    <label for="link_url">Lien d'une URL : </label>
    <input type="text" name="link_url" maxlength="255">
    <br />
    <label for="link_img_root">Lien de l'image : </label>
    <input type="file" name="link_img_root" class="file-input">
    <br />
    <label for="link_classes">Classes du lien : </label>
    <input type="text" name="link_classes" maxlength="255" value="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
    <p>Valeur par défaut</p>
    <p>Les champs avec (*) sont obligatoires.</p>
    <p class="extension"></p>
    <button type="submit" name="createService" class="btn btn-success">Créer un service</button>
  </form>
  <?php if ((isset($messageCreate)) && (!empty($messageCreate))) : ?>
    <p class="message"><?php echo $messageCreate ?></p>
  <?php endif; ?>

  <form action="" method="POST" id="formCreateAccueil" enctype="multipart/form-data" onsubmit="checkFiles(event, this);">
    <h3>Création d'un service à la page d'accueil</h3>
    <label for="chooseService">Quel service souhaitez-vous afficher à la page d'accueil?</label>
    <select name="chooseService">
      <option></option>
      <?php foreach ($viewService as $service) : ?>
        <option value="<?php echo $service['id_service'] ?>"><?php echo $service['main_title'] ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="accueil_content">Contenu :</label>
    <textarea name="accueil_content" id="accueil_content" maxlength="2000" rows="5" cols="50"></textarea>
    <br />
    <label for="accueil_img1">Première image : </label>
    <input type="file" name="accueil_img1" class="file-input">
    <br />
    <label for="accueil_img2">Deuxième image : </label>
    <input type="file" name="accueil_img2" class="file-input">
    <br />
    <label for="accueil_btn">Titre du bouton : </label>
    <input type="text" name="accueil_btn" maxlength="255">
    <br />
    <p class="extension"></p>
    <button type="submit" name="createServiceAccueil" class="btn btn-success">Créer un service à la page d'accueil</button>
  </form>
  <?php if ((isset($messageCreateAccueil)) && (!empty($messageCreateAccueil))) : ?>
    <p class="message"><?php echo $messageCreateAccueil ?></p>
  <?php endif; ?>

  <form action="" method="POST" id="formModify" enctype="multipart/form-data" onsubmit="checkFiles(event, this);">
    <h3>Modification d'un service</h3>
    <label for="choiceService">Quel service souhaitez-vous modifier ?</label>
    <select name="selectedService" id="selectedService" required>
      <option></option>
      <?php foreach ($viewService as $service) : ?>
        <option value="<?php echo $service['id_service'] ?>"><?php echo $service['main_title'] ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="selectedPartService">Quelle partie du service souhaitez-vous modifier?</label>
    <select name="selectedPartService" id="selectedPartService" required>
      <option value="0"></option>
      <option value="1">Le titre principal </option>
      <option value="2">Le deuxième titre </option>
      <option value="3">L'image principale du service </option>
      <option value="4">Le contenu principal </option>
      <option value="5">Le troisième titre </option>
      <option value="6">Le second contenu </option>
      <option value="7">Le nom </option>
      <option value="8">Les classes du lien </option>
      <option value="9">L'URL du lien </option>
      <option value="10">L'image du lien </option>
      <option value="11">Les classes du bouton </option>
      <option value="12">L'URL du bouton </option>
      <option value="13">Le titre du bouton </option>
    </select>
    <br />
    <div id="inputAndLabel"></div>
    <p class="extension"></p>
    <button type="submit" name="updateService" class="btn btn-primary">Modifier un service</button>
  </form>
  <?php if ((isset($updateMessage)) && (!empty($updateMessage))) : ?>
    <p class="message"><?php echo $updateMessage ?></p>
  <?php endif; ?>

  <form action="" method="POST" id="formDelete">
    <h3>Suppression d'un service</h3>
    <label for="chooseDeleteService">Quel service souhaitez-vous supprimer ?</label>
    <select name="chooseDeleteService" id="chooseDeleteService" required>
      <option></option>
      <?php foreach ($viewService as $service) : ?>
        <option value="<?php echo $service['id_service'] ?>"><?php echo $service['main_title'] ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <button type="submit" name="deleteService" class="btn btn-danger">Supprimer un service</button>
  </form>
  <?php if ((isset($messageDeleteService)) && (!empty($messageDeleteService))) : ?>
    <p class="message"><?php echo $messageDeleteService ?></p>
  <?php endif; ?>


  <script src="./js/admin_services.js"></script>
</body>

</html>