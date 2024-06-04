<?php
// Update hourly

$horaires = $pdo->prepare('SELECT * FROM horaires');
$horaires->execute();
$sethoraires = $horaires->fetchAll(PDO::FETCH_ASSOC);

$succesHour = '';

if (isset($_POST['setHours'])) {

  $newMondayStart = isset($_POST['mondayStart']) ? $_POST['mondayStart'] : '';
  $newMondayEnd = isset($_POST['mondayEnd']) ? $_POST['mondayEnd'] : '';
  $newMondayClosed = isset($_POST['mondayClosed']) ? $_POST['mondayClosed'] : '';
  $newTuesdayStart = isset($_POST['tuesdayStart']) ? $_POST['tuesdayStart'] : '';
  $newTuesdayEnd = isset($_POST['tuesdayEnd']) ? $_POST['tuesdayEnd'] : '';
  $newTuesdayClosed = isset($_POST['tuesdayClosed']) ? $_POST['tuesdayClosed'] : '';
  $newWednesdayStart = isset($_POST['wednesdayStart']) ? $_POST['wednesdayStart'] : '';
  $newWednesdayEnd = isset($_POST['wednesdayEnd']) ? $_POST['wednesdayEnd'] : '';
  $newWednesdayClosed = isset($_POST['wednesdayClosed']) ? $_POST['wednesdayClosed'] : '';
  $newThursdayStart = isset($_POST['thursdayStart']) ? $_POST['thursdayStart'] : '';
  $newThursdayEnd = isset($_POST['thursdayEnd']) ? $_POST['thursdayEnd'] : '';
  $newThursdayClosed = isset($_POST['thursdayClosed']) ? $_POST['thursdayClosed'] : '';
  $newFridayStart = isset($_POST['fridayStart']) ? $_POST['fridayStart'] : '';
  $newFridayEnd = isset($_POST['fridayEnd']) ? $_POST['fridayEnd'] : '';
  $newFridayClosed = isset($_POST['fridayClosed']) ? $_POST['fridayClosed'] : '';
  $newSaturdayStart = isset($_POST['saturdayStart']) ? $_POST['saturdayStart'] : '';
  $newSaturdayEnd = isset($_POST['saturdayEnd']) ? $_POST['saturdayEnd'] : '';
  $newSaturdayClosed = isset($_POST['saturdayClosed']) ? $_POST['saturdayClosed'] : '';
  $newSundayStart = isset($_POST['sundayStart']) ? $_POST['sundayStart'] : '';
  $newSundayEnd = isset($_POST['sundayEnd']) ? $_POST['sundayEnd'] : '';
  $newSundayClosed = isset($_POST['sundayClosed']) ? $_POST['sundayClosed'] : '';

  $stmt = $pdo->prepare('UPDATE horaires SET start_time = :start_time, end_time = :end_time, is_closed = :is_closed WHERE day_week = :day_week');

  $stmt->execute(['start_time' => $newMondayStart, 'end_time' => $newMondayEnd, 'is_closed' => $newMondayClosed, 'day_week' => 'Lundi']);
  $stmt->execute(['start_time' => $newTuesdayStart, 'end_time' => $newTuesdayEnd, 'is_closed' => $newTuesdayClosed, 'day_week' => 'Mardi']);
  $stmt->execute(['start_time' => $newWednesdayStart, 'end_time' => $newWednesdayEnd, 'is_closed' => $newWednesdayClosed, 'day_week' => 'Mercredi']);
  $stmt->execute(['start_time' => $newThursdayStart, 'end_time' => $newThursdayEnd, 'is_closed' => $newThursdayClosed, 'day_week' => 'Jeudi']);
  $stmt->execute(['start_time' => $newFridayStart, 'end_time' => $newFridayEnd, 'is_closed' => $newFridayClosed, 'day_week' => 'Vendredi']);
  $stmt->execute(['start_time' => $newSaturdayStart, 'end_time' => $newSaturdayEnd, 'is_closed' => $newSaturdayClosed, 'day_week' => 'Samedi']);
  $stmt->execute(['start_time' => $newSundayStart, 'end_time' => $newSundayEnd, 'is_closed' => $newSundayClosed, 'day_week' => 'Dimanche']);

  $succesHour = 'Enregistrement validé.';
}
