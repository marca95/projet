<!DOCTYPE html>

<?php
session_start();
$userDB = 'root';
$passwordDB = 'pierre2';

try {
  $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', $userDB, $passwordDB);
  // Gestion des erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
};
// Update hours
$horaires = $pdo->prepare('SELECT * FROM horaires');
$horaires->execute();
$sethoraires = $horaires->fetchAll(PDO::FETCH_ASSOC);


// if ($_SESSION['id_role'] == 1) {
//   echo '<button onclick="createArticle()">Créer un article</button>';
//   echo '<button onclick="editArticle()">Modifier un article</button>';
//   echo '<button onclick="deleteArticle()">Supprimer un article</button>';
// }

// function createArticle()
// {
// }

// function editArticle()
// {
// }

// function deleteArticle()
// {
// }


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/habitats.css" rel="styleSheet">
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
        <li><a href="services.php">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="accueil.php">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <?php

    // Fetch data artiicles
    function getArticlesData($pdo)
    {
      $itemsArticles = 'SELECT articles.main_title, articles.second_title, articles.third_title, articles.content, homes.name AS lieu,
       img_homes.main_root, img_homes.second_root, articles.id_home
      FROM articles 
      INNER JOIN homes ON homes.id_home = articles.id_home
      INNER JOIN img_homes ON img_homes.id_home = articles.id_home';
      $stmt = $pdo->prepare($itemsArticles);
      $stmt->execute();
      $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $articlesData;
    }

    // Fetch data animals
    function getAnimalsData($pdo)
    {
      $itemsAnimals = 'SELECT animals.name AS prenom, animals.type, animals.race, locations.NAME AS pays, states.state, states.detail,
       foods.food, foods.grams, foods.date_pass AS passage, img_animals.root, img_animals.name AS categorie, animals.id_home
      FROM animals
      INNER JOIN homes ON homes.id_home = animals.id_home
      INNER JOIN locations ON locations.id_location = animals.id_location
      INNER JOIN foods ON foods.id_animal = animals.id_animal
      INNER JOIN states ON states.id_animal = animals.id_animal
      INNER JOIN img_animals ON img_animals.id_animal = animals.id_animal';
      $stmt = $pdo->prepare($itemsAnimals);
      $stmt->execute();
      $animalsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $animalsData;
    }

    $articles = getArticlesData($pdo);
    $animals = getAnimalsData($pdo);
    ?>

    <h2>Bienvenue à la maison</h2>

    <div class="main_div container-fluid">
      <div class="row">
        <?php foreach ($articles as $article) : ?>
          <div class="col-12 col-lg-6 container mb-4">
            <button onclick="toggleDiv('<?php echo $article['lieu'] ?>')" class="btn_habitat" style="background-image: url('<?php echo $article['main_root'] ?>');"><?php echo $article['main_title'] ?></button>
            <div class="hidden container-fluid p-2" id="<?php echo $article['lieu'] ?>">
              <h5 class="p-1"><?php echo $article['second_title'] ?></h5>
              <p class="descr_p"><?php echo $article['content'] ?></p>
              <div class="row d-flex mb-3">
                <h6><?php echo $article['third_title'] ?></h6>
                <ul class="list_animals col-4 ms-3">
                  <?php
                  $animal_types = array();
                  foreach ($animals as $animal) :
                    if ($animal['id_home'] == $article['id_home'] && !in_array($animal['type'], $animal_types)) :
                  ?>
                      <li class="li_animals" onclick="toggleImg('<?php echo $animal['type']; ?>')"><?php echo $animal['categorie']; ?></li>
                  <?php
                      $animal_types[] = $animal['type'];
                    endif;
                  endforeach;
                  ?>
                </ul>
                <img class="col-7" src='<?php echo $article['second_root'] ?>' width="20%">
              </div>
              <?php foreach ($animals as $animal) : ?>
                <?php if ($animal['id_home'] == $article['id_home']) : ?>
                  <div class="hidAnimal" id="<?php echo $animal['type']; ?>">
                    <div class="descr_animal">
                      Prénom: <?php echo $animal['prenom']; ?><br>
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
    </section>
  </footer>
  <script src="../js/habitats.js"></script>
</body>

</html>