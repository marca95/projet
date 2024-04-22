<?php

if (getenv('JAWSDB_URL') !== false) {
  $dbparts = parse_url(getenv('JAWSDB_URL'));

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
