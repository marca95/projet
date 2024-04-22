<?php

try {
  // With Heroku
  if (getenv('JAWSDB_URL') !== false) {
    $dbparts = parse_url(getenv('JAWSDB_URL'));

    $hostname = $dbparts['cxmgkzhk95kfgbq4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'];
    $username = $dbparts['zvv65igt98n68w6t'];
    $password = $dbparts['cxmgkzhk95kfgbq4'];
    $database = ltrim($dbparts['coi8vzror4dadlrt'], '/');
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
