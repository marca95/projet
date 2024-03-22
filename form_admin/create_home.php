<?php

if (isset($_POST['createNewHome']) && isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0 && isset($_FILES['second_img']) && $_FILES['second_img']['error'] === 0) {
  $name = $_POST['name'];
  $mainRoot = $_FILES['main_img']['tmp_name'];
  $secondRoot = $_FILES['second_img']['tmp_name'];
  $destinationMainImg = "../img/habitats/" . $_FILES['main_img']['name'];
  $destinationSecondImg = "../img/habitats/" . $_FILES['second_img']['name'];

  // Insert root img home
  $newImgHome = $pdo->prepare('INSERT INTO homes(name, main_root, second_root) VALUES (:name, :main_root, :second_root)');
  $newImgHome->bindValue(':name', $name);
  $newImgHome->bindValue(':main_root', $destinationMainImg);
  $newImgHome->bindValue(':second_root', $destinationSecondImg);

  if (move_uploaded_file($mainRoot, $destinationMainImg) && move_uploaded_file($secondRoot, $destinationSecondImg)) {
    if ($newImgHome->execute()) {
      echo 'Nouvelle habitation créée avec succès';
    } else {
      echo 'Erreur lors de la création de la nouvelle habitation';
    }
  } else {
    echo 'Erreur lors du téléchargement des images';
  }
}

// Fetch homes for options form
$fetchHomes = $pdo->prepare('SELECT * FROM homes');
$fetchHomes->execute();
$optionsHomes = $fetchHomes->fetchAll(PDO::FETCH_ASSOC);

// Soumisson form 
if (isset($_POST['createNewArticle'])) {
  $mainTitle = $_POST['main_title'];
  $secondTitle = $_POST['second_title'];
  $content = $_POST['content'];
  $optionsHome = $_POST['homes'];
  $thirdTitle = $_POST['third_title'];

  // Insert articles
  $addNewArticles = $pdo->prepare('INSERT INTO articles(main_title, second_title, content, id_home, third_title) VALUES (:main_title, :second_title, :content, :id_home, :third_title)');
  $addNewArticles->bindValue(':main_title', $mainTitle);
  $addNewArticles->bindValue(':second_title', $secondTitle);
  $addNewArticles->bindValue(':content', $content);
  $addNewArticles->bindValue(':id_home', $optionsHome);
  $addNewArticles->bindValue(':third_title', $thirdTitle);

  if ($addNewArticles->execute()) {
    echo 'Nouvel article ajouté avec succès';
  } else {
    echo 'Il y a eu un probleme lors de la création de l\'article';
  }
}
