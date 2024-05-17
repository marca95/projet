<?php

// MongoDB library
require '../vendor/autoload.php';

//Get var env
Dotenv\Dotenv::createImmutable(__DIR__ . '/../.env')->load();

$usernameOnline = $_ENV['APP_MONGO_ONLINE_USERNAME'];
$passwordOnline = $_ENV['APP_MONGO_ONLINE_PASSWORD'];

use MongoDB\Client;
use MongoDB\BSON\ObjectID;

// Check if you connected on local
if ($_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1') {
  // Connexion locale
  $client = new MongoDB\Client("mongodb://localhost:27017");
} else {
  // Remote connexion
  $uri = "mongodb+srv://$usernameOnline:$passwordOnline@cluster0.1ybtwgx.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";
  $client = new MongoDB\Client($uri);
}
