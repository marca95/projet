<!DOCTYPE html>
<?php
$user = 'root';
$passwordBD = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=zoo', $user, $passwordBD);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

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
  <h1>Admin</h1>

  <form method="POST" action="administrateur.php">
    <label for="name">Nom :</label>
    <input type="text" name="name" required>
    <br>
    <label for="first_name">Prénom :</label>
    <input type="text" name="first_name" required>
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    <br>
    <label for="id_role">Id role :</label>
    <input type="number" name="id_role" required>
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
</body>

</html>