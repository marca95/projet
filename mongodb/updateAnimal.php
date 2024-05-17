<?php

require '../vendor/autoload.php';

//Get var env
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$databaseOnline = $_ENV['APP_MONGO_ONLINE_DATABASE'];

$database = $client->selectDatabase($databaseOnline);
$collection = $database->animals;

// Vérification et ajout de l'animal
if (isset($_POST['createNewAnimal'])) {
  $name = $_POST['name'];
  $type = $_POST['type'];
  $commonName = $_POST['commonName'];

  // Incrémenter le compteur d'identifiant
  $result = $database->command([
    'findAndModify' => 'id_animal',
    'query' => ['_id' => 'id_animal'],
    'update' => ['$inc' => ['seq' => 1]],
    'new' => true,
  ]);

  if (isset($result->value['seq'])) {
    $id_animal = $result->value['seq'];
  }

  $insertResult = $collection->insertOne([
    'name' => $name,
    'type' => $type,
    'commonName' => $commonName,
    'nbr_view' => 0
  ]);

  if ($insertResult->getInsertedCount() === 1) {
    $messageAnimal = "L'animal a été ajouté avec succès à la base de données.";
  } else {
    $messageAnimal = "Une erreur s'est produite lors de l'ajout de l'animal dans MongoDB.";
  }
}

// Update animal

if (isset($_POST['formUpdateAnimal'])) {
  if (isset($_POST['choice_animal'])) {
    $selectedAnimal = explode('|', $_POST['choice_animal']);
    $name = $selectedAnimal[1];
    $type = $selectedAnimal[2];

    $animal = $collection->findOne([
      "name" => $name,
      "type" => $type
    ]);

    if (!$animal) {
      $updateAnimal = "Animal pas trouvé dans la base de données MongoDB";
    } else {
      $attr_animal = $_POST['attribut_animal'];
      switch ($attr_animal) {
        case '1':
          $updateName = $_POST['update_name'];
          $updateResult = $collection->updateOne(
            ["_id" => $animal['_id']],
            ['$set' => ["name" => $updateName]]
          );
          break;
        case '2':
          $updateType = $_POST['update_type'];
          $updateResult = $collection->updateOne(
            ["_id" => $animal['_id']],
            ['$set' => ["type" => $updateType]]
          );
          break;
        case '7':
          $updateCommonName = $_POST['update_common_name'];
          $updateResult = $collection->updateOne(
            ["_id" => $animal['_id']],
            ['$set' => ["commonName" => $updateCommonName]]
          );
          break;
        default:
          break;
      }
    }
  }
}

// DELETE WITH MONGODB 

if (isset($_POST['formDeleteAnimal'])) {
  if (isset($_POST['animal_delete'])) {
    $selectedAnimal = explode('|', $_POST['animal_delete']);
    $name = $selectedAnimal[1];
    $type = $selectedAnimal[2];

    $collection->deleteOne([
      "name" => $name,
      "type" => $type
    ]);

    $message = "L'animal $name de type $type a été supprimé avec succès dans la base de données MongoDB.";
  } else {
    $message = "Veuillez sélectionner un animal à supprimer.";
  }
}
