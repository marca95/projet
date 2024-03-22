<?php

// Fetch articles
$fetchArticles = $pdo->prepare('SELECT * FROM articles');
$fetchArticles->execute();
$viewAllArticles = $fetchArticles->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['updateHome'])) {
  $idHome = $_POST['habitat'];
  $updateName = $_POST['update_name'];
  $updateMainImg = $_POST['main_image'];
  $updateSecondImg = $_POST['second_image'];
  $updateMainTitle = $_POST['update_main_title'];
  $updateSecondTitle = $_POST['update_second_title'];
  $updateContent = $_POST['update_content'];
  $updateThirdTitle = $_POST['update_third_title'];
}
