<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

require __DIR__ . '/../mariadb/connect.php';
require __DIR__ . '/../mariadb/set_hours.php';
require __DIR__ . '/../mariadb/services.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// form management

if (isset($_POST['name'], $_POST['explication']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $firstName = htmlspecialchars($_POST['name']);
    $content = htmlspecialchars($_POST['explication']);
    $status = 'pending';

    $addAvis = $pdo->prepare('INSERT INTO avis(first_name, content, status) VALUES (:first_name, :content, :status)');
    $addAvis->bindValue(':first_name', $firstName);
    $addAvis->bindValue(':content', $content);
    $addAvis->bindValue(':status', $status);

    if ($addAvis->execute()) {
      $message = 'Votre avis a été envoyé avec succès, merci !';
    } else {
      $message = "Il y a eu un problème lors de l'envoie de votre avis.";
    }
  } else {
    $message = 'Invalid CSRF token';
  }
}

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/avis.css" rel="stylesheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/accueil/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <h1 class="titre-principal">Arcadia</h1>
      <div class="nav-div">
        <img id="logo_nav" src="./img/accueil/logo.png" alt="erreur">
      </div>
      <ul class="navigation">
        <li><a href="contact.php">Contact</a></li>
        <li><a href="habitats.php">Habitats</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <div class="setup">
      <div class="row text-center">
        <h2>Nous souhaitons avoir votre avis</h2>
      </div>

      <form method="POST" id="form">
        <div class="formulaire">
          <div class="mb-3">
            <label for="name" class="form-label fs-4">Prénom :</label>
            <input type="name" name="name" class="form-control" maxlength="255" id="name" required>
            <p id="errorName"></p>
          </div>
          <div class="mb-3">
            <label style="margin-bottom: 8px;" for="explication" form="form-label" class="fs-4">Donnez nous votre avis :</label>
            <textarea id="textarea" name="explication" class="form-control" maxlength="2000" rows="10" required></textarea>
            <p id="errorDesc"></p>
            <div class="form-text fs-5" id="condition">
              Vous ne pouvez pas dépasser les 1000 mots.
            </div>
          </div>
          <input type="hidden" name="csrf_token" class="token" value="<?php echo htmlspecialchars($csrf_token); ?>">
          <button type="submit" name="submit_avis" class="btn btn-success">Envoyer</button>
        </div>
      </form>
      <p class="message"><?php echo isset($message) ? $message : ''; ?></p>
    </div>
  </main>
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
            <li><a class="footer-a" href="https://www.instagram.com/" title="instagram" target="_blank"><img src="./img/accueil/insta.png" width="30vh"></a>
            </li> <br>
            <li><a class="footer-a" href="https://www.facebook.com/" title="facebook" target="_blank"><img src="./img/accueil/facebook.jpg" width="25vh"></a></li> <br>
            <li><a class="footer-a" href="https://www.linkedin.com/" title="linkedin" target="_blank"><img src="./img/accueil/linkedin.png" width="30vh"></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright">
        <p>Copyright © Arcadia 2024</p>
      </div>
    </section>
  </footer>

  <script src="./js/avis.js"></script>
</body>

</html>