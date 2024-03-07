<!DOCTYPE html>
<?php

// Connect DB
$user = 'root';
$passwordBD = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=zoo', $user, $passwordBD);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

// Login session 

session_start();
$request = $pdo->prepare('SELECT * FROM users WHERE id_role = 1');
$request->execute();
$user = $request->fetch();
if (
  isset($_SESSION['id_role'], $_SESSION['email'], $_SESSION['password']) &&
  $_SESSION['id_role'] == 1 &&
  $_SESSION['email'] == $user['email'] &&
  password_verify($_SESSION['password'], $user['password'])
) {
} else {
  header("Location: connexion.php");
  exit();
}


// Create registration form
if (isset($_POST['inscription'])) {
  $name = $_POST['name'];
  $first_name = $_POST['first_name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $id_role = $_POST['id_role'];
  $birthday = $_POST['birthday'];
  $hire = $_POST['hire'];

  $userOnlyAdmin = $pdo->prepare('SELECT COUNT(*) FROM users WHERE id_role = 1');
  $userOnlyAdmin->execute();
  $count = $userOnlyAdmin->fetchColumn();

  if ($id_role == 1 && $count > 0) {
    $error = 'Il ne peut y avoir qu\'un seul administrateur.';
  } else {
    $request = $pdo->prepare('INSERT INTO users(name, first_name, email, password, id_role, birthday, hire) VALUES (:name, :first_name, :email, :password, :id_role, :birthday, :hire)');
    $request->execute(
      array(
        'name' => $name,
        'first_name' => $first_name,
        'email' => $email,
        'password' => $password,
        'id_role' => $id_role,
        'birthday' => $birthday,
        'hire' => $hire
      )
    );
    $success = 'Inscription réussie.';
  }
}
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
  <link href="../style/css/administrateur.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <h1>Bonjour <?php echo $_SESSION['first_name_user'] ?> </h1>

  <form method="POST" action="" id="form">
    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="first_name">Prénom :</label>
    <input type="text" name="first_name" id="first_name" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="id_role">Id role :</label>
    <label>
      <input type="radio" name="id_role" value="2" required> Vétérinaire
    </label>
    <label>
      <input type="radio" name="id_role" value="3" required> Employé(e)
    </label>
    <br>
    <label for="birthday">Anniversaire :</label>
    <input type="date" name="birthday" required>
    <br>
    <label for="hire">Engagé(e) :</label>
    <input type="date" name="hire" required>
    <br>
    <button type="submit" name="inscription">Inscription</button>
    <br>
    <?php if (isset($_POST['inscription']) && !empty($error)) :  ?>
      <div style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($_POST['inscription']) && !empty($success)) : ?>
      <div style="color: green;"><?php echo $success; ?></div>
    <?php endif; ?>
  </form>

  <!-- BTN DE DECONNEXION-->
  <form method="POST" action="">
    <button type="submit" name="logout">Déconnexion</button>
  </form>
  <script src="../js/administrateur.js"></script>
</body>

</html>