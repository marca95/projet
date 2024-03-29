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
          <button onclick="toggleDiv('getClickForest')" class="btn_habitat" style="background-image: url(../img/habitats/foret.jpg);">La
            foret
          </button>
          <div class="hidden container-fluid p-2" id="getClickForest">
            <h5 class="p-1">La foret d'Arcadia :</h5>
            <p class="descr_p">Cette foret s'étend sur + de 3000m² où se cache de nombreux cervidés ainsi que rencontrer
              quelques animaux de la ferme.
              Vous pouvez vous y ballader en toute tranquillité, profitez du calme et des magnifiques hêtres de plus de
              80ans. Ces animaux sont innofensifs, merci de respecter les silences et respecter leurs bien-être.
            </p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('cerf')">Le cerf</li>
                <li class="li_animals" onclick="toggleImg('cochon')">Les cochons</li>
                <li class="li_animals" onclick="toggleImg('lapin')">Les lapins</li>
                <li class="li_animals" onclick="toggleImg('dain')">Les dains</li>
                <li class="li_animals" onclick="toggleImg('poule')">Les poules</li>
                <li class="li_animals" onclick="toggleImg('chevreuil')">Les chevreuils</li>
                <li class="li_animals" onclick="toggleImg('ecureuil')">Les écureuils</li>
              </ul>
              <img class="col-7" src="../img/habitats/foret1.jpg" width="20%" title="zone forestière">
            </div>

            <div class="hidAnimal" id="cerf">
              <div class="descr_animal">
                Prénom: Teddy<br>
                Race: Cervus elaphus<br>
                Lieu: Europe-occidentale<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/cerf.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="cochon">
              <div class="descr_animal">
                Prénom: Peggy et Dan<br>
                Race: Gascon<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/cochon.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="lapin">
              <div class="descr_animal">
                Prénom: Jayson et Olie<br>
                Race: Bélier Hollandais<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/lapin.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="dain">
              <div class="descr_animal">
                Prénom: Vinc et Carole<br>
                Race: Européen<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/dains.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="poule">
              <div class="descr_animal">
                Prénom: Sabine et Jacky<br>
                Race: Poules d'ornement<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/poule.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="chevreuil">
              <div class="descr_animal">
                Prénom: Banbi et Harry<br>
                Race: Capreolus Pygargus<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/chevreuil.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="ecureuil">
              <div class="descr_animal">
                Prénom: Bino et Clark<br>
                Race: Roux d'Europe<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/ecureuil.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickPond')" class="btn_habitat" style="background-image: url(../img/habitats/etang.jpg);">L'étang
          </button>
          <div class="hidden container-fluid p-2" id="getClickPond"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1">La plage</h5>
            <p class="descr_p">Grand bassin d'eau avec petite île au milieu pour que nos canards puissent se reposer
              sans être déranger. Notre étang cache des nombreuses espèces.
              La qualité de l'eau est controlé hebdomadairement par nos vétérinaire, afin de s'assurer le bien-être de
              nos animaux.
            </p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('poisson')">Les poissons Asiatique</li>
                <li class="li_animals" onclick="toggleImg('tortue1')">Les tortues</li>
                <li class="li_animals" onclick="toggleImg('flamand')">Les flamands Rose</li>
                <li class="li_animals" onclick="toggleImg('grenouille')">Les grenouilles</li>
                <li class="li_animals" onclick="toggleImg('canard')">Les canards</li>
                <li class="li_animals" onclick="toggleImg('castor')">Nos castors</li>
                <li class="li_animals" onclick="toggleImg('oie')">Les oies</li>
              </ul>
              <img class="col-7 p-3" src="../img/habitats/etang1.jpg" width="20%" title="Nunéphare">
            </div>

            <div class="hidAnimal" id="poisson">
              <div class="descr_animal">
                Race: Clown Loach<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/poisson.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="tortue1">
              <div class="descr_animal">
                Prénom: Isa et Carolie<br>
                Race: Grecque<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/tortue.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="flamand">
              <div class="descr_animal">
                Race: Phoenicoptéridés<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/flamand.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="grenouille">
              <div class="descr_animal">
                Race: Rieuse<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/grenouille.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="canard">
              <div class="descr_animal">
                Prénom: Billye et Mick<br>
                Race: Coureur indien<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/canard.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="castor">
              <div class="descr_animal">
                Prénom: Djo et Bill<br>
                Race: fiber<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/castor.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="oie">
              <div class="descr_animal">
                Prénom: Margaux et José<br>
                Race: Bourbonnais<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/oie.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="container col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickVivarium')" class="btn_habitat" style="background-image: url(../img/habitats/vivarium.jpg);">Nos
            vivariums
          </button>
          <div class="hidden container-fluid p-2" id="getClickVivarium"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1">La zone de danger</h5>
            <p class="descr_p">Nous appelons la zone de danger, le lieu où se situe tous nos vivariums. Nous habritons
              des animaux qui, sur une piqûre ou une moruse de ceux-ci peuvent être fatal pour l'homme. Les animaux sont
              dans des vivariums adéquat avec une température idéal pour chaque.
            </p>
            <div class="row test">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('araignee')">L'araignée</li>
                <li class="li_animals" onclick="toggleImg('cameleon')">Le caméléon</li>
                <li class="li_animals" onclick="toggleImg('boa')">Le boa</li>
                <li class="li_animals" onclick="toggleImg('crocodile')">Le crocodile</li>
                <li class="li_animals" onclick="toggleImg('python')">Le python</li>
                <li class="li_animals" onclick="toggleImg('sauterelle')">Les sauterelles</li>
                <li class="li_animals" onclick="toggleImg('alligator')">L'alligator</li>
              </ul>
              <img class="col-7 p-3" src="../img/habitats/vivarium1.jpg" width="20%" title="Vivarium">
            </div>
            <div class="hidAnimal" id="araignee">
              <div class="descr_animal">
                Prénom: Spider <br>
                Race: Actinopodidae<br>
                Lieu: Amérique central<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/araignee.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="cameleon">
              <div class="descr_animal">
                Prénom: Victor <br>
                Race: Furcifer<br>
                Lieu: Afrique central<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/cameleon.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="boa">
              <div class="descr_animal">
                Prénom: Sniki<br>
                Race: Boa constricteur<br>
                Lieu: Afrique de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/boa.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="crocodile">
              <div class="descr_animal">
                Prénom: Célio<br>
                Race: Crocodile américain<br>
                Lieu: Amérique central<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/crocodile.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="python">
              <div class="descr_animal">
                Prénom: Pico<br>
                Race: Anchietae Bocage<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/python.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="sauterelle">
              <div class="descr_animal">
                Race: Dectique verrucivore<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/sauterelle.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="alligator">
              <div class="descr_animal">
                Prénom: Sabrola<br>
                Race: Alligator de Chine<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/alligator.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickOcean')" class="btn_habitat" style="background-image: url(../img/habitats/oceanarium.jpg);">L'océanarium
          </button>
          <div class="hidden container-fluid p-2" id="getClickOcean"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1">Le sous-marin :</h5>
            <p class="descr_p">Magnifique espace vitrée où se situe également un tunnel de + de 50m de long pour rentrer
              dans le monde de l'océan. Cette espace est l'une de plus grande fierté du patron car il habrite des
              spécimen rare et très ancien.
            </p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('dauphin')">Le dauphin</li>
                <li class="li_animals" onclick="toggleImg('tortue')">Les tortues marines</li>
                <li class="li_animals" onclick="toggleImg('hippocampe')">Les hippocampes</li>
                <li class="li_animals" onclick="toggleImg('phoque')">Les phoques</li>
                <li class="li_animals" onclick="toggleImg('pingouin')">Les pingouins</li>
                <li class="li_animals" onclick="toggleImg('requin')">Le requin</li>
                <li class="li_animals" onclick="toggleImg('meduse')">Les méduses</li>
              </ul>
              <img class="col-7" src="../img/habitats/oceanarium1.jpg" width="20%" title="zone forestière">
            </div>

            <div class="hidAnimal" id="dauphin">
              <div class="descr_animal">
                Prénom: Willy<br>
                Race: Tursiops aduncus<br>
                Lieu: Océan indien / pacifique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/dauphin.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="tortue">
              <div class="descr_animal">
                Prénom: Raphael et Michelangelo<br>
                Race: Caouanne<br>
                Lieu: Partout sauf ocean Article<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/tortue1.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal</p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="hippocampe">
              <div class="descr_animal">
                Prénom: César et Juliette<br>
                Race: Hippocampus kuda<br>
                Lieu: Océan Pacifique ou mer rouge<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/hippocampe.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="phoque">
              <div class="descr_animal">
                Prénom: Ben et Istas<br>
                Race: Phoque à capuchon<br>
                Lieu: Océan Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/phoques.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="pingouin">
              <div class="descr_animal">
                Prénom: Tej et Tor<br>
                Race: Alca torda<br>
                Lieu: Sur les cotes de l'Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/pingouin.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="requin">
              <div class="descr_animal">
                Prénom: Mamy<br>
                Race: Requin du Groenland<br>
                Lieu: Océan Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/requin.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="meduse">
              <div class="descr_animal">
                Race: Roux d'Europe<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/meduse.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- --------------------------------------SECOND PART--------------------------------------  -->

      <div class="row">
        <div class="col-12 col-lg-6 container mb-4">
          <button onclick="toggleDiv('getClickFarm')" class="btn_habitat" style="background-image: url(../img/habitats/pature.jpg);">Notre
            pâture
          </button>
          <div class="hidden container-fluid p-2" id="getClickFarm"><!-- Div recupere anchor accueil/id -->
            <h5 class="p-1">L'espace vert :</h5>
            <p class="descr_p">Cet immense champs vert ou sont stockés également nos installations pour l'énergie verte
              est l'habitat de beaucoup de gros animaux, autant d'Afrique que d'Amérique.
            </p>
            <div class="row d-flex mb-3">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('bison')">Les bisons</li>
                <li class="li_animals" onclick="toggleImg('vache')">Les vaches</li>
                <li class="li_animals" onclick="toggleImg('girafe')">Les girafes</li>
                <li class="li_animals" onclick="toggleImg('mouton')">Les moutons</li>
                <li class="li_animals" onclick="toggleImg('antilope')">Les antilopes</li>
                <li class="li_animals" onclick="toggleImg('elephant')">Les éléphants</li>
                <li class="li_animals" onclick="toggleImg('cheval')">Les chevaux</li>
              </ul>
              <img class="col-7" src="../img/habitats/pature1.jpg" width="20%" title="Pature">
            </div>

            <div class="hidAnimal" id="bison">
              <div class="descr_animal">
                Prénom: Reco et Cogne<br>
                Race: Bison d'Amérique<br>
                Lieu: Amérique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/bison.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="vache">
              <div class="descr_animal">
                Prénom: Cow et Poker<br>
                Race: Watusi<br>
                Lieu: Amérique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/vache.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal</p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="girafe">
              <div class="descr_animal">
                Prénom: Olav et Béné<br>
                Race: Masaï<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/girafe.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="mouton">
              <div class="descr_animal">
                Prénom: Jayson et Anne<br>
                Race: Roux du Valais<br>
                Lieu: Europe de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/mouton.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="antilope">
              <div class="descr_animal">
                Prénom: Kev et Ana<br>
                Race: Elanp du Cap<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/antilope.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="elephant">
              <div class="descr_animal">
                Prénom: Tax et Dumbo<br>
                Race: Elephant d'Asie<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/elephant.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="cheval">
              <div class="descr_animal">
                Prénom: Cindy et Karl<br>
                Race: Camarillo white<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/cheval.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickRanch')" class="btn_habitat" style="background-image: url(../img/habitats/ranch.jpg);">Le ranch
          </button>
          <div class="hidden container-fluid p-2" id="getClickRanch">
            <h5 class="p-1">Le west-Arca</h5>
            <p class="descr_p">Vous allez rentrer dans le monde du western, avec les décorations en bois ancien. Vous
              allez également découvrir le roi de la jungle ainsi que le big Five d'Afrique.
            </p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('lion')">Les lions</li>
                <li class="li_animals" onclick="toggleImg('rhinoceros')">Les rhinocéroses</li>
                <li class="li_animals" onclick="toggleImg('buffle')">Les buffles</li>
                <li class="li_animals" onclick="toggleImg('leopard')">Les léopards</li>
                <li class="li_animals" onclick="toggleImg('jaguar')">Les jaguars</li>
                <li class="li_animals" onclick="toggleImg('loup')">Les loups</li>
                <li class="li_animals" onclick="toggleImg('chameaux')">Les chameaux</li>
              </ul>
              <img class="col-7 p-3" src="../img/habitats/ranch1.jpg" width="20%" title="ranch">
            </div>

            <div class="hidAnimal" id="lion">
              <div class="descr_animal">
                Prénom: Simba et Pumba<br>
                Race: Lion du Sénégal<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/lion.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="rhinoceros">
              <div class="descr_animal">
                Prénom: Ave et Steve<br>
                Race: Rhinocéros noir<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/rhinoceros.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="buffle">
              <div class="descr_animal">
                Prénom: Hulk et Batman<br>
                Race: Syncerus caffer<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/buffle.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="leopard">
              <div class="descr_animal">
                Prénom: Léo et Par<br>
                Race: Panthera pardus<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/leopard.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="jaguar">
              <div class="descr_animal">
                Prénom: Jola et Burdi<br>
                Race: Jaguar Roux<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/jaguar.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="loup">
              <div class="descr_animal">
                Prénom: Louve et Francis<br>
                Race: Loup sauvage<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/loup.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="chameaux">
              <div class="descr_animal">
                Prénom: Rob et Camal<br>
                Race: Kharai<br>
                Lieu: Afrique du Nord<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/chameau.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 container mb-4">
          <button onclick="toggleDiv('getClickTaniere')" class="btn_habitat" style="background-image: url(../img/habitats/taniere.jpg);">Les tanières
          </button>
          <div class="hidden container-fluid p-2" id="getClickTaniere"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1">La pénombre</h5>
            <p class="descr_p">Certains animaux préfèrent rester dans l'obscurité aux abris des regards. D'autres
              justement préfèrent rester au soleil et rentrer dans leur tanière le soir afin de ne pas être à découvert.
              Vous y découvrirez des animaux venus de tout autour du monde!
            </p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('ours_brun')">Les ours brun</li>
                <li class="li_animals" onclick="toggleImg('panda')">Les pandas</li>
                <li class="li_animals" onclick="toggleImg('oran-outang')">L'oran-outang</li>
                <li class="li_animals" onclick="toggleImg('gorille')">Les gorilles</li>
                <li class="li_animals" onclick="toggleImg('saimiri')">Les saïmiris</li>
                <li class="li_animals" onclick="toggleImg('kango')">Les kangourous</li>
                <li class="li_animals" onclick="toggleImg('ours')">L'ours polaire</li>
              </ul>
              <img class="col-7 p-3" src="../img/habitats/taniere1.jpg" width="20%" title="taniere">
            </div>
            <div class="hidAnimal" id="ours_brun">
              <div class="descr_animal">
                Prénom: Daphnée et Yama <br>
                Race: Ours brun<br>
                Lieu: Russie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/ours.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="panda">
              <div class="descr_animal">
                Prénom: Izidor et Kami <br>
                Race: Panda Géant<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/panda.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="oran-outang">
              <div class="descr_animal">
                Prénom: Mickey<br>
                Race: Pango<br>
                Lieu: Chine<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/orang-outang.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="gorille">
              <div class="descr_animal">
                Prénom: Val et Hicko<br>
                Race: Gorille de l'Est<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/gorille.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="saimiri">
              <div class="descr_animal">
                Race: Singes-écureuils<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/saimiri.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="kango">
              <div class="descr_animal">
                Prénom: Chi et Dora<br>
                Race: Kangourou roux<br>
                Lieu: Océanie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/kangourou.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="ours">
              <div class="descr_animal">
                Prénom: Ivo<br>
                Race: Grolar<br>
                Lieu: Arctique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/ours-polaire.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
          <button onclick="toggleDiv('getClickBird')" class="btn_habitat" style="background-image: url(../img/habitats/voliere.jpg);">Les volières
          </button>
          <div class="hidden container-fluid p-2" id="getClickBird"><!--Div recupere anchor accueil/id-->
            <h5 class="p-1">Le ciel d'Arcadia</h5>
            <p class="descr_p">Notre volière accueil jusqu'à 50 espèces de volatiles différents. Ici, nous allons vous
              montrez les animaux ayant le plus de succès auprès de nos visiteurs, mais croyez nous, tous, sont en très
              bonne santé et vivent "leur best life".
            </p>
            <div class="row d-flex">
              <h6>Vous pouvez rencontrer :</h6>
              <ul class="list_animals col-4 ms-3">
                <li class="li_animals" onclick="toggleImg('perroquet')">Le perroquet</li>
                <li class="li_animals" onclick="toggleImg('toucan')">Le toucan</li>
                <li class="li_animals" onclick="toggleImg('aigle')">L'aigle</li>
                <li class="li_animals" onclick="toggleImg('oiseau')">Le faucon</li>
                <li class="li_animals" onclick="toggleImg('autruche')">Les autruches</li>
                <li class="li_animals" onclick="toggleImg('hibou')">Le hibou</li>
                <li class="li_animals" onclick="toggleImg('chouette')">La chouette</li>
              </ul>
              <img class="col-7 p-3" src="../img/habitats/voliere1.jpg" width="20%" title="voliere">
            </div>

            <div class="hidAnimal" id="perroquet">
              <div class="descr_animal">
                Prénom: Rico<br>
                Race: Ara<br>
                Lieu: Brésil<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/perroquet.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="toucan">
              <div class="descr_animal">
                Prénom: Vilo<br>
                Race: Toco<br>
                Lieu: Brésil<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/toucan.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="aigle">
              <div class="descr_animal">
                Prénom: Jo<br>
                Race: Royal<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/aigle.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="oiseau">
              <div class="descr_animal">
                Prénom: Olivier<br>
                Race: Lanier<br>
                Lieu: Europe de l'est<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/faucon.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="autruche">
              <div class="descr_animal">
                Prénom: Tia et Milo<br>
                Race: Autruche à nuque rouge<br>
                Lieu: Afrique<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/autruche.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="hibou">
              <div class="descr_animal">
                Prénom: Ken<br>
                Race: Grand-duc<br>
                Lieu: Asie<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/hibou.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
              </div>
            </div>
            <div class="hidAnimal" id="chouette">
              <div class="descr_animal">
                Prénom: Bastil<br>
                Race: Hulotte<br>
                Lieu: Europe<br>
              </div>
              <div class="img_animals" style="background-image: url(../img/habitats/chouette.jpg);">
              </div>
              <div class="avis_veterinaire">
                <p>Etat de l'animal: </p> <!--RECUPERER AVIS VETERINAIRE -->
                <p>Sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Le grammage de sa nourriture: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Date de passage: </p><!--RECUPERER AVIS VETERINAIRE -->
                <p>Détail de l'état de l'animal: </p><!--RECUPERER AVIS VETERINAIRE -->
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