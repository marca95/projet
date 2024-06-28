<?php

require '../vendor/autoload.php';
// Mettre en commentaire l'autoload pour effectuer mes tests avec PhpUnit


if (getenv('JAWSDB_MARIA_URL') !== false) {
  $dbparts = parse_url(getenv('JAWSDB_MARIA_URL'));

  $hostname = $dbparts['host'];
  $port = $dbparts['port'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'], '/');
} else {
  //Get var env
  Dotenv\Dotenv::createImmutable(__DIR__ . '../../')->load();

  $username = $_ENV['APP_MARIADB_LOCAL_USERNAME'];
  $password = $_ENV['APP_MARIADB_LOCAL_PASSWORD'];
  $hostname = $_ENV['APP_MARIADB_LOCAL_HOSTNAME'];
  $database = $_ENV['APP_MARIADB_LOCAL_DATABASE'];
  $port = $_ENV['APP_MARIADB_LOCAL_PORT'];

  // $username = $localUsername;
  // $password = $localPassword;
  // $hostname = $localHostname;
  // $database = $localDatabase;
  // $port = $localPort;
}

try {
  $pdo = new PDO('mysql:host=' . $hostname . ';port=' . $port . ';dbname=' . $database, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  error_log("Erreur de connexion à la base de données MariaDB :" . $e->getMessage());
}
