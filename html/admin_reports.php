<!DOCTYPE html>

<?php
session_start();


require_once '../mariadb/connect.php';
require_once '../mariadb/login_admin.php';
require_once '../mariadb/disconnect.php';
// REMPLACER PAR INNER JOIN SI TOUS LES ANIMAUX SONT COMPLETER 

$viewData = $pdo->prepare('SELECT animals.name, animals.type, 
foods.food, foods.grams, foods.date_pass, 
states.state, states.detail, 
user_employed.username as nom_employe_employed,
user_vete.username as nom_employe_vete
FROM animals 
LEFT JOIN foods ON animals.id_animal = foods.id_animal
LEFT JOIN states ON animals.id_animal = states.id_animal
LEFT JOIN users as user_employed ON foods.id_employed = user_employed.id_user
LEFT JOIN users as user_vete ON states.id_vete = user_vete.id_user;');
$viewData->execute();
$datas = $viewData->fetchAll(PDO::FETCH_ASSOC);

// States homes
$viewHomes = $pdo->prepare('SELECT homes.name, homes.description, status_home.opinion_state, status_home.improvement, users.username
FROM homes
LEFT JOIN status_home ON status_home.id_home = homes.id_home
LEFT JOIN users ON users.id_user = status_home.id_veto');
$viewHomes->execute();
$homes = $viewHomes->fetchAll(PDO::FETCH_ASSOC);

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
  <title>Comptes rendus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin_reports.css" rel="stylesheet">
</head>

<body>
  <header>
    <nav id="nav">
      <div id="icon"></div>
      <ul class="navigation">
        <li><a href="./administrateur.php">Page principal</a></li>
        <li><a href="./admin_animal.php">Animaux</a></li>
        <li><a href="./admin_home.php">Habitations</a></li>
        <li><a href="./admin_services.php">Services</a></li>
        <li><a href="./admin_dashboard.php">Dashboard</a></li>
      </ul>
      <form method="POST" action="" class="form_logout">
        <button type="submit" name="logout" class="logout" title="déconnexion"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width='25px'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
          </svg></button>
      </form>
    </nav>
  </header>
  <h2>Les comptes rendus pour l'administrateur</h2>

  <h3>Recherche d'un animal</h3>
  <form action="" method="POST" id="search_data">
    <label for="searchBar" class="search_label"></label>
    <input type="text" name="searchBar" id="input_search" placeholder="Recherche par date ou animal">
    <button type="submit" class="btn_search_bar"><svg xmlns="http://www.w3.org/2000/svg" width="25px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
      </svg></button>
  </form>
  <br>
  <table class="table1">
    <thead class="head_table">
      <tr>
        <th>Nom de l'animal</th>
        <th>Type de l'animal</th>
        <th>Nourriture</th>
        <th>Grammes</th>
        <th>Date de passage</th>
        <th>État</th>
        <th>Détails de l'état</th>
        <th>Nom de l'employé</th>
        <th>Nom du vétérinaire</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datas as $data) : ?>
        <tr>
          <td><?php echo $data['name']; ?></td>
          <td><?php echo $data['type']; ?></td>
          <td><?php echo $data['food']; ?></td>
          <td><?php echo $data['grams']; ?></td>
          <td><?php echo $data['date_pass']; ?></td>
          <td><?php echo $data['state']; ?></td>
          <td><?php echo $data['detail']; ?></td>
          <td><?php echo $data['nom_employe_employed']; ?></td>
          <td><?php echo $data['nom_employe_vete']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Vue sur les états des habitats</h3>
  <table class="table2">
    <thead class="head_table">
      <tr>
        <th>Nom de l'habitat</th>
        <th>Description de l'habitat</th>
        <th>Avis sur l'état</th>
        <th>Amélioration</th>
        <th>Nom du vétérinaire</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($homes as $home) : ?>
        <tr>
          <td><?php echo $home['name']; ?></td>
          <td><?php echo $home['description']; ?></td>
          <td><?php echo $home['opinion_state']; ?></td>
          <td><?php echo $home['improvement']; ?></td>
          <td><?php echo $home['username']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script src="../js/admin_reports.js"></script>
</body>

</html>