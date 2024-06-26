<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/set_hours.php';
require_once '../mariadb/services.php';
require_once '../mariadb/homes.php';
require_once '../mariadb/dataAnimals.php';
require_once '../mongodb/mongoDBConnection.php';
require_once '../mongodb/animalManager.php';
require_once '../vendor/autoload.php';

$dbConnection = new MongoDBConnection();
$collection = $dbConnection->getCollection();
$animalManager = new AnimalManager($collection);

$type = isset($_GET['type']) ? $_GET['type'] : null;
if (!empty($type)) {
  $animalManager->incrementAnimalView($type);
}

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/habitats.css" rel="styleSheet">
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
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <h2>Bienvenue à la maison</h2>
    <div class="main_div container-fluid">
      <div class="row">
        <?php foreach ($homes as $home) : ?>
          <div class="col-12 col-lg-6 container mb-4">
            <button onclick="toggleDiv('<?php echo $home['name'] ?>')" class="btn_habitat" style="background-image: url('<?php echo $home['main_root'] ?>');">
              <h3><?php echo $home['commonName'] ?></h3>
            </button>
            <div class="hidden container-fluid p-2" id="<?php echo $home['name'] ?>">
              <h5 class="p-1"><?php echo $home['second_title'] ?> :</h5>
              <p class="descr_p"><?php echo $home['description'] ?></p>
              <div class="row d-flex mb-3">
                <h6>Vous pouvez rencontrer :</h6>
                <ul class="list_animals col-4 ms-3">
                  <?php
                  $animal_types = array();
                  foreach ($animals as $animal) :
                    if ($animal['id_home'] == $home['id_home'] && !in_array($animal['type'], $animal_types)) :
                  ?>
                      <li class="li_animals" onclick="toggleImg('<?php echo $animal['type']; ?>'); showType('<?php echo $animal['type']; ?>')"><?php echo $animal['categorie']; ?></li>
                  <?php
                      $animal_types[] = $animal['type'];
                    endif;
                  endforeach;
                  ?>
                </ul>
                <img class="col-7" src='<?php echo $home['second_root'] ?>' width="20%">
              </div>
              <?php
              $animals_by_race = array();
              foreach ($animals as $animal) {
                $race = $animal['race'];
                if (!isset($animals_by_race[$race])) {
                  $animals_by_race[$race] = array();
                }
                $animals_by_race[$race][] = $animal;
              }
              ?>
              <?php foreach ($animals_by_race as $race => $animals_group) : ?>
                <?php foreach ($animals_group as $animal) : ?>
                  <?php if ($animal['id_home'] == $home['id_home']) : ?>
                    <div class="hidAnimal" id="<?php echo $animal['type']; ?>">
                      <div class="descr_animal">
                        <b>Prénom:</b> <?php echo $animal['prenom']; ?>
                        <?php
                        foreach ($animals_group as $other_animal) {
                          if ($other_animal['prenom'] != $animal['prenom']) {
                            echo ' + ' . $other_animal['prenom'];
                          }
                        }
                        ?>
                        <br>
                        <b>Race:</b> <?php echo $animal['race']; ?><br>
                        <b>Lieu:</b> <?php echo $animal['pays']; ?><br>
                      </div>
                      <div class="img_animals" style="background-image: url(<?php echo $animal['root']; ?>);">
                      </div>
                      <div class="avis_veterinaire">
                        <p><b>Etat de l'animal:</b> <?php echo $animal['state']; ?></p>
                        <p><b>Sa nourriture:</b> <?php echo $animal['food']; ?></p>
                        <p><b>Le grammage de sa nourriture:</b> <?php echo $animal['grams']; ?> gr</p>
                        <p><b>Date de passage:</b> <?php echo $animal['passage']; ?></p>
                        <p><b>Détail de l'état de l'animal:</b> <?php echo $animal['detail']; ?></p>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- RECUP JS -->
    <?php
    $habitatsJS = array();
    foreach ($homes as $home) {
      $habitatsJs[] = $home['name'];
    }
    $animalsJS = array();
    foreach ($animals as $animal) {
      $animalsJS[] = $animal['type'];
    }
    ?>

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
  <script src="./js/habitats.js"></script>

</body>

</html>