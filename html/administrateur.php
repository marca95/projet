<!DOCTYPE html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../divers/PHPMailer-master/src/Exception.php';
require '../divers/PHPMailer-master/src/PHPMailer.php';
require '../divers/PHPMailer-master/src/SMTP.php';

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

session_start();
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


// Create registration form
if (isset($_POST['inscription'])) {
  // Check DB only one unique mail
  $onlyOneEmail = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $onlyOneEmail->execute(array('username' => $_POST['username']));
  $oneEmail = $onlyOneEmail->fetchColumn();

  if ($oneEmail) {
    $error = 'Adresse mail déjà existante.';
  } else {
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];
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
      $request = $pdo->prepare('INSERT INTO users(name, first_name, username, email, password, id_role, birthday, hire) VALUES (:name, :first_name, :username, :email, :password, :id_role, :birthday, :hire)');
      $request->execute(
        array(
          'name' => $name,
          'first_name' => $first_name,
          'username' => $username,
          'email' => $email,
          'password' => $password,
          'id_role' => $id_role,
          'birthday' => $birthday,
          'hire' => $hire
        )
      );
      $success = 'Inscription réussie.';

      // send mail for username and password
      $subject = 'Données du nouveau compte chez Arcadia';
      $contentEmail = "Nom: $name\n";
      $contentEmail .= "Prénom: $first_name\n";
      $contentEmail .= "Username: $username\n";
      $contentEmail .= "Role: $id_role\n";
      $contentEmail .= "Date d'anniversaire: $birthday\n";
      $contentEmail .= "Engagé(e) le: $hire\n";
      $contentEmail .= "Pour le mot de passe, veuillez vous adressez au directeur du zoo.\n";

      $mail = new PHPMailer(true);

      try {
        // Paramètres SMTP pour Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'monzooarcadia@gmail.com';
        $mail->Password   = 'zooarcadia1995';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        // OR 
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        // $mail->Port = 465;


        // Destinataire
        $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia Zoo');
        $mail->addAddress('pierre.majerus@outlook.be', $name); // I need exist adress

        // Contenu du message
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $contentEmail;


        $mail->send();
        echo 'Vous avez reçu un email avec vos données personnelles';
      } catch (Exception $e) {
        echo 'Il y a eu une erreur lors de l\'envoi du mail : ', $mail->ErrorInfo;
        echo $mail->SMTPDebug = 1;
      }
    }
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
  <title>Zoo d'Arcadia en Br/etagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/admin.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <h1>Bonjour <?php echo $_SESSION['first_name_user'] ?> </h1>
  <!-- AJOUTER EMAIL PRIVE A LA BASE DE DONNEES  -->
  <section>
    <form method="POST" action="" id="form">
      <label for="name">Nom :</label>
      <input type="text" name="name" id="name" oninput="clearSuccess()" required>
      <br />
      <label for="first_name">Prénom :</label>
      <input type="text" name="first_name" id="first_name" oninput="clearSuccess()" required>
      <br />
      <label for="email">Email (Privé) :</label>
      <input type="email" name="email" id="email" oninput="clearSuccess()" required>
      <br />
      <label for="username">Username :</label>
      <input type="email" name="username" id="username" oninput="clearSuccess()" required>
      <br />
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" oninput="clearSuccess()" required>
      <br />
      <br />
      <label for="password2">Vérification du mot de passe :</label>
      <input type="password" name="password2" id="password2" oninput="clearSuccess()" required>
      <br />
      <label for="id_role">Id role :</label>
      <label>
        <input type="radio" name="id_role" value="2" required> Vétérinaire
      </label>
      <label>
        <input type="radio" name="id_role" value="3" required> Employé(e)
      </label>
      <br />
      <label for="birthday">Anniversaire :</label>
      <input type="date" name="birthday" id="birthday" oninput="clearSuccess()" required>
      <br />
      <label for="hire">Engagé(e) :</label>
      <input type="date" name="hire" id="hire" oninput="clearSuccess()" required>
      <p id="errorInput"></p>
      <br />
      <?php if (isset($success) && !empty($success)) : ?>
        <p id="success"><?php echo $success; ?></p>
      <?php endif; ?>
      <?php if (isset($error) && !empty($error)) : ?>
        <p id="error"><?php echo $error; ?></p>
      <?php endif; ?>
      <br />
      <button type="submit" name="inscription">Inscription</button>
      <br />
    </form>
  </section>
  <section></section>




  <!-- BTN DE DECONNEXION-->
  <form method="POST" action="">
    <button type="submit" name="logout">Déconnexion</button>
  </form>

  <script src="../js/admin.js"></script>
</body>

</html>