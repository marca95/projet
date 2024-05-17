<!DOCTYPE html>

<?php

require_once '../mariadb/connect.php';
require_once '../mariadb/login_veterinaire.php';
require_once '../mariadb/disconnect.php';
require_once '../mariadb/states.php';
require_once '../mariadb/stmt.php';

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vétérinaire</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/veterinaire.css" rel="stylesheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/accueil/logo.png" rel="icon">
</head>

<body>
  <header>
    <h1>Arcadia</h1>
    <form method="POST" action="" class="form_logout">
      <button type="submit" name="logout" class="logout" title="déconnexion"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width='25px' title="déconnexion"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
        </svg></button>
    </form>
    <h2>Bonjour <?php echo $vetUser['first_name']; ?></h2>
    <div class="go-to-site">
      <button><a href="./index.php">Revenir vers le site</a></button>
    </div>
  </header>
  <main>
    <section>
      <h3>Comptes rendus des animaux</h3>
      <form action="" method="POST" id="search_data">
        <label for="searchBar" class="search_label"></label>
        <input type="text" name="searchBar" id="input_search" placeholder="Recherche nom de l'animal ou son type">
        <button type="submit" class="btn_search_bar"><svg xmlns="http://www.w3.org/2000/svg" width="25px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
          </svg></button>
      </form>
      <br>
      <table class="table1" id="firstTable">
        <thead class="head_table">
          <tr>
            <th>Nom de l'animal</th>
            <th>Type de l'animal</th>
            <th>Nourriture</th>
            <th>Grammes</th>
            <th>Date de passage</th>
            <th>État</th>
            <th>Détails sur l'animal</th>
            <th>Nom de l'employé</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($viewStates as $states) : ?>
            <tr>
              <td data-label="Nom animal"><?php echo $states['name']; ?></td>
              <td data-label="Type"><?php echo $states['type']; ?></td>
              <td data-label="Nourriture"><?php echo $states['food']; ?></td>
              <td data-label="Gr"><?php echo $states['grams']; ?></td>
              <td data-label="Date pass."><?php echo $states['date_pass']; ?></td>
              <td data-label="Etat"><?php echo $states['state']; ?></td>
              <td data-label="Détails"><?php echo $states['detail']; ?></td>
              <td data-label="Employe"><?php echo $states['nom_employe'] . ' ' . $states['prenom_employe']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
    <section>
      <form action="" method="POST" class="form">
        <h4>Créer un compte rendu d'un animal</h4>
        <label for="idAnimal">Quel animal souhaitez-vous mettre un commentaire ?</label>
        <select name="idAnimal" required>
          <option></option>
          <?php foreach ($viewStates as $animal) : ?>
            <option value="<?php echo $animal['id_animal']; ?>"><?php echo $animal['name'] . ' (' . $animal['type'] . ')' ?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <label for="state">Etat de l'animal :</label>
        <textarea type="text" name="state" rows="5" placeholder="Décrire l'état de l'animal..." required></textarea>
        <br>
        <label for="detail">Détails sur l'animal (facultatif) :</label>
        <textarea type="text" name="detail" rows="5" placeholder="Décrire le détail de l'animal..."></textarea>
        <br>
        <div class="but">
          <button type="submit" name="sendData">Envoyer</button>
        </div>
        <?php if ((isset($message)) && (!empty($message))) : ?>
          <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
      </form>
    </section>
    <section>
      <h3>Commentaire habitat</h3>
      <table class="table1">
        <thead class="head_table">
          <tr>
            <th>Nom de l'habitat</th>
            <th>Opinion sur l'état</th>
            <th>Moyen de développement</th>
            <th>Adresse email du vétérinaire</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($homes as $home) : ?>
            <tr>
              <td data-label="Nom"><?php echo $home['commonName']; ?></td>
              <td data-label="Opinion"><?php echo $home['opinion_state']; ?></td>
              <td data-label="Développement"><?php echo $home['improvement']; ?></td>
              <td data-label="Vétérinaire"><?php echo $home['name'] . ' ' . $home['first_name']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
    <section>
      <form action="" method="POST" class="form">
        <h4>Créer ou modifier un compte rendus d'un habitat</h4>
        <label for="idHabitat">Quel habitat souhaitez-vous mettre un commentaire ?</label>
        <select name="idHabitat" required>
          <option></option>
          <?php foreach ($homes as $home) : ?>
            <option value="<?php echo $home['id_home']; ?>"><?php echo $home['commonName']; ?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <label for="opinion">Opinion sur l'habitat :</label>
        <textarea type="text" name="opinion" rows="5" cols="80" placeholder="Votre opinion..." required></textarea>
        <br>
        <label for="improvement">Possibilité de développement :</label>
        <textarea type="text" name="improvement" rows="5" cols="80" placeholder="Développement possible..."></textarea>
        <br>
        <div class="but">
          <button type="submit" name="sendHab">Envoyer</button>
        </div>
        <?php if ((isset($messageHabitat)) && (!empty($messageHabitat))) : ?>
          <p class="message"><?php echo $messageHabitat; ?></p>
        <?php endif; ?>
      </form>
    </section>
  </main>
  <script src="./js/veterinaire.js"></script>
</body>

</html>