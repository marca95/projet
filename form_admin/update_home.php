<?php

// Fetch articles
$fetchArticles = $pdo->prepare('SELECT * FROM articles');
$fetchArticles->execute();
$viewAllArticles = $fetchArticles->fetchAll(PDO::FETCH_ASSOC);

$updateMessage = '';

if (isset($_POST['updateHome'])) {
  $idHome = isset($_POST['habitat']) ? $_POST['habitat'] : '';
  $updateName = isset($_POST['update_name']) ? $_POST['update_name'] : '';
  $updateMainImg = isset($_FILES['main_image']['tmp_name']) ? $_FILES['main_image']['tmp_name'] : '';
  $updateSecondImg = isset($_FILES['second_image']['tmp_name']) ? $_FILES['second_image']['tmp_name'] : '';
  $updateMainTitle = isset($_POST['update_main_title']) ? $_POST['update_main_title'] : '';
  $updateSecondTitle = isset($_POST['update_second_title']) ? $_POST['update_second_title'] : '';
  $updateContent = isset($_POST['update_content']) ? $_POST['update_content'] : '';
  $updateThirdTitle = isset($_POST['update_third_title']) ? $_POST['update_third_title'] : '';

  if (!empty($updateName)) {
    $stmt = $pdo->prepare('UPDATE homes SET name = :updateName WHERE id_home = :idHome');
    $stmt->bindValue(':updateName', $updateName);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if ((!empty($updateMainImg)) && $_FILES['main_image']['error'] === 0) {
    $destinationMainImg = "../img/habitats/" . $_FILES['main_image']['name'];
    $stmt = $pdo->prepare('UPDATE homes SET main_root = :updateMainImg WHERE id_home = :idHome');
    $stmt->bindValue(':updateMainImg', $destinationMainImg);
    $stmt->bindValue(':idHome', $idHome);
    if (move_uploaded_file($updateMainImg, $destinationMainImg)) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if ((!empty($updateSecondImg)) && $_FILES['second_image']['error'] === 0) {
    $destinationSecondImg = "../img/habitats/" . $_FILES['second_image']['name'];
    $stmt = $pdo->prepare('UPDATE homes SET second_root = :updateSecondImg WHERE id_home = :idHome');
    $stmt->bindValue(':updateSecondImg', $destinationSecondImg);
    $stmt->bindValue(':idHome', $idHome);
    if (move_uploaded_file($updateSecondImg, $destinationSecondImg)) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if (!empty($updateMainTitle)) {
    $stmt = $pdo->prepare('UPDATE articles SET main_title = :updateMainTitle WHERE id_home = :idHome');
    $stmt->bindValue(':updateMainTitle', $updateMainTitle);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if (!empty($updateSecondTitle)) {
    $stmt = $pdo->prepare('UPDATE articles SET second_title = :updateSecondTitle WHERE id_home = :idHome');
    $stmt->bindValue(':updateSecondTitle', $updateSecondTitle);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if (!empty($updateContent)) {
    $stmt = $pdo->prepare('UPDATE articles SET content = :updateContent WHERE id_home = :idHome');
    $stmt->bindValue(':updateContent', $updateContent);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }
  if (!empty($updateThirdTitle)) {
    $stmt = $pdo->prepare('UPDATE articles SET third_title = :updateThirdTitle WHERE id_home = :idHome');
    $stmt->bindValue(':updateThirdTitle', $updateThirdTitle);
    $stmt->bindValue(':idHome', $idHome);
    $stmt->execute();
  }

  $updateMessage = 'Les données ont été modifiées avec succès.';
}
