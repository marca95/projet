<?php

// Fetch homes for options form and check if name home exist
require_once '../mariadb/homes.php';

$messageCreate = '';

if (isset($_POST['createNewHome']) && isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0 && isset($_FILES['second_img']) && $_FILES['second_img']['error'] === 0) {
  $name = htmlspecialchars($_POST['name']);
  $secondTitle = htmlspecialchars($_POST['second_title']);
  $content = htmlspecialchars($_POST['description']);
  $mainRoot = $_FILES['main_img']['tmp_name'];
  $secondRoot = $_FILES['second_img']['tmp_name'];
  $imgAccueil = $_FILES['url_image_accueil']['tmp_name'];
  $commonName = htmlspecialchars($_POST['commonName']);
  $destinationMainImg = "./img/habitats/" . $_FILES['main_img']['name'];
  $destinationSecondImg = "./img/habitats/" . $_FILES['second_img']['name'];
  $destinatonImgAccueil = "./img/accueil/" . $_FILES['url_image_accueil']['name'];

  // Check if name exist (Unique in DB)
  $nameExists = false;
  foreach ($homes as $home) {
    if ($home['name'] === $name) {
      $nameExists = true;
      break;
    }
  }

  if (!$nameExists) {
    $newHome = $pdo->prepare('INSERT INTO homes(name, description, main_root, second_root, url_img_accueil, commonName, second_title) VALUES (:name, :description, :main_root, :second_root, :url_img_accueil, :commonName, :second_title)');
    $newHome->bindValue(':name', $name);
    $newHome->bindValue(':description', $content);
    $newHome->bindValue(':main_root', $destinationMainImg);
    $newHome->bindValue(':second_root', $destinationSecondImg);
    $newHome->bindValue(':url_img_accueil', $destinatonImgAccueil);
    $newHome->bindValue(':commonName', $commonName);
    $newHome->bindValue(':second_title', $secondTitle);

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
    $messageCreate = "Nom déjà utilisé dans la base de données, veuillez changer le nom de l'habitation";
  }
}
