<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/login_employe.php';
require_once '../mariadb/disconnect.php';
require_once '../mariadb/avis.php';
require_once '../mariadb/employe_avis.php';
require_once '../mariadb/employe_animal.php';
require_once '../mariadb/animals.php';
require_once '../form_admin/update_services.php';

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employé</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/employe.css" rel="stylesheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/accueil/logo.png" rel="icon">
  <style>

  </style>
</head>

<body>
  <header>
    <h1>Arcadia</h1>
    <h2>Bonjour <?php echo $empUser['first_name'] ?> !</h2>
    <form method="POST" action="" class="form_logout">
      <button type="submit" name="logout" class="logout" title="déconnexion"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
        </svg></button>
    </form>
    <div class="go-to-site">
      <button><a href="./index.php">Revenir vers le site</a></button>
    </div>
  </header>
  <main>
    <section class="avis">
      <h3>Gestion des avis :</h3>
      <form id="updateAvisForm" action="" method="POST">
        <div class="row">
          <?php foreach ($avisPending as $avis) : ?>
            <div class="col-12 col-md-6 p-4 d-block mb-4 gestion">
              <p class="number"> Commentaire numéro : <?php echo $avis['id_avis'] ?> </p>
              <p class="prenom"> <?php echo $avis['first_name'] ?> :</p>
              <p class="content"> <?php echo $avis['content'] ?> </p>
              <p class="status" style="<?php echo $avis['status'] === 'published' ? 'color: green;' : 'color: red;'; ?>">
                <?php echo $avis['status'] == 'published' ? "L'article est en ligne." : "L'article est en attente de traitement." ?>
              </p>
              <label for="<?php echo $avis['id_avis']; ?>">Vous pouvez changer l'état de l'avis : </label>
              <select name="status[<?php echo $avis['id_avis']; ?>]">
                <option></option>
                <option value="pending">En attente</option>
                <option value="published">Publié</option>
                <option value="delete">Supprimer</option>
              </select>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="but">
          <button class="btn btn-primary" type="submit" name="update_avis">Valider les changements</button>
        </div>
      </form>
      <?php if ((isset($messageAvis)) && (!empty($messageAvis))) : ?>
        <p class="message"><?php echo $messageAvis; ?></p>
      <?php endif; ?>
    </section>

    <section class="service">
      <h3>Vous souhaitez modifier un service</h3>
      <form action="" method="POST" id="formModify" enctype="multipart/form-data" onsubmit="checkFiles(event, this);">
        <div class="d-flex row">
          <label for="choiceService" class="label">Quel service souhaitez-vous modifier ?</label>
          <select name="selectedService" id="selectedService" required>
            <option></option>
            <?php foreach ($viewService as $service) : ?>
              <option value="<?php echo $service['id_service'] ?>"><?php echo $service['main_title'] ?></option>
            <?php endforeach; ?>
          </select>
          <br />
          <label for="selectedPartService" class="label">Quelle partie du service souhaitez-vous modifier?</label>
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
        </div>

        <p class="extension"></p>
        <div id="inputAndLabel"></div>
        <div class="but">
          <button type="submit" name="updateService" class="btn btn-primary">Modifier un service</button>
        </div>
        <?php if ((isset($updateMessage)) && (!empty($updateMessage))) : ?>
          <p class="message"><?php echo $updateMessage; ?></p>
        <?php endif; ?>
      </form>
    </section>

    <section class="food">
      <h3>L'alimentation des animaux</h3>
      <form action="" method="POST" id="form-food">
        <div class="row">
          <div class="col-12 col-md-6 mb-4 d-flex">
            <label for="nameAnimal" class="foodLabel">Sélectionner le nom de l'animal :</label>
            <select name="nameAnimal" class="foodInput" required>
              <option></option>
              <?php foreach ($viewAllAnimals as $animal) : ?>
                <option value="<?php echo $animal['id_animal']; ?>"><?php echo $animal['name'] . ' (' . $animal['type'] . ')'; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12 col-md-6 mb-4 d-flex">
            <label for="food" class="foodLabel">Sa nourriture :</label>
            <input type="text" name="food" class="foodInput" maxlength="100" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 mb-4 d-flex">
            <label for="grams" class="foodLabel">Combien de grammes :</label>
            <input type="number" name="grams" class="foodInput" max="99999" required>
          </div>
          <div class="col-12 col-md-6 mb-4 d-flex">
            <label for="datePass" class="foodLabel">Date et heure de repas :</label>
            <input type="datetime-local" name="datePass" class="foodInput" required>
          </div>
        </div>
        <div class="but">
          <p class="checkDateAndHours"></p>
          <button type="submit" name="sendDatas" class="btn btn-primary">Envoi des données</button>
        </div>
        <?php if ((isset($updateAnimal)) && (!empty($updateAnimal))) : ?>
          <p class="message"><?php echo $updateAnimal; ?></p>
        <?php endif; ?>
      </form>
    </section>

    <section>

    </section>
  </main>
  <script src="./js/employe.js"></script>

</body>

</html>