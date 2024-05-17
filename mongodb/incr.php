<?php

require '../vendor/autoload.php';

//Get var env
Dotenv\Dotenv::createImmutable(__DIR__ . '/../.env')->load();

$databaseOnline = $_ENV['APP_MONGO_ONLINE_DATABASE'];
$collectionOnline = $_ENV['APP_MONGO_ONLINE_COLLECTION'];

if (isset($_GET['type'])) {
  $animal_type = $_GET['type'];

  $collection = $client->selectDatabase("$databaseOnline")->selectCollection("$collectionOnline");

  // Mettre à jour le nombre de vues de l'animal correspondant
  $updateResult = $collection->updateOne(
    ['type' => $animal_type],
    ['$inc' => ['nbr_view' => 1]]
  );

  if ($updateResult->getModifiedCount() === 1) {
    echo "Le nombre de vues de l'animal a été incrémenté avec succès.";
  } else {
    echo "Une erreur s'est produite lors de l'incrémentation du nombre de vues de l'animal.";
  }
}
