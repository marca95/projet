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

// Update and Select homes
// URL img homes
$imgHomes = $pdo->prepare('SELECT * FROM img_homes');
$imgHomes->execute();
$rootHomes = $imgHomes->fetchAll(PDO::FETCH_ASSOC);

$root = array();

foreach ($rootHomes as $key => $rootHome) {
  $root[$key + 1] = $rootHome['root'];
}

// URL img animals
$imgAnimals = $pdo->prepare('SELECT * FROM img_animals');
$imgAnimals->execute();
$rootPets = $imgAnimals->fetchAll(PDO::FETCH_ASSOC);

$rootAnimals = array();
$animalStyle = array();

foreach ($rootPets as $key => $rootPet) {
  $rootAnimals[$key + 1] = $rootPet['root'];
}

foreach ($rootPets as $key => $rootPet) {
  $animalStyle[$key + 1] = $rootPet['name'];
}

// Update articles 
$updateArticles = $pdo->prepare('SELECT * FROM articles');
$updateArticles->execute();
$articles = $updateArticles->fetchAll(PDO::FETCH_ASSOC);

$mainTitle = array();
$secondTitle = array();
$content = array();

foreach ($articles as $key => $article) {
  $mainTitle[$key + 1] = $article['main_title'];
}

foreach ($articles as $key => $article) {
  $secondTitle[$key + 1] = $article['second_title'];
}

foreach ($articles as $key => $article) {
  $content[$key + 1] = $article['content'];
}

// Update animals
// USE INNER JOIN FOR CONNECT ANIMAL LOCATION /!\/!\/!\/!\/!\/!\/!\/!\/!\/!\
$updateAnimals = $pdo->prepare('SELECT * FROM animals');
$updateAnimals->execute();
$animals = $updateAnimals->fetchAll(PDO::FETCH_ASSOC);

foreach ($animals as $key => $animal) {
  $firstName[$key + 1] = $animal['name'];
}

foreach ($animals as $key => $animal) {
  $race[$key + 1] = $animal['race'];
}

