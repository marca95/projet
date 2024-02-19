<?php

$user = 'root';
$password = 'pierre2';

try {
  $db = new PDO('mysql:host=localhost;dbname=zoo', $user, $password);
} catch (PDOException $e) {
  print "Erreur : " . $e->getMessage() . "<br/>";
  die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="../style/css/contact.css" rel="styleSheet">
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
        <li><a href="connexion.html">Connexion</a></li>
        <li><a href="habitats.html">Habitats</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="accueil.html">Accueil</a></li>
      </ul>
      <div id="icon"></div>
    </nav>
  </header>

  <main>
    <div class="org_main">
      <div class="first_content">
        <div class="title row">
          <a class="recy_img col-3 col-xl-2" href="./terre.html">
            <img class="regl_img" src="../img/accueil/recyclage2.png" title="Nos sources d'énergie verte" alt="Terre plus verte">
          </a>
          <h2 class="col-6 col-xl-8">Contact</h2>
          <a class="cent_btn col-3 col-xl-2"><button class="btn btn-success" type="button">Tarifs</button></a>
        </div>
        <form method="POST" action="./recevoir_contact.php">
          <div class="mb-3">
            <label for="title" class="form-label">Titre de votre demande :</label>
            <input type="text" class="form-control" id="title">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail :</label>
            <input type="email" class="form-control" id="email">
            <div id="emailHelp" class="form-text">Nous vous répondrons sur cette adresse mail.</div>
          </div>
          <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea class="form-control" id="contact_description" rows="8"></textarea>
            <div class="form-text">Le texte ne peut pas contenir plus de 1000 mots.</div>
          </div>
          <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
        </form>
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
            <li class="footer-li"><a class="footer-a" href="./tarif.html">Nos tarifs</a></li>
            <li class="footer-li"><a class="footer-a" href="services.html#resto">Restaurant</a></li>
            <li class="footer-li"><a class="footer-a" href="services.html#habitat">Visite des habitats</a></li>
            <li class="footer-li"><a class="footer-a" href="services.html#train">Visite du Zoo en petit train</a></li>
          </ul>
        </div>
        <div class="footer-div">
          <ul class="footer-ul">
            <li class="footer-titre">Horaires</li>
            <li>Lundi : Fermé</li>
            <li>Mardi : Fermé</li>
            <li>Mercredi : 10h à 19h</li>
            <li>Jeudi : 10h à 19h</li>
            <li>Vendredi : 10h à 19h</li>
            <li>Samedi : 10h à 19h</li>
            <li>Dimanche : 10h à 19h</li>
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


  <script src="../js/contact.js"></script>
</body>

</html>