<?php

// Fetch option form for articles and add inner join home
$fetchArticles = $pdo->prepare('SELECT * FROM articles INNER JOIN homes ON articles.id_home = homes.id_home');
$fetchArticles->execute();
$Articles = $fetchArticles->fetchAll(PDO::FETCH_ASSOC);
