<?php

$updateMessage = '';

if (isset($_POST['updateHome'])) {
  $idHome = isset($_POST['habitat']) ? htmlspecialchars($_POST['habitat']) : '';
  $updateName = isset($_POST['update_name']) ? htmlspecialchars($_POST['update_name']) : '';
  $updateMainImg = isset($_FILES['main_image']['tmp_name']) ? $_FILES['main_image']['tmp_name'] : '';
  $updateSecondImg = isset($_FILES['second_image']['tmp_name']) ? $_FILES['second_image']['tmp_name'] : '';
  $updateMainTitle = isset($_POST['update_main_title']) ? htmlspecialchars($_POST['update_main_title']) : '';
  $updateSecondTitle = isset($_POST['update_second_title']) ? htmlspecialchars($_POST['update_second_title']) : '';
  $updateContent = isset($_POST['update_content']) ? htmlspecialchars($_POST['update_content']) : '';
  $updateImgAccueil = isset($_FILES['update_img_accueil']['tmp_name']) ? $_FILES['update_img_accueil']['tmp_name'] : '';
  $updateCommonName = isset($_POST['update_common_name']) ? htmlspecialchars($_POST['update_common_name']) : '';

  // Fichier de max 2MB
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

  if (!empty($updateName)) {
    $stmt = $pdo->prepare('UPDATE homes SET name = :updateName WHERE id_home = :idHome');
    $stmt->bindValue(':updateName', $updateName);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if ((!empty($updateMainImg)) && $_FILES['main_image']['error'] === 0) {
    $destinationMainImg = "./img/habitats/" . $_FILES['main_image']['name'];
    $fileExtensionMainImg = strtolower(pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION));
    $stmt = $pdo->prepare('UPDATE homes SET main_root = :updateMainImg WHERE id_home = :idHome');
    $stmt->bindValue(':updateMainImg', $destinationMainImg);
    $stmt->bindValue(':idHome', $idHome);
    if (move_uploaded_file($updateMainImg, $destinationMainImg) && in_array($fileExtensionMainImg, $allowedExtensions) && $maxFileSize > $_FILES['main_image']['size']) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if ((!empty($updateSecondImg)) && $_FILES['second_image']['error'] === 0) {
    $destinationSecondImg = "./img/habitats/" . $_FILES['second_image']['name'];
    $fileExtensionSecondImg = strtolower(pathinfo($_FILES['second_image']['name'], PATHINFO_EXTENSION));
    $stmt = $pdo->prepare('UPDATE homes SET second_root = :updateSecondImg WHERE id_home = :idHome');
    $stmt->bindValue(':updateSecondImg', $destinationSecondImg);
    $stmt->bindValue(':idHome', $idHome);
    if (move_uploaded_file($updateSecondImg, $destinationSecondImg) && in_array($fileExtensionSecondImg, $allowedExtensions) && $maxFileSize > $_FILES['second_image']['size']) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if ((!empty($updateImgAccueil)) && $_FILES['update_img_accueil']['error'] === 0) {
    $destinationImgAccueil = "./img/accueil/" . $_FILES['update_img_accueil']['name'];
    $fileExtensionAccueilImg = strtolower(pathinfo($_FILES['update_img_accueil']['name'], PATHINFO_EXTENSION));
    $stmt = $pdo->prepare('UPDATE homes SET url_img_accueil = :url_img_accueil WHERE id_home = :idHome');
    $stmt->bindValue(':url_img_accueil', $destinationImgAccueil);
    $stmt->bindValue(':idHome', $idHome);
    if (move_uploaded_file($updateImgAccueil, $destinationImgAccueil)  && in_array($fileExtensionAccueilImg, $allowedExtensions) && $maxFileSize > $_FILES['update_img_accueil']['size']) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if (!empty($updateCommonName)) {
    $stmt = $pdo->prepare('UPDATE homes SET commonName = :commonName WHERE id_home = :idHome');
    $stmt->bindValue(':commonName', $updateCommonName);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if (!empty($updateSecondTitle)) {
    $stmt = $pdo->prepare('UPDATE homes SET second_title = :updateSecondTitle WHERE id_home = :idHome');
    $stmt->bindValue(':updateSecondTitle', $updateSecondTitle);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if (!empty($updateContent)) {
    $stmt = $pdo->prepare('UPDATE homes SET description = :updateContent WHERE id_home = :idHome');
    $stmt->bindValue(':updateContent', $updateContent);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }

  $updateMessage = 'Les données ont été modifiées avec succès.';
}
