<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//Get var env
Dotenv\Dotenv::createImmutable(__DIR__ . '../../')->load();

$mailerPort = $_ENV['APP_MAILER_PORT'];
$mailerHost = $_ENV['APP_MAILER_HOST'];
$mailerUsername = $_ENV['APP_MAILER_USERNAME'];
$mailerPassword = $_ENV['APP_MAILER_PASSWORD'];
$mailerEmail = $_ENV['APP_MAILER_EMAIL'];

$mail = new PHPMailer(true);

try {
  // Paramètres SMTP pour Gmail
  // $mail->SMTPDebug = 1; If I need disable
  $mail->isSMTP();
  $mail->Host       = $mailerHost;
  $mail->SMTPAuth   = true;
  $mail->Username   = $mailerUsername;
  // Password secure application
  $mail->Password   = $mailerPassword;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = $mailerPort;
  $mail->CharSet = 'UTF-8';
  // Destinataire
  $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia Zoo');
  $mail->addAddress($mailerEmail, $name); // I need exist adress, warning my users are not really

  // Contenu du message
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = $contentEmail;

  $mail->send();
  $successMail = 'Vous avez reçu un email avec vos données personnelles.';
} catch (Exception $e) {
  $error = 'Il y a eu une erreur lors de l\'envoi du mail : ' + $mail->ErrorInfo;
}
