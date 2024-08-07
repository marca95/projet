<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/set_hours.php';
require_once '../mariadb/services.php';

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/services.css" rel="stylesheet">
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
        <li><a href="connexion.php"><?php echo isset($_SESSION['id_user']) ? 'Mon espace' : 'Connexion' ?></a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="habitats.php">Habitats</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main class="container-fluid">
    <div class="row">
      <div class="principal col-3 col-sm-2 col-md-3 col-lg-2">
        <a class="principal1 main_a" href="./avis.php">
          <button class="btn1 btn btn-success">Donnez votre avis sur l'activité</button>
          <button class="btn2 btn btn-success">Votre avis</button>
        </a>
      </div>
      <h2 class="col-6 col-sm-8 col-md-6 col-lg-8">Services proposés</h2>
      <div class="principal col-3 col-sm-2 col-md-3 col-lg-2">
        <a class="principal1 main_a" href="./tarif.php"><button class="btn3 btn btn-success">Tarifs</button></a>
      </div>
    </div>
    <div class="main_div row">
      <?php foreach ($services as $service) : ?>
        <section class="main_section col-12 col-sm-6 col-md-4" id="<?php echo $service['NAME']; ?>">
          <h3 class="main_h3"><?php echo $service['main_title']; ?></h3>
          <img src="<?php echo $service['img_root']; ?>" alt="<?php echo $service['NAME']; ?>" width="100%">
          <h5 class="main_h5"><?php echo $service['second_title']; ?></h5>
          <p class="pt-3"><?php echo $service['content']; ?></p>
          <h5 class="main_h5"><?php echo $service['third_title']; ?></h5>
          <p class="pt-3"><?php echo $service['second_content']; ?></p>
          <div class="row">
            <?php if ($service['link_url'] !== null) : ?>
              <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
                <a class="main_a" href="<?php echo $service['link_url']; ?>">
                  <img src="<?php echo $service['img_root_link']; ?>" class="img_btn">
                </a>
              </div>
            <?php endif; ?>
            <?php if ($service['btn_url'] !== null) : ?>
              <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
                <a class="main_a " href="<?php echo $service['btn_url']; ?>" target="_blank">
                  <button class="btn btn-success"><?php echo $service['btn_title']; ?></button>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </section>
      <?php endforeach; ?>
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

  <script src="./js/services.js"></script>
</body>

</html>