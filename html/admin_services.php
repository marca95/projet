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

require_once('../form_admin/create_services.php');
require_once('../form_admin/update_services.php');
require_once('../form_admin/delete_services.php');

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin_services.css" rel="stylesheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>

  <h3>Créer, modifier ou supprimer un service</h3>

  <select id="action">
    <option></option>
    <option value="create">Créer</option>
    <option value="modify">Modifier</option>
    <option value="delete">Supprimer</option>
  </select>

  <form action="" method="POST" id="formCreate" enctype="multipart/form-data">
    <label for="main_title">Titre principal* : </label>
    <input type="text" name="main_title">
    <br />
    <label for="second_title">Second titre : </label>
    <input type="text" name="second_title">
    <br />
    <label for="main_img">Image du service* : </label>
    <input type="file" name="main_img">
    <br />
    <label for="content">Contenu* : </label>
    <input type="text" name="content">
    <br />
    <label for="third_title">Troisième titre : </label>
    <input type="text" name="third_title">
    <br />
    <label for="second_content">Second contenu : </label>
    <input type="text" name="second_content">
    <br />
    <label for="name">Nom bref de l'activité* : </label>
    <input type="text" name="name">
    <br />
    <label for="btn_link_url">Lien de l'URL du bouton : </label>
    <input type="text" name="btn_link_url">
    <br />
    <label for="title_btn">Titre du bouton : </label>
    <input type="text" name="title_btn">
    <br />
    <label for="btn_classes">Classes du bouton : </label>
    <input type="text" name="btn_classes" value="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
    <p>Valeur par défaut</p>
    <label for="link_url">Lien d'une URL : </label>
    <input type="text" name="link_url">
    <br />
    <label for="link_img_root">Lien de l'image : </label>
    <input type="file" name="link_img_root">
    <br />
    <label for="link_classes">Classes du lien : </label>
    <input type="text" name="link_classes" value="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
    <p>Valeur par défaut</p>
    <p>Les champs avec (*) sont obligatoire.</p>
    <button type="submit" name="createService">Créer un service</button>
  </form>
  <?php echo $messageCreate ?>

  <form action="" method="POST" id="formModify" enctype="multipart/form-data">
    <label for="choiceService">Quel service souhaitez-vous modifier ?</label>
    <select name="selectedService" id="selectedService">
      <?php foreach ($viewService as $service) : ?>
        <option value="<?php echo $service['id_service'] ?>"><?php echo $service['main_title'] ?></option>
      <?php endforeach; ?>
    </select>
    <br />
    <label for="selectedPartService">Quelle partie du service souhaitez-vous modifier?</label>
    <select name="selectedPartService" id="selectedPartService">
      <option value="0"></option>
      <option value="1">Le titre principal </option>
      <option value="2">Le deuxième titre </option>
      <option value="3">L'image principal du service </option>
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
    <button type="submit" name="updateService">Modifier un service</button>
  </form>

  <form action="" method="POST" id="formDelete">
    <label for="choiceService">Quel service souhaitez-vous supprimer ?</label>
    <select name="" id="">
      <option value=""></option>
    </select>
    <br />
    <div id="inputAndLabel"></div>
    <button type="submit" name="deleteService">Supprimer un service</button>
  </form>

  <script src="../js/admin_services.js"></script>
</body>

</html>