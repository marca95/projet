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
      <section class="main_section col-12 col-sm-6 col-md-4" id="train">
        <h3 class="main_h3">Petit tour en train</h3>
        <div class="img_train row">
          <img class="pic_train col-12 col-lg-6" src="../img/services/train.jpg" title="train" width="50%">
          <div class="structure_div col-12 col-lg-6">
            <h5 class="main_h5">Tarifs pour 45min</h5>
            <p><svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg>
              Adulte: 8€
            </p>
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg>
              Enfant de 4 à 12ans: 5€
            </p>
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg>
              Enfant de - 4ans: Gratuit
            </p>
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" width="15px" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg>
              Place réservé pour personne à mobilité reduite
            </p>
          </div>
        </div>
        <br>
        <div class="structure_div2 row">
          <div class="col-6">
            <h6 class="main_h6">
              <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
              </svg>
              Départ-Arrivée
            </h6>
            <p>Le départ se fera à coté de l'accueil principal.</p>
            <p>Vous verrez les animaux dans leurs habitats ainsi que notre magnifique lac où nous logeons des espèces de
              poissons venu tout droit d'Asie.
            </p>
            <p>N'hésitez surtout pas à faire part de vos impressions et vous envie auprès de notre chauffeur René qui
              sera avec vous tout au long de se voyage!</p>
          </div>
          <div class="col-6">
            <h6 class="main_h6">
              <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
              </svg>
              Durée
            </h6>
            <p>Le train roulera de 11h à 17h</p>
            <p>La promenade dure +/- 45min.</p>
            <p>Elle démarrera a toutes les heures pleines de 11h à 18h du mercredi au dimanche. </p>
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
              </svg>
              En fonction des conditions climatique, il est possible que le petit train reste au chaud. L'accueil vous
              préviendra lors de votre arrivé.
            </p>
          </div>
        </div>
      </section>
      <section class="main_section col-12 col-sm-6 col-md-4" id="habitat">
        <h3 class="main_h3">Visite des habitats (gratuit)</h3>
        <div>
          <img src="../img/services/guide.jpg" alt="guide" width="100%">
          <p class="pt-3">Rendez-vous avec notre guide Arcadia tous les jours de la semaine de 10h30 à 12h et de 14h à
            16h.</p>
          <p>Vous aurez la chance d'accéder à notre volière où vivent des centaines de différentes sortent
            d'oiseaux.</p>
          <p>Vous découvrirez sous un autre angle les animaux australiens comme le kangourous, ainsi que
            quelques animaux africains comme le samïri, la
            girafe ou les gorilles.
          </p>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
            </svg>
            Il est <b>strictement interdit </b> de donner de la nourriture aux animaux pendant la visite. La nourriture
            est soigneusement préparée et pesée par nos soigneurs. Une quantité trop élévé de nourriture non autorisé
            peut blesser l'animal, même pire dans certain cas. Merci d'écouter attentivement les consignes de sécurité
            du guide durant la visite.
          </p>

        </div>
      </section>
      <section class="main_section col-12 col-md-4" id="resto">
        <h3 class="main_h3">Restaurant</h3>
        <div>
          <img src="../img/services/restaurant.jpg" alt="restaurant" width="100%">
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
        </div>
        <div class="row">
          <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center p-4">
            <a class="main_a" href="./terre.php">
              <img id="terre_verte" src="../img/accueil/ecologie.jpg" alt="eco" width="200px">
            </a>
          </div>
          <div class="col-6 col-md-12 col-xl-6 d-flex align-items-center justify-content-center">
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

  <!-- ATTENTION la partie de JS Bootstrap n'est pas mise
   (https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js)-->


  <script src="../js/services.js"></script>
</body>

</html>