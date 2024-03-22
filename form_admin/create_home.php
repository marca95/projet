<?php

// Insert root img home
$newImgHome = $pdo->prepare('INSERT INTO homes(name, main_root, second_root) VALUES(:name, :main_root, :second_root');
$newImgHome->bindValue(':name', $name);
$newImgHome->bindValue(':main_root', $mainRoot);
$newImgHome->bindValue(':second_root', $secondRoot);

// Insert articles
$addNewArticles = $pdo->prepare('INSERT INTO articles(main_title, second_title, content, third_title) VALUES (:main_title, :second_title, :content, :third_title');
$addNewArticles->bindValue(':main_title', $mainTitle);
$addNewArticles->bindValue(':second_title', $secondTitle);
$addNewArticles->bindValue(':content', $content);
$addNewArticles->bindValue(':third_title', $thirdTitle);


if (isset($_POST['createNewHome'])) {
  $name = $_POST['name'];
  $mainRoot = $_POST['main_root'];
  $secondRoot = $_POST['second_root'];
  $mainTitle = $_POST['main_title'];
  $secondTitle = $_POST['second_title'];
  $content = $_POST['content'];
  $thirdTitle = $_POST['third_title'];
}
