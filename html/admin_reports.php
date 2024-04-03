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

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comptes rendus</title>
  <link href="../style/css/admin_reports.css" rel="stylesheet">
</head>

<body>
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