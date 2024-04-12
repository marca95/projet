<?php

$viewsavis = $pdo->prepare('SELECT * FROM avis');
$viewsavis->execute();
$avisPending = $viewsavis->fetchAll(PDO::FETCH_ASSOC);

$avisPublished = $pdo->prepare("SELECT first_name, content FROM avis WHERE status = 'published'");
$avisPublished->execute();
$allAvis = $avisPublished->fetchAll(PDO::FETCH_ASSOC);
