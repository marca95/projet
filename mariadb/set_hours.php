<?php
// Update hourly

$horaires = $pdo->prepare('SELECT * FROM horaires');
$horaires->execute();
$sethoraires = $horaires->fetchAll(PDO::FETCH_ASSOC);

$succesHour = '';
$error = '';

if (isset($_POST['setHours'])) {

  // Fonction pour valider le format de l'heure (XXhXX)
  function validateHour($hour)
  {
    return preg_match('/^\d{2}h\d{2}$/', $hour);
  }

  // Valider et traiter les heures pour chaque jour de la semaine
  $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  foreach ($daysOfWeek as $day) {
    $newStartKey = strtolower($day) . 'Start';
    $newEndKey = strtolower($day) . 'End';
    $newClosedKey = strtolower($day) . 'Closed';

    $newStart = isset($_POST[$newStartKey]) ? $_POST[$newStartKey] : '';
    $newEnd = isset($_POST[$newEndKey]) ? $_POST[$newEndKey] : '';
    $newClosed = isset($_POST[$newClosedKey]) ? $_POST[$newClosedKey] : '';

    if (!empty($newStart) && !validateHour($newStart)) {
      $error = "Le format de l'heure de début pour $day n'est pas valide.";
      break;
    }

    if (!empty($newEnd) && !validateHour($newEnd)) {
      $error = "Le format de l'heure de fin pour $day n'est pas valide.";
      break;
    }

    $stmt = $pdo->prepare('UPDATE horaires SET start_time = :start_time, end_time = :end_time, is_closed = :is_closed WHERE day_week = :day_week');
    $stmt->execute(['start_time' => $newStart, 'end_time' => $newEnd, 'is_closed' => $newClosed, 'day_week' => $day]);
  }

  if (!$error) {
    $succesHour = 'Enregistrement validé.';
  }
}
