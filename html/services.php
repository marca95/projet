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

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/services.css" rel="styleSheet">
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
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="habitats.php">Habitats</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="accueil.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <?php

  function getServices($pdo)
  {
    // Seulement si je veux recuperer ceux de 3 tableaux (Inner join)
    // SELECT services.main_title, services.second_title, services.img_root AS main_img, services.content, 
    // services.third_title, services.second_content, services.NAME AS name, services.link_services AS id_link, services.btn_services AS id_btn,
    // btn_services.classes AS btn_classes, btn_services.link_url AS btn_link_url, btn_services.title_btn, link_services.classes AS link_classes, 
    // link_services.link_url, link_services.img_root AS link_img_root FROM services 
    // INNER JOIN link_services ON link_services.id_link = services.link_services,
    // INNER JOIN btn_services ON btn_services.id_btn = services.btn_services
    $itemsServices = 'SELECT 
    services.main_title, 
    services.second_title, 
    services.img_root AS main_img, 
    services.content, 
    services.third_title, 
    services.second_content, 
    services.NAME AS name, 
    services.link_services AS id_link, 
    services.btn_services AS id_btn,
    btn_services.classes AS btn_classes, 
    btn_services.link_url AS btn_link_url, 
    btn_services.title_btn, 
    link_services.classes AS link_classes, 
    link_services.link_url, 
    link_services.img_root AS link_img_root 
FROM 
    services 
LEFT JOIN 
    link_services ON link_services.id_link = services.link_services
LEFT JOIN 
    btn_services ON btn_services.id_btn = services.btn_services;';
    $stmt = $pdo->prepare($itemsServices);
    $stmt->execute();
    $serviceData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $serviceData;
  }

  $services = getServices($pdo);
  ?>

  <main class="container-fluid">
    <div class="row">
      <div class="principal col-3 col-sm-2 col-md-3 col-lg-2">
        <a class="principal1 main_a" href="./avis.php">
          <button class="btn1 btn btn-success">Donnez votre avis sur l'activité</button>
          <button class="btn2 btn btn-success">Votre avis</button>
        </a>
      </div>
      <h2 class="col-6 col-sm-8 col-md-6 col-lg-8">Service proposé</h2>
      <div class="principal col-3 col-sm-2 col-md-3 col-lg-2">
        <a class="principal1 main_a" href="./tarif.php"><button class="btn3 btn btn-success">Tarif</button></a>
      </div>
    </div>
    <div class="main_div row">
      <?php foreach ($services as $service) : ?>
        <section class="main_section col-12 col-sm-6 col-md-4" id="<?php echo $service['name']; ?>">
          <h3 class="main_h3"><?php echo $service['main_title']; ?></h3>
          <img src="<?php echo $service['main_img']; ?>" alt="<?php echo $service['name']; ?>" width="100%">
          <h5 class="main_h5"><?php echo $service['second_title']; ?></h5>
          <p class="pt-3"><?php echo $service['content']; ?></p>
          <h5 class="main_h5"><?php echo $service['third_title']; ?></h5>
          <p class="pt-3"><?php echo $service['second_content']; ?></p>
          <div class="row">
            <?php if ($service['link_url'] !== null) : ?>
              <div class="<?php echo $service['link_classes']; ?>">
                <a class="main_a" href="<?php echo $service['link_url']; ?>">
                  <img src="<?php echo $service['link_img_root']; ?>" width="200px" style="border-radius: 20px;">
                </a>
              </div>
            <?php endif; ?>
            <?php if ($service['btn_link_url'] !== null) : ?>
              <div class="<?php echo $service['btn_classes']; ?>">
                <a class="main_a " href="<?php echo $service['btn_link_url']; ?>" target="_blank">
                  <button class="btn btn-success"><?php echo $service['title_btn']; ?></button>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </section>
      <?php endforeach; ?>


      <!-- <section class="main_section col-12 col-sm-6 col-md-4" id="train">
        <img src="../img/services/train.jpg" alt="train" width="100%">
        <h5 class="main_h5">Tarifs pour 45min</h5>
        <p>
          -> Adulte: 8€
          <br />
          -> Enfant de 4 à 12ans: 5€
          <br />
          -> Enfant de - 4ans: Gratuit
          <br />
          -> Place réservé pour personne à mobilité reduite
        </p>
        <h5 class="main_h5">Durée</h5>
        <p>
          Le train roulera de 11h à 17h
          La promenade dure +/- 45min.
          Le départ se fera à coté de l'accueil principal.
          Elle démarrera a toutes les heures pleines de 11h à 18h du mercredi au dimanche.
          En fonction des conditions climatique, il est possible que le petit train reste au chaud. L'accueil vous
          préviendra lors de votre arrivé.
        </p>
      </section>
      <section class="main_section col-12 col-sm-6 col-md-4" id="habitat">
        <h3 class="main_h3">Visite des habitats</h3>
        <img src="../img/services/guide.jpg" alt="habitat" width="100%">
        <p class="pt-3">Rendez-vous avec notre guide Arcadia tous les jours de la semaine de 10h30 à 12h et de 14h à
          16h.
          Vous aurez la chance d'accéder à notre volière où vivent des centaines de différentes sortent
          d'oiseaux.
          Vous découvrirez sous un autre angle les animaux australiens comme le kangourous, ainsi que
          quelques animaux africains comme les samïris, la
          girafe ou les gorilles. <b>Activité gratuite !</b>
        </p>
        <p>
          Il est <b>strictement interdit </b> de donner de la nourriture aux animaux pendant la visite. La nourriture
          est soigneusement préparée et pesée par nos soigneurs. Une quantité trop élévé de nourriture non autorisé
          peut blesser l'animal, même pire dans certain cas. Merci d'écouter attentivement les consignes de sécurité
          du guide durant la visite.
        </p>

      </section>
      <section class="main_section col-12 col-md-4" id="resto">
        <h3 class="main_h3">Restaurant</h3>
        <img src="../img/services/restaurant.jpg" alt="resto" width="100%">
        <p class="pt-3">
          Notre magnifique restaurant avec 200 places intérieur et 50 places extérieur avec vue sur notre lac, vous
          accompagne de 11h à 15h tous les jours de la semaine.
        </p>
        <p>
          Nous vous proposons une cuisine 0 déchet et où nous favorisons les produits locaux. Des assiettes saine,
          riche et savoureuse préparé par nos chefs
          Le restaurant ressemble à notre physionomie: Mettre tout en notre pouvoir pour contribuer à un planète plus
          verte pour le biens de nos animaux.
        </p>
        <div class="row">
          <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
            <a class="main_a" href="./terre.php">
              <img src="../img/accueil/ecologie.jpg" width="200px" style="border-radius: 20px;">
            </a>
          </div>
          <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
            <a class="main_a " href="../img/services/carte_restaurant.pdf" target="_blank">
              <button class="btn btn-success">Découvrez la carte du restaurant</button>
            </a>
          </div>

        </div>
      </section> 
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
            <li class="footer-li"><a class="footer-a" href="services.php#resto">Restaurant</a></li>
            <li class="footer-li"><a class="footer-a" href="services.php#habitat">Visite des habitats</a></li>
            <li class="footer-li"><a class="footer-a" href="services.php#train">Visite du Zoo en petit train</a></li>
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

      <!--  -->
      </section>
      </footer>

      <script src="../js/services.js"></script>
</body>

</html>