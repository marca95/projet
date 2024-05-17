<!DOCTYPE html>

<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/hours.php';
require_once '../mariadb/services.php';
require_once '../mariadb/homes.php';
require_once '../mariadb/avis.php';

// recovers the first animal of each house 
$viewAnimals = $pdo->prepare('SELECT * FROM animals GROUP BY id_home');
$viewAnimals->execute();
$animals = $viewAnimals->fetchAll(PDO::FETCH_ASSOC);

$viewServices = $pdo->prepare('SELECT * FROM accueil_services');
$viewServices->execute();
$accueilservices = $viewServices->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/accueil.css" rel="stylesheet">
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
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <div class="citation row">
      <img class="img_recyclage1 col-sm-2" src="./img/accueil/recyclage1.png" alt="recyclage">
      <div class="col-9 col-sm-8">
        <blockquote class="text-center lh-sm">Il ne sert de rien à l'homme de gagner la Lune s'il vient à
          perdre la
          Terre
        </blockquote>
        <cite class="float-end">François Mauriac</cite>
      </div>
      <img class="img_recyclage2 col-3 col-sm-2" src="./img/accueil/recyclage2.png" alt="recyclage">
    </div>
    <div class="row m-0">
      <img class="img_presentation col-sm-6  p-0" src="./img/accueil/conservatoir.jpg" height="600px">
      <img class="img_presentation col-sm-6  p-0" src="./img/accueil/lac.jpg" height="600px">
      <p class="p-4 m-0 border-bottom">Arcadia est un zoo situé en France près de la forêt de Brocéliande, en bretagne
        depuis 1960.
        Le zoo contient tout un panel d'animaux, réparti par habitat (savane, jungle, marais).
        La santé des animaux est un facteur primordial pour le parc.
        Chaque jour, plusieurs vétérinaires viennent éffectuer un contrôle sur chaque animal
        avant
        l'ouverture, afin de s'assurer qu'il soit en bonne santé. De même, toute la nourriture donnée est calculée
        afin d'avoir
        le bon grammage (le bon grammage est précisé dans le rapport du vétérinaire).
      </p>
    </div>
    <div class="container-lg my-5 pb-5 border-bottom">
      <h3 class="text-center fs-2">Découvez nos Animaux</h3>
      <div class="row g-3">
        <?php foreach ($animals as $animal) : ?>
          <div class="col-sm-6 col-lg-3">
            <div class="container-div" style="background-image: url('<?php echo $animal['root']; ?>');">
              <a class="container-a" href="habitats.php#<?php echo $animal['type']; ?>">
                <h3 class="container-titre"><?php echo $animal['commonName']; ?></h3>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="container-lg my-5 pb-5 border-bottom">
      <h3 class="text-center fs-2">Leurs habitations</h3>
      <div class="row g-3">
        <?php foreach ($homes as $home) : ?>
          <div class="col-sm-6 col-lg-3">
            <div class="container-div" style="background-image: url('<?php echo $home['url_img_accueil'] ?>');">
              <a class="container-a" href="habitats.php#<?php echo $home['name']; ?>">
                <h3 class="container-titre"><?php echo $home['commonName']; ?></h3>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="container mt-1 pb-1">
      <h3 class="text-center m-4 fs-2">Nous vous proposons :</h3>
      <?php foreach ($accueilservices as $service) : ?>
        <div class="row text-center mb-4 align-items-center">
          <img class="img_service col-12 col-lg-5 mt-2" src="<?php echo $service['img1'] ?>">
          <div class="col-sm-4 col-lg-3">
            <p class="fs-6"><?php echo $service['content'] ?></p>
            <?php foreach ($services as $setService) : ?>
              <?php if ($setService['id_service'] === $service['id_service']) : ?>
                <a href="./services.php#<?php echo $setService['NAME'] ?>">
                  <button type="button" class="service_btn btn btn-success mt-4 mb-2"><?php echo $service['title_btn'] ?></button>
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
          <img class="img_service col-sm-8 col-lg-4 mt-2" src="<?php echo $service['img2'] ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <hr>
    <div class="container mt-5">
      <div class="avis_para row">
        <div class="container-avis col-12 text-center">
          <h3 class="avis">Vos témoignages nous aide à grandir :</h3>
          <img class="img-responsive center-block" src="./img/accueil/logo.png" width="10%">
        </div>
        <?php foreach ($allAvis as $avis) : ?>
          <div class="avis_séparation1 col-12 col-lg-6">
            <p class="container-avis1 p-2"><b><?php echo $avis['first_name']; ?> :</b>
              <?php echo $avis['content']; ?></p>
          </div>
        <?php endforeach; ?>
        <a class="m-2" href="./avis.php">
          <button type="button" class="btn btn-success float-end" width="30%">Votre avis est important pour nous
            !</button>
        </a>
      </div>
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
            <?php foreach ($services as $setService) : ?>
              <li class="footer-li"><a class="footer-a" href="services.php#<?php echo $setService['NAME'] ?>"><?php echo $setService['main_title'] ?></a></li>
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
  <script src="./js/accueil.js"></script>
</body>

</html>