foreach ($animals as $key => $animal) {
  $location[$key + 1] = $animal['id_location'];
}


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
    <!-- --------------------------------------FIRST PART--------------------------------------  -->

    <h2>Bienvenue à la maison</h2>

    <div class="main_div container-fluid">
      <div class="row">
        <div class="col-12 col-lg-6 container mb-4">
          <button onclick="toggleDiv('getClickForest')" class="btn_habitat" style="background-image: url('<?php echo $root[1] ?>');"><?php echo $mainTitle[1] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickForest">
            <h5 class="p-1"><?php echo $secondTitle[1] ?></h5>
            <p class="descr_p"><?php echo $content[1] ?></p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('cerf')"><?php echo $animalStyle[1] ?></li>
                <li class="li_animals" onclick="toggleImg('cochon')"><?php echo $animalStyle[2] ?></li>
                <li class="li_animals" onclick="toggleImg('lapin')"><?php echo $animalStyle[3] ?></li>
                <li class="li_animals" onclick="toggleImg('dain')"><?php echo $animalStyle[4] ?></li>
                <li class="li_animals" onclick="toggleImg('poule')"><?php echo $animalStyle[5] ?></li>
                <li class="li_animals" onclick="toggleImg('chevreuil')"><?php echo $animalStyle[6] ?></li>
                <li class="li_animals" onclick="toggleImg('ecureuil')"><?php echo $animalStyle[7] ?></li>
              </ul>
              <img class="col-7" src='<?php echo $root[2] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="cerf">
              <div class="descr_animal">
                Prénom: <?php echo $firstName[1] ?><br>
                Race: <?php echo $race[1] ?><br>
                Lieu: <?php echo $location[1] ?><br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[1] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="cochon">
              <div class="descr_animal">
                Prénom: Peggy et Dan<br>
                Race: Gascon<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[2] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="lapin">
              <div class="descr_animal">
                Prénom: Jayson et Olie<br>
                Race: Bélier Hollandais<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[3] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="dain">
              <div class="descr_animal">
                Prénom: Vinc et Carole<br>
                Race: Européen<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[4] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="poule">
              <div class="descr_animal">
                Prénom: Sabine et Jacky<br>
                Race: Poules d'ornement<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[5] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="chevreuil">
              <div class="descr_animal">
                Prénom: Banbi et Harry<br>
                Race: Capreolus Pygargus<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[6] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="ecureuil">
              <div class="descr_animal">
                Prénom: Bino et Clark<br>
                Race: Roux d'Europe<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[7] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickPond')" class="btn_habitat" style="background-image: url('<?php echo $root[3] ?>');"><?php echo $mainTitle[2] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickPond"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1"><?php echo $secondTitle[2] ?></h5>
            <p class="descr_p"><?php echo $content[2] ?></p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('poisson')"><?php echo $animalStyle[8] ?></li>
                <li class="li_animals" onclick="toggleImg('tortue1')"><?php echo $animalStyle[9] ?></li>
                <li class="li_animals" onclick="toggleImg('flamand')"><?php echo $animalStyle[10] ?></li>
                <li class="li_animals" onclick="toggleImg('grenouille')"><?php echo $animalStyle[11] ?></li>
                <li class="li_animals" onclick="toggleImg('canard')"><?php echo $animalStyle[12] ?></li>
                <li class="li_animals" onclick="toggleImg('castor')"><?php echo $animalStyle[13] ?></li>
                <li class="li_animals" onclick="toggleImg('oie')"><?php echo $animalStyle[14] ?></li>
              </ul>
              <img class="col-7 p-3" src='<?php echo $root[4] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="poisson">
              <div class="descr_animal">
                Race: Clown Loach<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[8] ?>">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="tortue1">
              <div class="descr_animal">
                Prénom: Isa et Carolie<br>
                Race: Grecque<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[9] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="flamand">
              <div class="descr_animal">
                Race: Phoenicoptéridés<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[10] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="grenouille">
              <div class="descr_animal">
                Race: Rieuse<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[11] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="canard">
              <div class="descr_animal">
                Prénom: Billye et Mick<br>
                Race: Coureur indien<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[12] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="castor">
              <div class="descr_animal">
                Prénom: Djo et Bill<br>
                Race: fiber<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[13] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="oie">
              <div class="descr_animal">
                Prénom: Margaux et José<br>
                Race: Bourbonnais<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[14] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="container col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickVivarium')" class="btn_habitat" style="background-image: url('<?php echo $root[5] ?>');"><?php echo $mainTitle[3] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickVivarium"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1"><?php echo $secondTitle[3] ?></h5>
            <p class="descr_p"><?php echo $content[3] ?></p>
            <div class="row test">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('araignee')"><?php echo $animalStyle[15] ?></li>
                <li class="li_animals" onclick="toggleImg('cameleon')"><?php echo $animalStyle[16] ?></li>
                <li class="li_animals" onclick="toggleImg('boa')"><?php echo $animalStyle[17] ?></li>
                <li class="li_animals" onclick="toggleImg('crocodile')"><?php echo $animalStyle[18] ?></li>
                <li class="li_animals" onclick="toggleImg('python')"><?php echo $animalStyle[19] ?></li>
                <li class="li_animals" onclick="toggleImg('sauterelle')"><?php echo $animalStyle[20] ?></li>
                <li class="li_animals" onclick="toggleImg('alligator')"><?php echo $animalStyle[21] ?></li>
              </ul>
              <img class="col-7 p-3" src='<?php echo $root[6] ?>' width="20%">
            </div>
            <div class="hidAnimal" id="araignee">
              <div class="descr_animal">
                Prénom: Spider <br>
                Race: Actinopodidae<br>
                Lieu: Amérique central<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[15] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="cameleon">
              <div class="descr_animal">
                Prénom: Victor <br>
                Race: Furcifer<br>
                Lieu: Afrique central<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[16] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="boa">
              <div class="descr_animal">
                Prénom: Sniki<br>
                Race: Boa constricteur<br>
                Lieu: Afrique de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[17] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="crocodile">
              <div class="descr_animal">
                Prénom: Célio<br>
                Race: Crocodile américain<br>
                Lieu: Amérique central<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[18] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="python">
              <div class="descr_animal">
                Prénom: Pico<br>
                Race: Anchietae Bocage<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[19] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="sauterelle">
              <div class="descr_animal">
                Race: Dectique verrucivore<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[20] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="alligator">
              <div class="descr_animal">
                Prénom: Sabrola<br>
                Race: Alligator de Chine<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[21] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickOcean')" class="btn_habitat" style="background-image: url('<?php echo $root[13] ?>');"><?php echo $mainTitle[4] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickOcean"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1"><?php echo $secondTitle[4] ?></h5>
            <p class="descr_p"><?php echo $content[4] ?></p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('dauphin')"><?php echo $animalStyle[22] ?></li>
                <li class="li_animals" onclick="toggleImg('tortue')"><?php echo $animalStyle[23] ?></li>
                <li class="li_animals" onclick="toggleImg('hippocampe')"><?php echo $animalStyle[24] ?></li>
                <li class="li_animals" onclick="toggleImg('phoque')"><?php echo $animalStyle[25] ?></li>
                <li class="li_animals" onclick="toggleImg('pingouin')"><?php echo $animalStyle[26] ?></li>
                <li class="li_animals" onclick="toggleImg('requin')"><?php echo $animalStyle[27] ?></li>
                <li class="li_animals" onclick="toggleImg('meduse')"><?php echo $animalStyle[28] ?></li>
              </ul>
              <img class="col-7" src='<?php echo $root[14] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="dauphin">
              <div class="descr_animal">
                Prénom: Willy<br>
                Race: Tursiops aduncus<br>
                Lieu: Océan indien / pacifique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[22] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="tortue">
              <div class="descr_animal">
                Prénom: Raphael et Michelangelo<br>
                Race: Caouanne<br>
                Lieu: Partout sauf ocean Article<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[23] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal</p>
              </div>
            </div>
            <div class="hidAnimal" id="hippocampe">
              <div class="descr_animal">
                Prénom: César et Juliette<br>
                Race: Hippocampus kuda<br>
                Lieu: Océan Pacifique ou mer rouge<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[24] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="phoque">
              <div class="descr_animal">
                Prénom: Ben et Istas<br>
                Race: Phoque à capuchon<br>
                Lieu: Océan Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[25] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="pingouin">
              <div class="descr_animal">
                Prénom: Tej et Tor<br>
                Race: Alca torda<br>
                Lieu: Sur les cotes de l'Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[26] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="requin">
              <div class="descr_animal">
                Prénom: Mamy<br>
                Race: Requin du Groenland<br>
                Lieu: Océan Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[27] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="meduse">
              <div class="descr_animal">
                Race: Roux d'Europe<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[28] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- --------------------------------------SECOND PART--------------------------------------  -->

      <div class="row">
        <div class="col-12 col-lg-6 container mb-4">
          <button onclick="toggleDiv('getClickFarm')" class="btn_habitat" style="background-image: url('<?php echo $root[7] ?>');"><?php echo $mainTitle[5] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickFarm"><!-- Div recupere anchor accueil/id -->
            <h5 class="p-1"><?php echo $secondTitle[5] ?></h5>
            <p class="descr_p"><?php echo $content[5] ?></p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('bison')"><?php echo $animalStyle[29] ?></li>
                <li class="li_animals" onclick="toggleImg('vache')"><?php echo $animalStyle[30] ?></li>
                <li class="li_animals" onclick="toggleImg('girafe')"><?php echo $animalStyle[31] ?></li>
                <li class="li_animals" onclick="toggleImg('mouton')"><?php echo $animalStyle[32] ?></li>
                <li class="li_animals" onclick="toggleImg('antilope')"><?php echo $animalStyle[33] ?></li>
                <li class="li_animals" onclick="toggleImg('elephant')"><?php echo $animalStyle[34] ?></li>
                <li class="li_animals" onclick="toggleImg('cheval')"><?php echo $animalStyle[35] ?></li>
              </ul>
              <img class="col-7" src='<?php echo $root[8] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="bison">
              <div class="descr_animal">
                Prénom: Reco et Cogne<br>
                Race: Bison d'Amérique<br>
                Lieu: Amérique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[29] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="vache">
              <div class="descr_animal">
                Prénom: Cow et Poker<br>
                Race: Watusi<br>
                Lieu: Amérique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[30] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal</p>
              </div>
            </div>
            <div class="hidAnimal" id="girafe">
              <div class="descr_animal">
                Prénom: Olav et Béné<br>
                Race: Masaï<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[31] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="mouton">
              <div class="descr_animal">
                Prénom: Jayson et Anne<br>
                Race: Roux du Valais<br>
                Lieu: Europe de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[32] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="antilope">
              <div class="descr_animal">
                Prénom: Kev et Ana<br>
                Race: Elanp du Cap<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[33] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="elephant">
              <div class="descr_animal">
                Prénom: Tax et Dumbo<br>
                Race: Elephant d'Asie<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[34] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="cheval">
              <div class="descr_animal">
                Prénom: Cindy et Karl<br>
                Race: Camarillo white<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[35] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickRanch')" class="btn_habitat" style="background-image: url('<?php echo $root[9] ?>');"><?php echo $mainTitle[6] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickRanch">
            <h5 class="p-1"><?php echo $secondTitle[6] ?></h5>
            <p class="descr_p"><?php echo $content[6] ?></p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('lion')"><?php echo $animalStyle[36] ?></li>
                <li class="li_animals" onclick="toggleImg('rhinoceros')"><?php echo $animalStyle[37] ?></li>
                <li class="li_animals" onclick="toggleImg('buffle')"><?php echo $animalStyle[38] ?></li>
                <li class="li_animals" onclick="toggleImg('leopard')"><?php echo $animalStyle[39] ?></li>
                <li class="li_animals" onclick="toggleImg('jaguar')"><?php echo $animalStyle[40] ?></li>
                <li class="li_animals" onclick="toggleImg('loup')"><?php echo $animalStyle[41] ?></li>
                <li class="li_animals" onclick="toggleImg('chameaux')"><?php echo $animalStyle[42] ?></li>
              </ul>
              <img class="col-7 p-3" src='<?php echo $root[10] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="lion">
              <div class="descr_animal">
                Prénom: Simba et Pumba<br>
                Race: Lion du Sénégal<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[36] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="rhinoceros">
              <div class="descr_animal">
                Prénom: Ave et Steve<br>
                Race: Rhinocéros noir<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[37] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="buffle">
              <div class="descr_animal">
                Prénom: Hulk et Batman<br>
                Race: Syncerus caffer<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[38] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="leopard">
              <div class="descr_animal">
                Prénom: Léo et Par<br>
                Race: Panthera pardus<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[39] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="jaguar">
              <div class="descr_animal">
                Prénom: Jola et Burdi<br>
                Race: Jaguar Roux<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[40] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="loup">
              <div class="descr_animal">
                Prénom: Louve et Francis<br>
                Race: Loup sauvage<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[41] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="chameaux">
              <div class="descr_animal">
                Prénom: Rob et Camal<br>
                Race: Kharai<br>
                Lieu: Afrique du Nord<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[42] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 container mb-4">
          <button onclick="toggleDiv('getClickTaniere')" class="btn_habitat" style="background-image: url('<?php echo $root[11] ?>');"><?php echo $mainTitle[7] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickTaniere"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1"><?php echo $secondTitle[7] ?></h5>
            <p class="descr_p"><?php echo $content[7] ?></p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('ours_brun')"><?php echo $animalStyle[43] ?></li>
                <li class="li_animals" onclick="toggleImg('panda')"><?php echo $animalStyle[44] ?></li>
                <li class="li_animals" onclick="toggleImg('oran-outang')"><?php echo $animalStyle[45] ?></li>
                <li class="li_animals" onclick="toggleImg('gorille')"><?php echo $animalStyle[46] ?></li>
                <li class="li_animals" onclick="toggleImg('saimiri')"><?php echo $animalStyle[47] ?></li>
                <li class="li_animals" onclick="toggleImg('kango')"><?php echo $animalStyle[48] ?></li>
                <li class="li_animals" onclick="toggleImg('ours')"><?php echo $animalStyle[49] ?></li>
              </ul>
              <img class="col-7 p-3" src='<?php echo $root[12] ?>' width="20%">
            </div>
            <div class="hidAnimal" id="ours_brun">
              <div class="descr_animal">
                Prénom: Daphnée et Yama <br>
                Race: Ours brun<br>
                Lieu: Russie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[43] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="panda">
              <div class="descr_animal">
                Prénom: Izidor et Kami <br>
                Race: Panda Géant<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[44] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="oran-outang">
              <div class="descr_animal">
                Prénom: Mickey<br>
                Race: Pango<br>
                Lieu: Chine<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[45] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="gorille">
              <div class="descr_animal">
                Prénom: Val et Hicko<br>
                Race: Gorille de l'Est<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[46] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="saimiri">
              <div class="descr_animal">
                Race: Singes-écureuils<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[47] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="kango">
              <div class="descr_animal">
                Prénom: Chi et Dora<br>
                Race: Kangourou roux<br>
                Lieu: Océanie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[48] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="ours">
              <div class="descr_animal">
                Prénom: Ivo<br>
                Race: Grolar<br>
                Lieu: Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[49] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickBird')" class="btn_habitat" style="background-image: url('<?php echo $root[15] ?> ');"><?php echo $mainTitle[8] ?>
          </button>
          <div class="hidden container-fluid p-2" id="getClickBird"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1"><?php echo $secondTitle[8] ?></h5>
            <p class="descr_p"><?php echo $content[8] ?></p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('perroquet')"><?php echo $animalStyle[50] ?></li>
                <li class="li_animals" onclick="toggleImg('toucan')"><?php echo $animalStyle[51] ?></li>
                <li class="li_animals" onclick="toggleImg('aigle')"><?php echo $animalStyle[52] ?></li>
                <li class="li_animals" onclick="toggleImg('oiseau')"><?php echo $animalStyle[53] ?></li>
                <li class="li_animals" onclick="toggleImg('autruche')"><?php echo $animalStyle[54] ?></li>
                <li class="li_animals" onclick="toggleImg('hibou')"><?php echo $animalStyle[55] ?></li>
                <li class="li_animals" onclick="toggleImg('chouette')"><?php echo $animalStyle[56] ?></li>
              </ul>
              <img class="col-7 p-3" src='<?php echo $root[16] ?>' width="20%">
            </div>

            <div class="hidAnimal" id="perroquet">
              <div class="descr_animal">
                Prénom: Rico<br>
                Race: Ara<br>
                Lieu: Brésil<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[50] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="toucan">
              <div class="descr_animal">
                Prénom: Vilo<br>
                Race: Toco<br>
                Lieu: Brésil<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[51] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="aigle">
              <div class="descr_animal">
                Prénom: Jo<br>
                Race: Royal<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[52] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="oiseau">
              <div class="descr_animal">
                Prénom: Olivier<br>
                Race: Lanier<br>
                Lieu: Europe de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[53] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="autruche">
              <div class="descr_animal">
                Prénom: Tia et Milo<br>
                Race: Autruche à nuque rouge<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[54] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="hibou">
              <div class="descr_animal">
                Prénom: Ken<br>
                Race: Grand-duc<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[55] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
            <div class="hidAnimal" id="chouette">
              <div class="descr_animal">
                Prénom: Bastil<br>
                Race: Hulotte<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(<?php echo $rootAnimals[56] ?>);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p>
                <p>Sa nourriture: </p>
                <p>Le grammage de sa nourriture: </p>
                <p>Date de passage: </p>
                <p>Détail de l'état de l'animal: </p>
              </div>
            </div>
          </div>
        </div>
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

  <!-- ATTENTION la partie de JS Bootstrap n'est pas mise
   (https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js)-->


  <script src="../js/habitats.js"></script>
</body>

</html>