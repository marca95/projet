<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/set_hours.php';
require_once '../mariadb/services.php';
require_once '../mariadb/checkConnect.php';

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/connexion.css" rel="stylesheet">
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
    <div class="row">
      <img class="col-lg-4 col-xl-3 img" src="./img/connexion/gorille.jpg" alt="gorille">
      <div class="col-lg-6 content">
        <h2>Connexion</h2>
        <p class="warning">Attention, cette page est réservée uniquement aux membres du personnel d'Arcadia, il est
          donc impossible
          pour un visiteur de créer un compte.</p>
        <div class="formulaire">
          <form id="form" method="POST" action="">
            <div class="mb-3">
              <label for="username" class="form-label">Adresse e-mail : </label>
              <input type="email" class="form-control" id="username" name="username" maxlength="50">
              <p id="errorEmail"></p>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe : </label>
              <input type="password" class="form-control" id="password" name="password" maxlength="100">
              <p id="errorPassword"></p>
            </div>
            <?php if (isset($_POST['connect']) && !empty($errorCon)) :  ?>
              <p class="errorConnection"><?php echo $errorCon; ?></p>
            <?php endif; ?>
            <button type="submit" id="submit" name="connect" class="btn btn-success">Connexion</button>
          </form>
        </div>
      </div>
      <img class="col-lg-4 col-xl-3 img" src="./img/connexion/lama.jpg" alt="lama">
      <img class="img_hidden" src="./img/connexion/crocodile.jpg" alt="crocodile">
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
  <script src="./js/connexion.js"></script>
</body>

</html>