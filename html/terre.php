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
  <link href="../style/css/terre.css" rel="styleSheet">
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

  <body>
    <main>
      <div class="main_div">
        <h2>Une terre plus verte</h2>
      </div>
      <div class="main_para">
        <p>Nous sommes fière de pouvoir dire que notre zoo est entièrement indépendant au niveau des énergies.</p>
        <p>Nous avons plusieurs centaines de panneaux photovotlaïques qui sont installés sur presque 2 hectares de
          terrain, ainsi qu'une éolienne. Pour pouvoir réchauffer nos animaux le soir nous avons également des batteries
          de stockage. Nous n'utilisons donc que très peu d'énergie fossile.</p>
        <p>Notre restaurant propose une cuisine 0 déchet. Les aliments non utilisés sont cuisinés pour nourrir nos animaux
          afin d'arriver à cette fierté de ne rien jeter. Nous favorisons les produits locaux afin que vous proposez des
          assiettes saine, riche et savoureuse.</p>
        <div class="row">
          <img class="img_logo col-6 col-sm-3" src="../img/accueil/ecologie.jpg" alt="Terre plus verte">
          <img class="img_logo col-6 col-sm-3" src="../img/accueil/recyclage1.png" alt="Recyclage">
          <img class="img_logo col-6 col-sm-3" src="../img/accueil/recyclage2.png" alt="Protection de la nature">
          <img class="img_logo col-6 col-sm-3" src="../img/accueil/logo.png" alt="Logo principal">
        </div>
      </div>
      <img class="img_eolienne" src="../img/terre/eolienne.jpg" alt="éolienne">
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
    </footer>

    <script src="../js/terre.js"></script>
  </body>

</html>