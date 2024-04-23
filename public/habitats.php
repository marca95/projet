<!DOCTYPE html>

<?php

require_once '../mariadb/connect.php';
require_once '../mariadb/hours.php';
require_once '../mariadb/services.php';
require_once '../mariadb/homes.php';

// MongoDB library
require '../vendor/autoload.php';

use MongoDB\Client;
use MongoDB\BSON\ObjectID;

// Check if you connected on local
if ($_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1') {
  // Connexion locale
  $client = new MongoDB\Client("mongodb://localhost:27017");
} else {
  // Remote connexion
  $uri = "mongodb+srv://marca95:esbourcy69@cluster0.1ybtwgx.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";
  $client = new MongoDB\Client($uri);
}

if (isset($_GET['type'])) {
  $animal_type = $_GET['type'];

  $collection = $client->selectDatabase("zoo")->selectCollection("animals");

  // Mettre à jour le nombre de vues de l'animal correspondant
  $updateResult = $collection->updateOne(
    ['type' => $animal_type],
    ['$inc' => ['nbr_view' => 1]]
  );

  if ($updateResult->getModifiedCount() === 1) {
    echo "Le nombre de vues de l'animal a été incrémenté avec succès.";
  } else {
    echo "Une erreur s'est produite lors de l'incrémentation du nombre de vues de l'animal.";
  }
}

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/habitats.css" rel="styleSheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <h1 class="titre-principal">Arcadia</h1>
      <div class="nav-div">
        <img id="logo_nav" src="./img/accueil/logo.png" alt="erreur">
      </div>
      <ul class="navigation">
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <?php

    // Fetch data animals
    function getAnimalsData($pdo)
    {
      $itemsAnimals = 'SELECT 
      animals.name AS prenom, 
      animals.type, 
      animals.race, 
      animals.id_animal, 
      locations.NAME AS pays, 
      states.state, 
      states.detail,
      foods.food, 
      foods.grams, 
      foods.date_pass AS passage, 
      animals.root, 
      animals.commonName AS categorie, 
      animals.id_home
  FROM 
      animals
  LEFT JOIN 
      homes ON homes.id_home = animals.id_home
  LEFT JOIN 
      locations ON locations.id_location = animals.id_location
  LEFT JOIN 
      foods ON foods.id_animal = animals.id_animal
  LEFT JOIN 
      states ON states.id_animal = animals.id_animal;';
      $stmt = $pdo->prepare($itemsAnimals);
      $stmt->execute();
      $animalsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $animalsData;
    }

    $animals = getAnimalsData($pdo);
    ?>

    <h2>Bienvenue à la maison</h2>
    <div class="main_div container-fluid">
      <div class="row">
        <?php foreach ($homes as $home) : ?>
          <div class="col-12 col-lg-6 container mb-4">
            <button onclick="toggleDiv('<?php echo $home['name'] ?>')" class="btn_habitat" style="background-image: url('<?php echo $home['main_root'] ?>');"><?php echo $home['commonName'] ?></button>
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
                        Prénom: <?php echo $animal['prenom']; ?>
                        <?php
                        foreach ($animals_group as $other_animal) {
                          if ($other_animal['prenom'] != $animal['prenom']) {
                            echo ' + ' . $other_animal['prenom'];
                          }
                        }
                        ?>
                        <br>
                        Race: <?php echo $animal['race']; ?><br>
                        Lieu: <?php echo $animal['pays']; ?><br>
                      </div>
                      <div class="img_animals" style="background-image: url(<?php echo $animal['root']; ?>);">
                      </div>
                      <div class="avis_veterinaire">
                        <p>Etat de l'animal: <?php echo $animal['state']; ?></p>
                        <p>Sa nourriture: <?php echo $animal['food']; ?></p>
                        <p>Le grammage de sa nourriture: <?php echo $animal['grams']; ?> gr</p>
                        <p>Date de passage: <?php echo $animal['passage']; ?></p>
                        <p>Détail de l'état de l'animal: <?php echo $animal['detail']; ?></p>
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