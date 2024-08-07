<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Create registration form
if (isset($_POST['submit'])) {
  if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';

    // Send mail for username and password
    $subject = 'Formulaire de contact';
    $contentEmail = "Titre de la demande : $title\n";
    $contentEmail .= "Adresse de l'expéditeur : $email\n";
    $contentEmail .= "Descriptif : $description\n";

    $mail = new PHPMailer(true);

    try {

      //Get var env
      // Dotenv\Dotenv::createImmutable(__DIR__ . '../../')->load();

      $port = $_ENV['APP_MAILER_PORT'];
      $host = $_ENV['APP_MAILER_HOST'];
      $username = $_ENV['APP_MAILER_USERNAME'];
      $password = $_ENV['APP_MAILER_PASSWORD'];
      $myEmail = $_ENV['APP_MAILER_EMAIL'];

      $mail->isSMTP();
      $mail->Host       = $host;
      $mail->SMTPAuth   = true;
      $mail->Username   = $username;
      // Password secure application
      $mail->Password   = $password;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = $port;
      $mail->CharSet = 'UTF-8';
      // From
      $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia formulaire de contact');
      $mail->addAddress($myEmail);

      // Message content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $contentEmail;

      $mail->send();
      $message = "Email bien envoyé, nous vous répondrons dans les plus bref délais";
    } catch (Exception $e) {
      $message = "Problème lors de l'envoi du mail :" . $mail->ErrorInfo;
    }
  } else {
    die('Invalid CSRF token');
  }
}
