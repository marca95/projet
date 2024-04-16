<?php

// REMPLACER PAR INNER JOIN SI TOUS LES ANIMAUX SONT COMPLETER 

$viewData = $pdo->prepare('SELECT animals.name, animals.type, 
foods.food, foods.grams, foods.date_pass, 
states.state, states.detail, 
user_employed.username as nom_employe_employed,
user_vete.username as nom_employe_vete
FROM animals 
LEFT JOIN foods ON animals.id_animal = foods.id_animal
LEFT JOIN states ON animals.id_animal = states.id_animal
LEFT JOIN users as user_employed ON foods.id_employed = user_employed.id_user
LEFT JOIN users as user_vete ON states.id_vete = user_vete.id_user;');
$viewData->execute();
$datas = $viewData->fetchAll(PDO::FETCH_ASSOC);

// States homes
$viewHomes = $pdo->prepare('SELECT homes.id_home, homes.commonName, status_home.opinion_state, status_home.improvement, users.username
FROM homes
LEFT JOIN status_home ON status_home.id_home = homes.id_home
LEFT JOIN users ON users.id_user = status_home.id_veto');
$viewHomes->execute();
$homes = $viewHomes->fetchAll(PDO::FETCH_ASSOC);
