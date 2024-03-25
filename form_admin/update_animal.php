<?php

// Fetch animals
$recupAnimals = $pdo->prepare('SELECT * FROM animals');
$recupAnimals->execute();
$viewAllAnimals = $recupAnimals->fetchAll(PDO::FETCH_ASSOC);

// 
