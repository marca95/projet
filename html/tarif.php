<!DOCTYPE html>

<?php
$userDB = 'root';
$passwordDB = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', $userDB, $passwordDB);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};

$horaires = $pdo->prepare('SELECT * FROM horaires');
$horaires->execute();
$sethoraires = $horaires->fetchAll(PDO::FETCH_ASSOC);

$viewServices = $pdo->prepare('SELECT * FROM services');
$viewServices->execute();
$services = $viewServices->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/tarif.css" rel="styleSheet">
  <link href="../img/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <h1 class="titre-principal">Arcadia</h1>
      <div class="nav-div">
        <img id="logo_nav" src="../img/accueil/logo.png" alt="erreur">
      </div>
      <ul class="navigation">
        <li><a href="contact.php">Contact</a></li>
        <li><a href="habitats.php">Habitats</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="accueil.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <div class="main_div">
      <div class="sec_div row">
        <div class="centr_logo1 col-3 col-md-4 col-lg-2 col-xl-1">
          <img class="img_title" src="../img/accueil/recyclage1.png" alt="Ecologie">
        </div>
        <h2 class="col-6 col-md-4 col-lg-8 col-xl-10">Tarifs tickets individuels</h2>
        <div class="centr_logo2 col-3 col-md-4 col-lg-2 col-xl-1">
          <img class="img_title" src="../img/accueil/recyclage2.png" alt="Ecologie">
        </div>
      </div>
    </div>
    <div class="org_div">
      <h3>Tickets d'entrée Arcadia</h3>
      <p>Le guichet pour le ticket est ouvert de 9h45 à 17h30. Si vous souhaitez avoir des informations complémentaires
        sur les activités, n'hésitez pas à vous adressez au guichet.</p>
      <br>
      <hr>
      <div class="cat_div">
        <h6>Jeunes enfants</h6>
        <p class="cat_age">-3 ans</p>
        <p class="cat-price">Gratuit</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Enfants</h6>
        <p class="cat_age">3 à 12 ans</p>
        <p class="cat-price">20€</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Ado</h6>
        <p class="cat_age">12 à 18 ans</p>
        <p class="cat-price">28€</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Etudiants</h6>
        <p class="cat_age">18 à 25 ans</p>
        <p class="cat-price">30€</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Adultes</h6>
        <p class="cat_age">25 à 60 ans</p>
        <p class="cat-price">35€</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Seniors</h6>
        <p class="cat_age">+60 ans</p>
        <p class="cat-price">28€</p>
      </div>
      <hr>
      <div class="cat_div">
        <h6>Personnes à mobilité réduites</h6>
        <p class="cat_age">Toutes ages</p>
        <p class="cat-price">25€</p>
      </div>
      <hr>
    </div>
    <br>
    <div class="info_general">
      <p>Si vous souhaitez nous partager votre avis <a href="./avis.html"><button class="btn btn-success">cliquez-ici</button></a>
      </p>
      <br>
      <p>Venez découvrir notre espace vert <a href="./terre.html"><button class="btn btn-success">cliquez-ici</button></a></p>
    </div>
    <br>
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

  <!-- ATTENTION la partie de JS Bootstrap n'est pas mise
   (https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js)-->


  <script src="../js/tarif.js"></script>
</body>

</html>