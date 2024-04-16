<!DOCTYPE html>

<?php

require_once '../mariadb/connect.php';
require_once '../mariadb/hours.php';
require_once '../mariadb/services.php';

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/contact.css" rel="stylesheet">
  <link href="../img/accueil/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <h1 class="titre-principal">Arcadia</h1>
      <div class="nav-div">
        <img id="logo_nav" src="../img/accueil/logo.png" alt="erreur">
      </div>
      <ul class="navigation">
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="habitats.php">Habitats</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="accueil.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <div class="org_main">
      <div class="first_content">
        <div class="title row">
          <a class="recy_img col-3 col-xl-2" href="./terre.php">
            <img class="regl_img" src="../img/accueil/recyclage2.png" title="Nos sources d'énergie verte" alt="Terre plus verte">
          </a>
          <h2 class="col-6 col-xl-8">Contact</h2>
          <a href="./tarif.php" class="cent_btn col-3 col-xl-2"><button class="btn btn-success" type="button">Tarifs</button></a>
        </div>
        <form method="POST" action="./contact.php" id="form">
          <div class="mb-3">
            <label for="title" class="form-label">Titre de votre demande :</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <p id="errorTitle"></p>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail :</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailHelp" class="form-text">Nous vous répondrons sur cette adresse mail.</div>
            <p id="errorEmail"></p>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" rows="8" required></textarea>
            <div class="form-text">Le texte ne peut pas contenir plus de 1000 mots.</div>
            <p id="errorDescr"></p>
          </div>
          <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
          <p><?php echo isset($message) ? $message : '' ?></p>
        </form>
      </div>
    </div>
  </main>

  <?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../divers/PHPMailer-master/src/Exception.php';
  require '../divers/PHPMailer-master/src/PHPMailer.php';
  require '../divers/PHPMailer-master/src/SMTP.php';

  // Create registration form
  if (isset($_POST['submit'])) {

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // send mail for username and password
    $subject = 'Formulaire de contact';
    $contentEmail = "Titre de la demande : $title\n";
    $contentEmail .= "Adresse de l'expéditeur : $email\n";
    $contentEmail .= "Descriptif : $description\n";

    $mail = new PHPMailer(true);

    try {
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
      $mail->setFrom('monzooarcadia@gmail.com', 'Arcadia formulaire de contact');
      $mail->addAddress('pierre.majerus@outlook.be'); // I need exist adress, warning my users are not really

      // Contenu du message
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $contentEmail;

      $mail->send();
      $message = "Email bien envoyé, nous vous répondrons dans les plus bref délais";
    } catch (Exception $e) {
      $message = "Problème lors de l'envoi du mail : </p>" + $mail->ErrorInfo;
    }
  }


  ?>
  <footer>
    <section class="section-footer">
      <div class="contenu-footer">
        <div class="footer-div">
          <ul class="footer-ul">
            <li class="footer-titre">Nous contacter</li>
            <li>Arcadia</li>
            <li>Domaine de La Sure</li>
            <li>6666 Brocéliande</li>
            <li>France</li>
            <li>+33 77 777 777</li>
            <li>monzooarcadia@gmail.com</li>
          </ul>
        </div>
        <div class="footer-div">
          <ul class="footer-ul">
            <li class="footer-titre">Nos services</li>
            <li class="footer-li"><a class="footer-a" href="./tarif.php">Nos tarifs</a></li>
            <?php foreach ($services as $service) : ?>
              <li class="footer-li"><a class="footer-a" href="services.php#<?php echo $service['NAME'] ?>"><?php echo $service['main_title'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="footer-div">
          <ul class="footer-ul">
            <li class="footer-titre">Horaires</li>
            <?php
            foreach ($sethoraires as $sethoraire) {
              $setDay = $sethoraire['day_week'];
              $setIsClosed = $sethoraire['is_closed'];
              $setStartTime = $sethoraire['start_time'];
              $setEndTime = $sethoraire['end_time'];

              echo "<li>$setDay : ";
              echo $setIsClosed ? 'Fermé' : "$setStartTime à $setEndTime";
              echo '</li>';
            }

            ?>
          </ul>
        </div>
        <div class="footer-div">
          <ul class="footer-ul">
            <li class="footer-titre">Suivez-nous</li>
            <li><a class="footer-a" href="https://www.instagram.com/" title="instagram" target="_blank"><img src="../img/accueil/insta.png" width="30vh"></a>
            </li> <br>
            <li><a class="footer-a" href="https://www.facebook.com/" title="facebook" target="_blank"><img src="../img/accueil/facebook.jpg" width="25vh"></a></li> <br>
            <li><a class="footer-a" href="https://www.linkedin.com/" title="linkedin" target="_blank"><img src="../img/accueil/linkedin.png" width="30vh"></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright">
        <p>Copyright © Arcadia 2024</p>
      </div>
    </section>
  </footer>
  <script src="../js/contact.js"></script>
</body>

</html>