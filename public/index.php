<!DOCTYPE html>
<html lang="en">

<?php


if (getenv('JAWSDB_MARIA_URL') !== false) {
  $dbparts = parse_url(getenv('JAWSDB_MARIA_URL'));

  $hostname = $dbparts['host'];
  $port = $dbparts['port'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'], '/');
} else {
  $username = 'root';
  $password = 'pierre2';
  $hostname = 'localhost';
  $database = 'zoo';
  $port = '5353';
}

try {
  $pdo = new PDO('mysql:host=' . $hostname . ';port=' . $port . ';dbname=' . $database, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>OK POUR LA CONNEXION A L'INDEX</h1>

  <a href="./accueil.php">ALLER A LA PAGE D'ACCUEIL</a>

  <img src="../img/connexion/lama.jpg">
  <!-- 404  -->
  <p>Option 1</p>

  <img src="{{ url_for('static', filename='img/accueil/lama.jpg' ) }}">
  <p>Option 2</p>

  <img src="./img/connexion/lama.jpg">
  <p>Option 3</p>

  <img src=".../img/connexion/lama.jpg">
  <!-- IMPOSSIBLE -->
  <p>Option 4</p>
</body>

</html>