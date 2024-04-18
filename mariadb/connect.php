<?php

try {
  // With Heroku
  if (getenv('JAWSDB_URL') !== false) {
    $dbparts = parse_url(getenv('JAWSDB_URL'));

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');
  } else {
    // Connect DB
    $userDB = 'root';
    $passwordDB = 'pierre2';

    $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', $userDB, $passwordDB);
    // Gestion des erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
