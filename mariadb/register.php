<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../divers/PHPMailer-master/src/Exception.php';
require '../divers/PHPMailer-master/src/PHPMailer.php';
require '../divers/PHPMailer-master/src/SMTP.php';

// Create registration form
if (isset($_POST['inscription'])) {
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
        $error = 'Il y a eu une erreur lors de l\'envoi du mail : ' + $mail->ErrorInfo;
      }
    }
  }
}
