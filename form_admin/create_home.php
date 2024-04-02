<?php

// Fetch homes for options form and check if name home exist
$fetchHomes = $pdo->prepare('SELECT * FROM homes');
$fetchHomes->execute();
$optionsHomes = $fetchHomes->fetchAll(PDO::FETCH_ASSOC);

$messageCreate = '';

if (isset($_POST['createNewHome']) && isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0 && isset($_FILES['second_img']) && $_FILES['second_img']['error'] === 0) {
  $name = $_POST['name'];
  $mainRoot = $_FILES['main_img']['tmp_name'];
  $secondRoot = $_FILES['second_img']['tmp_name'];
  $imgAccueil = $_FILES['url_image_accueil']['tmp_name'];
  $commonName = $_POST['commonName'];
  $destinationMainImg = "../img/habitats/" . $_FILES['main_img']['name'];
  $destinationSecondImg = "../img/habitats/" . $_FILES['second_img']['name'];
  $destinatonImgAccueil = "../img/accueil/" . $_FILES['url_image_accueil']['name'];

  // Check if name exist (Unique in DB)
  $nameExists = false;
  foreach ($optionsHomes as $option) {
    if ($option['name'] === $name) {
      $nameExists = true;
      break;
    }
  }

  if (!$nameExists) {
    $newHome = $pdo->prepare('INSERT INTO homes(name, main_root, second_root, url_img_accueil, commonName) VALUES (:name, :main_root, :second_root, :url_img_accueil, :commonName)');
    $newHome->bindValue(':name', $name);
    $newHome->bindValue(':main_root', $destinationMainImg);
    $newHome->bindValue(':second_root', $destinationSecondImg);
    $newHome->bindValue(':url_img_accueil', $destinatonImgAccueil);
    $newHome->bindValue(':commonName', $commonName);

    if (move_uploaded_file($mainRoot, $destinationMainImg) && move_uploaded_file($secondRoot, $destinationSecondImg) && move_uploaded_file($imgAccueil, $destinatonImgAccueil)) {
      if ($newHome->execute()) {
        $messageCreate = 'Nouvelle habitation créée avec succès';
      } else {
        $messageCreate = 'Erreur lors de la création de la nouvelle habitation';
      }
    } else {
      $messageCreate = 'Erreur lors du téléchargement des images';
    }
  } else {
    $messageCreate = 'Nom déjà utilisé dans la base de données, veuillez changer le nom de l\habitation';
  }
}

// Soumisson form 

$messageArticle = '';

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
    $messageArticle = 'Nouvel article ajouté avec succès';
  } else {
    $messageArticle = 'Il y a eu un probleme lors de la création de l\'article';
  }
}
