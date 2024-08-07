<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Pour effectuer les tests, mettre le chemin de l'autoload en commentaire
require '../vendor/autoload.php';
// Ajouter la connection pour effectuer le test
// require __DIR__ . '/connect.php';

//Get var env
// Dotenv\Dotenv::createImmutable(__DIR__ . '../../')->load();

$MailerPort = $_ENV['APP_MAILER_PORT'];
$MailerHost = $_ENV['APP_MAILER_HOST'];
$MailerUsername = $_ENV['APP_MAILER_USERNAME'];
$MailerPassword = $_ENV['APP_MAILER_PASSWORD'];
$MailerEmail = $_ENV['APP_MAILER_EMAIL'];

// Create registration form
if (isset($_POST['inscription'])) {
  $error = '';
  // Check DB only one unique username
  $onlyOneUsername = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $onlyOneUsername->execute(['username' => $_POST['username']]);
  $oneUsername = $onlyOneUsername->rowCount();
  // Check DB only one unique mail
  $onlyOneEmail = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $onlyOneEmail->execute(['email' => $_POST['email']]);
  $oneEmail = $onlyOneEmail->rowCount();

  if ($oneUsername > 0) {
    $error = 'Username déjà existant dans la base de données.';
  } else if ($oneEmail > 0) {
    $error = 'Email déja existant dans la base de données.';
  } else {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $id_role = intval($_POST['id_role']);
    $birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES, 'UTF-8');
    $hire = htmlspecialchars($_POST['hire'], ENT_QUOTES, 'UTF-8');

    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
      $error = 'Username invalide.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = 'Email invalide.';
    }

    $userOnlyAdmin = $pdo->prepare('SELECT COUNT(*) FROM users WHERE id_role = 1');
    $userOnlyAdmin->execute();
    $count = $userOnlyAdmin->fetchColumn();

    if ($id_role == 1 && $count > 0) {
      $error = 'Il ne peut y avoir qu\'un seul administrateur.';
    }

    if (empty($error)) {
      $request = $pdo->prepare('INSERT INTO users(name, first_name, username, email, password, id_role, birthday, hire, token) VALUES (:name, :first_name, :username, :email, :password, :id_role, :birthday, :hire, :token)');
      $request->execute(
        array(
          'name' => $name,
          'first_name' => $first_name,
          'username' => $username,
          'email' => $email,
          'password' => $password,
          'id_role' => $id_role,
          'birthday' => $birthday,
          'hire' => $hire,
          'token' => ''
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
        $mail->Host       = $MailerHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $MailerUsername;
        // Password secure application
        $mail->Password   = $MailerPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $MailerPort;
        $mail->CharSet = 'UTF-8';
        // Destinataire
        $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia Zoo');
        $mail->addAddress($MailerEmail, $name); // I need exist adress, warning my users are not really

        // Contenu du message
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $contentEmail;

        $mail->send();
        $successMail = 'Vous avez reçu un email avec vos données personnelles.';
      } catch (Exception $e) {
        $error = 'Il y a eu une erreur lors de l\'envoi du mail : ' + $mail->ErrorInfo;
      }
    }
  }
}


$selectAllUsers = $pdo->prepare('SELECT * FROM users');
$selectAllUsers->execute();
$users = $selectAllUsers->fetchAll(PDO::FETCH_ASSOC);

$succesDelete = '';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['delete'])) {
  $idUser = intval($_POST['user']);

  if ($idUser > 0) {
    $request = $pdo->prepare('DELETE FROM users WHERE id_user = :iduser');
    $request->bindValue('iduser', $idUser, PDO::PARAM_INT);
    if ($request->execute()) {
      $succesDelete = 'Utilisateur supprimé avec succès !';
    } else {
      $succesDelete = "Erreur lors de la suppression de l'utilisateur.";
    }
  } else {
    $succesDelete = "ID utilisateur invalide.";
  }
}
