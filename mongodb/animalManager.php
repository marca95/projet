<?php

class AnimalManager
{
  public $collection;

  public function __construct($collection)
  {
    $this->collection = $collection;
  }

  public function createNewAnimal($name, $type, $commonName)
  {
    $name = htmlspecialchars($name);
    $type = htmlspecialchars($type);
    $commonName = htmlspecialchars($commonName);

    $insertResult = $this->collection->insertOne([
      'name' => $name,
      'type' => $type,
      'commonName' => $commonName,
      'nbr_view' => 0
    ]);

    return $insertResult->getInsertedCount() === 1;
  }

  public function updateAnimal($name, $type, $updateField)
  {
    $animal = $this->collection->findOne([
      "name" => $name,
      "type" => $type,
    ]);

    if (!$animal) {
      return false;
    }

    switch ($updateField) {
      case '1': // Son nom
        $updateValue = htmlspecialchars($_POST['update_name']);
        $updateResult = $this->collection->updateOne(
          ["_id" => $animal['_id']],
          ['$set' => ["name" => $updateValue]]
        );
        break;
      case '2': // Son type
        $updateValue = htmlspecialchars($_POST['update_type']);
        $updateResult = $this->collection->updateOne(
          ["_id" => $animal['_id']],
          ['$set' => ["type" => $updateValue]]
        );
        break;
      case '7': // Son nom commun
        $updateValue = htmlspecialchars($_POST['update_common_name']);
        $updateResult = $this->collection->updateOne(
          ["_id" => $animal['_id']],
          ['$set' => ["commonName" => $updateValue]]
        );
        break;
      default:
        return false;
    }

    return $updateResult->getModifiedCount() === 1;
  }

  public function deleteAnimal($name, $type)
  {
    $deleteResult = $this->collection->deleteOne([
      "name" => $name,
      "type" => $type
    ]);

    return $deleteResult->getDeletedCount() === 1;
  }

  public function incrementAnimalView($animalType)
  {
    $updateResult = $this->collection->updateOne(
      ['type' => $animalType],
      ['$inc' => ['nbr_view' => 1]]
    );

    return $updateResult->getModifiedCount() === 1;
  }

  public function getAnimalViews()
  {
    $cursor = $this->collection->find();
    $nbrViews = [];

    foreach ($cursor as $document) {
      $commonName = $document['commonName'];
      $nbrView = $document['nbr_view'];

      $nbrViews[$commonName] = ($nbrViews[$commonName] ?? 0) + $nbrView;
    }

    foreach ($nbrViews as $commonName => $views) {
      if (count(array_keys($nbrViews, $commonName)) > 1) {
        $views = ceil($views / 2);
      }
    }

    arsort($nbrViews);

    return $nbrViews;
  }
}
