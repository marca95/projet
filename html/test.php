<!DOCTYPE html>

<?php
// session_start();
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

    // Fetch data articles
    function getArticlesData($pdo)
    {
      $itemsArticles = 'SELECT articles.id_article, articles.main_title, articles.second_title, articles.third_title, articles.content, homes.name AS lieu,
       homes.main_root, homes.second_root, articles.id_home
      FROM articles 
      INNER JOIN homes ON homes.id_home = articles.id_home';
      $stmt = $pdo->prepare($itemsArticles);
      $stmt->execute();
      $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $articlesData;
    }

    // Fetch data animals
    function getAnimalsData($pdo)
    {
      $itemsAnimals = 'SELECT animals.name AS prenom, animals.type, animals.race, locations.NAME AS pays, states.state, states.detail,
       foods.food, foods.grams, foods.date_pass AS passage, animals.root, animals.commonName AS categorie, animals.id_home
      FROM animals
      INNER JOIN homes ON homes.id_home = animals.id_home
      INNER JOIN locations ON locations.id_location = animals.id_location
      INNER JOIN foods ON foods.id_animal = animals.id_animal
      INNER JOIN states ON states.id_animal = animals.id_animal';
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
        <?php if (isset($user['id_role']) && $user['id_role'] == '1') : ?>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-success mb-4" id='createArticle'>Créer un article</button>
          </div>
        <?php endif; ?>
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
                <?php if (isset($user['id_role']) && $user['id_role'] == '1') : ?>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary mt-2" id='updateArticle'>Modifier l'article</button>
                    <button class="btn btn-danger mt-2" id='deleteArticle'>Supprimer l'article</button>
                  </div>
                <?php endif; ?>
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
                  <?php if ($animal['id_home'] == $article['id_home']) : ?>
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
                      <?php if (isset($user['id_role']) && $user['id_role'] == '1') : ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button class="btn btn-success mt-2" id='createAnimal'>Créer un animal</button>
                          <button class="btn btn-primary mt-2" id='updateAnimal'>Modifier l'animal</button>
                          <button class="btn btn-danger mt-2" id='deleteAnimal'>Supprimer l'animal</button>
                        </div>
                      <?php endif; ?>
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
  <script src="../js/habitats.js">
    // Get bouton CRUD articles/animals

    const createArticle = document.getElementById('createArticle');
    const updateArticle = document.getElementById('updateArticle');
    const deleteArticle = document.getElementById('deleteArticle');
    const createAnimal = document.getElementById('createAnimal');
    const updateAnimal = document.getElementById('updateAnimal');
    const deleteAnimal = document.getElementById('deleteAnimal');

    createArticle.addEventListener('click', () => {

    })

    updateArticle.addEventListener('click', () => {
      console.log('updateArticle ok');
    })

    deleteArticle.addEventListener('click', () => {
      console.log('deleteArticle ok');
    })

    createAnimal.addEventListener('click', () => {
      console.log('createAnimal ok');
    })

    updateAnimal.addEventListener('click', () => {
      console.log('updateAnimal ok');
    })

    deleteAnimal.addEventListener('click', () => {
      console.log('deleteAnimal ok');
    })
  </script>
</body>

</html>