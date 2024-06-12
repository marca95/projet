<?php
include_once '../mariadb/connect.php';

// view states
$stmt = $pdo->prepare('SELECT employe.name as nom_employe, employe.first_name as prenom_employe,
vete.name as nom_vete, vete.first_name as prenom_vete, animals.id_animal, animals.name, animals.type, states.state, states.detail, foods.food, foods.grams, foods.date_pass 
FROM animals
LEFT JOIN states ON animals.id_animal = states.id_animal
LEFT JOIN foods ON animals.id_animal = foods.id_animal
LEFT JOIN users AS employe ON foods.id_employed = employe.id_user
LEFT JOIN users AS vete ON states.id_vete = vete.id_user');
$stmt->execute();
$viewStates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update states

$message = '';

if (isset($_POST['idAnimal'], $_POST['state'])) {
  $idAnimal = $_POST['idAnimal'];
  $state = htmlspecialchars($_POST['state']);
  $detail = isset($_POST['detail']) ? htmlspecialchars($_POST['detail']) : '';
  $idVete = isset($_POST['id_user']) ? $_POST['id_user'] : '';
  $idVete = intval($idVete);

  $animalExists = false;
  foreach ($viewStates as $animal) {
    if ($animal['id_animal'] == $idAnimal) {
      $animalExists = true;
      break;
    }
  }

  if ($animal['state'] !== null) {
    $updateStates = $pdo->prepare('UPDATE states SET state = :state, detail = :detail, id_vete = :id_vete WHERE id_animal = :id_animal');
  } else {
    $updateStates = $pdo->prepare('INSERT INTO states(id_animal, state, detail, id_vete) VALUES (:id_animal, :state, :detail, :id_vete)');
  }

  $updateStates->bindValue(':id_animal', $idAnimal);
  $updateStates->bindValue(':state', $state);
  $updateStates->bindValue(':detail', $detail);
  $updateStates->bindValue(':id_vete', $idVete);

  if ($updateStates->execute()) {
    $message =  "Données bien enregistrées.";
  } else {
    $message = " Erreur SQL : " . $updateStates->errorInfo()[2];
  }
}

// Add comment habitat
$request = $pdo->prepare('SELECT id_home FROM status_home');
$request->execute();
$habitats = $request->fetchAll(PDO::FETCH_COLUMN);

$messageHabitat = '';

if (isset($_POST['idHabitat'], $_POST['opinion'])) {
  $idHabitat = isset($_POST['idHabitat']) ? $_POST['idHabitat'] : '';
  $opinion = isset($_POST['opinion']) ? htmlspecialchars($_POST['opinion']) : '';
  $improvement = isset($_POST['improvement']) ? htmlspecialchars($_POST['improvement']) : '';
  $idVete = isset($_POST['id_user']) ? $_POST['id_user'] : '';
  $idVete = intval($idVete);

  $habitatExists = false;
  foreach ($habitats as $habitat) {
    if ($habitat == $idHabitat) {
      $habitatExists = true;
      break;
    }
  }

  if (!$habitatExists) {
    $updateHabitat = $pdo->prepare('INSERT INTO status_home (id_home, opinion_state, improvement, id_veto) VALUES (:id_home, :opinion_state, :improvement, :id_veto)');
  } else {
    $updateHabitat = $pdo->prepare('UPDATE status_home SET opinion_state = :opinion_state, improvement = :improvement, id_veto = :id_veto WHERE id_home = :id_home');
  }

  $updateHabitat->bindValue(':id_home', $idHabitat);
  $updateHabitat->bindValue(':opinion_state', $opinion);
  $updateHabitat->bindValue(':improvement', $improvement);
  $updateHabitat->bindValue(':id_veto', $idVete);

  if ($updateHabitat->execute()) {
    $messageHabitat = 'Modification effectuée';
  } else {
    $messageHabitat = 'Erreur lors de la modification';
  }
}
