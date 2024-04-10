<?php

$viewServices = $pdo->prepare('SELECT * FROM services');
$viewServices->execute();
$services = $viewServices->fetchAll(PDO::FETCH_ASSOC);
