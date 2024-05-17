
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//Get var env
Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();

$port = $_ENV['APP_MAILER_PORT'];
$host = $_ENV['APP_MAILER_HOST'];
$username = $_ENV['APP_MAILER_USERNAME'];
$password = $_ENV['APP_MAILER_PASSWORD'];
$myEmail = $_ENV['APP_MAILER_EMAIL'];

// Create registration form
if (isset($_POST['submit'])) {

  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $description = isset($_POST['description']) ? $_POST['description'] : '';

  // Send mail for username and password
  $subject = 'Formulaire de contact';
  $contentEmail = "Titre de la demande : $title\n";
  $contentEmail .= "Adresse de l'expéditeur : $email\n";
  $contentEmail .= "Descriptif : $description\n";

  $mail = new PHPMailer(true);

  try {
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
    $message = "Problème lors de l'envoi du mail : </p>" + $mail->ErrorInfo;
  }
}
