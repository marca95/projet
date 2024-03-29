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
      $successSignUp = 'Inscription réussie.';

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
        // $mail->SMTPDebug = 1; If I need disable
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'monzooarcadia@gmail.com';
        // Password secure application
        $mail->Password   = 'pboc fkwe gsyu hplk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        // Destinataire
        $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia Zoo');
        $mail->addAddress('pierre.majerus@outlook.be', $name); // I need exist adress, warning my users are not really

        // Contenu du message
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $contentEmail;

        $mail->send();
        $successMail = 'Vous avez reçu un email avec vos données personnelles.';
      } catch (Exception $e) {
        $errorMail = 'Il y a eu une erreur lors de l\'envoi du mail : ' + $mail->ErrorInfo;
      }
    }
  }
}
// Update hourly

$horaires = $pdo->prepare('SELECT * FROM horaires');
$horaires->execute();
$sethoraires = $horaires->fetchAll(PDO::FETCH_ASSOC);

$succesHour = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $newMondayStart = $_POST['mondayStart'];
  $newMondayEnd = $_POST['mondayEnd'];
  $newMondayClosed = $_POST['mondayClosed'];
  $newTuesdayStart = $_POST['tuesdayStart'];
  $newTuesdayEnd = $_POST['tuesdayEnd'];
  $newTuesdayClosed = $_POST['tuesdayClosed'];
  $newWednesdayStart = $_POST['wednesdayStart'];
  $newWednesdayEnd = $_POST['wednesdayEnd'];
  $newWednesdayClosed = $_POST['wednesdayClosed'];
  $newThursdayStart = $_POST['thursdayStart'];
  $newThursdayEnd = $_POST['thursdayEnd'];
  $newThursdayClosed = $_POST['thursdayClosed'];
  $newFridayStart = $_POST['fridayStart'];
  $newFridayEnd = $_POST['fridayEnd'];
  $newFridayClosed = $_POST['fridayClosed'];
  $newSaturdayStart = $_POST['saturdayStart'];
  $newSaturdayEnd = $_POST['saturdayEnd'];
  $newSaturdayClosed = $_POST['saturdayClosed'];
  $newSundayStart = $_POST['sundayStart'];
  $newSundayEnd = $_POST['sundayEnd'];
  $newSundayClosed = $_POST['sundayClosed'];

  $stmt = $pdo->prepare('UPDATE horaires SET start_time = :start_time, end_time = :end_time, is_closed = :is_closed WHERE day_week = :day_week');

  $stmt->execute(['start_time' => $newMondayStart, 'end_time' => $newMondayEnd, 'is_closed' => $newMondayClosed, 'day_week' => 'Lundi']);
  $stmt->execute(['start_time' => $newTuesdayStart, 'end_time' => $newTuesdayEnd, 'is_closed' => $newTuesdayClosed, 'day_week' => 'Mardi']);
  $stmt->execute(['start_time' => $newWednesdayStart, 'end_time' => $newWednesdayEnd, 'is_closed' => $newWednesdayClosed, 'day_week' => 'Mercredi']);
  $stmt->execute(['start_time' => $newThursdayStart, 'end_time' => $newThursdayEnd, 'is_closed' => $newThursdayClosed, 'day_week' => 'Jeudi']);
  $stmt->execute(['start_time' => $newFridayStart, 'end_time' => $newFridayEnd, 'is_closed' => $newFridayClosed, 'day_week' => 'Vendredi']);
  $stmt->execute(['start_time' => $newSaturdayStart, 'end_time' => $newSaturdayEnd, 'is_closed' => $newSaturdayClosed, 'day_week' => 'Samedi']);
  $stmt->execute(['start_time' => $newSundayStart, 'end_time' => $newSundayEnd, 'is_closed' => $newSundayClosed, 'day_week' => 'Dimanche']);

  $succesHour = 'Enregistrement validé.';
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
  <link href="../style/css/admin.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <h1>Bonjour <?php echo $_SESSION['first_name_user'] ?> </h1>
  <!-- AJOUTER EMAIL PRIVE A LA BASE DE DONNEES  -->
  <section>
    <h3>Enregistrer un nouveau membre :</h3>
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
        <p id="success">
          <?php
          echo $successSignUp;
          echo $successMail;
          ?></p>
      <?php endif; ?>
      <?php if (isset($error) && !empty($error)) : ?>
        <p id="error">
          <?php
          echo $error;
          echo $errorMail;
          ?></p>
      <?php endif; ?>
      <br />
      <button type="submit" name="inscription">Inscription</button>
      <br />
    </form>
  </section>
  <section>
    <!-- COMPLETER MODIFICATION DES SERVICES HORAIRE ANIMAUX-->
  </section>
  <section>
    <h3>Modification des horaires</h3>
    <?php
    if ($sethoraires) {

      foreach ($sethoraires as $sethoraire) {
        $setDay = $sethoraire['day_week'];
        $setIsClosed = $sethoraire['is_closed'];
        $setStartTime = $sethoraire['start_time'];
        $setEndTime = $sethoraire['end_time'];

        echo "<li>$setDay : ";
        echo $setIsClosed ? 'Fermé' : "$setStartTime à $setEndTime";
        echo '</li>';
      }
    } else {
      echo "Aucun horaire trouvé.";
    }
    ?>
    <form action="" method="POST">

      <label for="mondayClosed">Le lundi est :</label>
      <select type="text" name="mondayClosed" id="mondayClosed">
        <option value="0">Ouvert</option>
        <option value="1" selected>Fermé</option>
      </select>
      <label for="mondayStart">Ouverture à :</label>
      <input type="text" name="mondayStart" id="mondayStart" placeholder="Heure début">
      <label for="mondayEnd">Fermeture à :</label>
      <input type="text" name="mondayEnd" id="mondayEnd" placeholder="Heure fin">
      <br />
      <label for="tuesdayClosed">Le mardi est :</label>
      <select type="text" name="tuesdayClosed" id="tuesdayClosed">
        <option value="0">Ouvert</option>
        <option value="1" selected>Fermé</option>
      </select>
      <label for="tuesdayStart">Ouverture à :</label>
      <input type="text" name="tuesdayStart" id="tuesdayStart" placeholder="Heure début">
      <label for="tuesdayEnd">Fermeture à :</label>
      <input type="text" name="tuesdayEnd" id="tuesdayEnd" placeholder="Heure fin">
      <br />
      <label for="wednesdayClosed">Le mercredi est :</label>
      <select type="text" name="wednesdayClosed" id="wednesdayClosed">
        <option value="0">Ouvert</option>
        <option value="1">Fermé</option>
      </select>
      <label for="wednesdayStart">Ouverture à :</label>
      <input type="text" name="wednesdayStart" id="wednesdayStart" placeholder="Heure début" value="10h">
      <label for="wednesdayEnd">Fermeture à :</label>
      <input type="text" name="wednesdayEnd" id="wednesdayEnd" placeholder="Heure fin" value="19h">
      <br />
      <label for="thursdayClosed">Le jeudi est :</label>
      <select type="text" name="thursdayClosed" id="thursdayClosed">
        <option value="0">Ouvert</option>
        <option value="1">Fermé</option>
      </select>
      <label for="thursdayStart">Ouverture à :</label>
      <input type="text" name="thursdayStart" id="thursdayStart" placeholder="Heure début" value="10h">
      <label for="thursdayEnd">Fermeture à :</label>
      <input type="text" name="thursdayEnd" id="thursdayEnd" placeholder="Heure fin" value="19h">
      <br />
      <label for="fridayClosed">Le vendredi est :</label>
      <select type="text" name="fridayClosed" id="fridayClosed">
        <option value="0">Ouvert</option>
        <option value="1">Fermé</option>
      </select>
      <label for="fridayStart">Ouverture à :</label>
      <input type="text" name="fridayStart" id="fridayStart" placeholder="Heure début" value="10h">
      <label for="fridayEnd">Fermeture à :</label>
      <input type="text" name="fridayEnd" id="fridayEnd" placeholder="Heure fin" value="19h">
      <br />
      <label for="saturdayClosed">Le samedi est :</label>
      <select type="text" name="saturdayClosed" id="saturdayClosed">
        <option value="0">Ouvert</option>
        <option value="1">Fermé</option>
      </select>
      <label for="saturdayStart">Ouverture à :</label>
      <input type="text" name="saturdayStart" id="saturdayStart" placeholder="Heure début" value="10h">
      <label for="saturdayEnd">Fermeture à :</label>
      <input type="text" name="saturdayEnd" id="saturdayEnd" placeholder="Heure fin" value="19h">
      <br />
      <label for="sundayClosed">Le dimanche est :</label>
      <select type="text" name="sundayClosed" id="sundayClosed">
        <option value="0">Ouvert</option>
        <option value="1">Fermé</option>
      </select>
      <label for="sundayStart">Ouverture à :</label>
      <input type="text" name="sundayStart" id="sundayStart" placeholder="Heure début" value="10h">
      <label for="sundayEnd">Fermeture à :</label>
      <input type="text" name="sundayEnd" id="sundayEnd" placeholder="Heure fin" value="19h">
      <br />
      <?php if (isset($succesHour) && !empty($succesHour)) : ?>
        <p id="success">
          <?php
          echo $succesHour;
          ?></p>
      <?php endif; ?>
      <button type="submit">Enregistrer les modifications</button>
    </form>
  </section>

  <!-- BTN DE DECONNEXION-->
  <form method="POST" action="">
    <button type="submit" name="logout">Déconnexion</button>
  </form>

  <script src="../js/admin.js"></script>
</body>

</html>