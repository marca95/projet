<?php

$viewHomes = $pdo->prepare('SELECT * FROM homes');
$viewHomes->execute();
$homes = $viewHomes->fetchAll(PDO::FETCH_ASSOC);
