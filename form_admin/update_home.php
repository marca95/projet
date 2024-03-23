<?php

// Fetch articles
$fetchArticles = $pdo->prepare('SELECT * FROM articles');
$fetchArticles->execute();
$viewAllArticles = $fetchArticles->fetchAll(PDO::FETCH_ASSOC);

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
    $stmt->execute();
    if (move_uploaded_file($updateMainImg, $destinationMainImg)) {
      echo 'Succès';
    } else {
      echo 'Il y a eu un problème lors du téléchargement de l\'image.';
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
      echo 'Il y a eu un problème lors du téléchargement de l\'image.';
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

  echo 'Les données ont été modifiées avec succès.';
}
  // if (empty($updateValue)) {
  //   echo 'Aucune valeur n\'a été remplie.';
  // } else {
  //   echo $updateValue;
  // }

  // if (isset($idHome) && isset($updateName) || isset($updateMainImg) || isset($updateSecondImg)) {
  //   $stmt = $pdo->prepare('UPDATE homes SET name = :updateName, main_root = :updateMainImg, second_root = :updateSecondImg WHERE id_home = :idHome');
  //   $stmt->bindValue("updateName", $updateName);
  //   $stmt->bindValue("updateMainImg", $updateMainImg);
  //   $stmt->bindValue("updateSecondImg", $updateSecondImg);
  //   $stmt->bindValue("idHome", $idHome);

  //   if ($stmt->execute()) {
  //     echo 'Les données ont été modifiés avec succès !';
  //   } else {
  //     echo 'Erreur lors de la modification de l\'habitation.';
  //   }
  // }

  // if (isset($idHome) && isset($updateMainTitle) || isset($updateSecondTitle) || isset($updateContent) || isset($updateThirdTitle)) {
  //   $stmt = $pdo->prepare('UPDATE articles SET main_title = :mainTitle, second_title = secondTitle, content = :content, id_home = :idHome, third_title = :thirdTitle');
  //   $stmt->bindValue("mainTitle", $updateMainTitle);
  //   $stmt->bindValue("secondTitle", $updateSecondTitle);
  //   $stmt->bindValue("content", $updateContent);
  //   $stmt->bindValue("thirdTitle", $updateThirdTitle);
  //   $stmt->bindValue("idHome", $idHome);
  // }
  // if ($stmt->execute()) {
  //   echo 'Les données ont été modifiés avec succès !';
  // } else {
  //   echo 'Erreur lors de la modification de l\'article.';
  // }





  // $noEmpty = [];
  // if (!empty($idHome)) {
  //   $noEmpty['idHome'] = $idHome;
  // }
  // if (!empty($updateName)) {
  //   $noEmpty['updateName'] = $updateName;
  // }
  // if (!empty($updateMainImg)) {
  //   $noEmpty['updateMainImg'] = $updateMainImg;
  // }
  // if (!empty($updateSecondImg)) {
  //   $noEmpty['updateSecondImg'] = $updateSecondImg;
  // }
  // if (!empty($updateMainTitle)) {
  //   $noEmpty['updateMainTitle'] = $updateMainTitle;
  // }
  // if (!empty($updateSecondTitle)) {
  //   $noEmpty['updateSecondTitle'] = $updateSecondTitle;
  // }
  // if (!empty($updateContent)) {
  //   $noEmpty['updateContent'] = $updateContent;
  // }
  // if (!empty($updateThirdTitle)) {
  //   $noEmpty['updateThirdTitle'] = $updateThirdTitle;
  // }