<?php

// Fetch data animals
function getAnimalsData($pdo)
{
  $itemsAnimals = 'SELECT 
  animals.name AS prenom, 
  animals.type, 
  animals.race, 
  animals.id_animal, 
  locations.NAME AS pays, 
  states.state, 
  states.detail,
  foods.food, 
  foods.grams, 
  foods.date_pass AS passage, 
  animals.root, 
  animals.commonName AS categorie, 
  animals.id_home
FROM 
  animals
LEFT JOIN 
  homes ON homes.id_home = animals.id_home
LEFT JOIN 
  locations ON locations.id_location = animals.id_location
LEFT JOIN 
  foods ON foods.id_animal = animals.id_animal
LEFT JOIN 
  states ON states.id_animal = animals.id_animal;';
  $stmt = $pdo->prepare($itemsAnimals);
  $stmt->execute();
  $animalsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $animalsData;
}

$animals = getAnimalsData($pdo);
