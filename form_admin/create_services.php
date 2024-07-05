<?php

$messageCreate = "";

if (isset($_POST['createService']) && isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0) {
  $mainTitle = htmlspecialchars($_POST['main_title']);
  $secondTitle = isset($_POST['second_title']) ? htmlspecialchars($_POST['second_title']) : NULL;
  $content = htmlspecialchars($_POST['content']);
  $name = htmlspecialchars($_POST['name']);
  $btnLinkUrl = isset($_POST['btn_link_url']) ? htmlspecialchars($_POST['btn_link_url']) : NULL;
  $btnTitle = isset($_POST['title_btn']) ? htmlspecialchars($_POST['title_btn']) : NULL;
  $linkUrl = isset($_POST['link_url']) ? htmlspecialchars($_POST['link_url']) : NULL;

  $mainImg = $_FILES['main_img']['tmp_name'];
  $destinationMainImg = "./img/services/" . $_FILES['main_img']['name'];

  // Fichier de max 2MB
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

  // Vérification de la présence des champs obligatoires
  if (empty($mainTitle) || empty($content) || empty($name)) {
    $messageCreate = 'Vous n\'avez pas rempli tous les champs.';
  } elseif (empty($mainImg)) {
    $messageCreate = 'Vous devez télécharger une image principale.';
  } else {
    // Déplacement de l'image principale
    if (!move_uploaded_file($mainImg, $destinationMainImg)) {
      $messageCreate = 'Erreur lors du téléchargement de l\'image principale.';
    } else {
      // Validation de l'extension et de la taille de l'image principale
      $fileExtensionMainImg = strtolower(pathinfo($_FILES['main_img']['name'], PATHINFO_EXTENSION));

      if (!in_array($fileExtensionMainImg, $allowedExtensions)) {
        $messageCreate = "L'extension du fichier principal n'est pas autorisée.";
      } elseif ($_FILES['main_img']['size'] > $maxFileSize) {
        $messageCreate = "Fichier principal trop volumineux.";
      } else {
        $destinationLinkImgRoot = NULL;
        if (isset($_FILES['link_img_root']['tmp_name']) && $_FILES['link_img_root']['error'] === 0) {
          $linkImgRoot = $_FILES['link_img_root']['tmp_name'];
          $destinationLinkImgRoot = "./img/services/" . $_FILES['link_img_root']['name'];

          if (!move_uploaded_file($linkImgRoot, $destinationLinkImgRoot)) {
            $messageCreate = 'Erreur lors du téléchargement de l\'image secondaire.';
          } else {
            $fileExtensionLinkImg = strtolower(pathinfo($_FILES['link_img_root']['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtensionLinkImg, $allowedExtensions)) {
              $messageCreate = "L'extension du fichier secondaire n'est pas autorisée.";
            } elseif ($_FILES['link_img_root']['size'] > $maxFileSize) {
              $messageCreate = "Fichier secondaire trop volumineux.";
            }
          }
        }

        if (empty($messageCreate)) {
          $newServices = $pdo->prepare('INSERT INTO services(main_title, second_title, img_root, content, name, link_url, img_root_link, btn_url, btn_title)
                     VALUES (:main_title, :second_title, :img_root, :content, :name, :link_url, :img_root_link, :btn_url, :btn_title)');
          $newServices->bindValue(':main_title', $mainTitle);
          $newServices->bindValue(':second_title', $secondTitle);
          $newServices->bindValue(':img_root', $destinationMainImg);
          $newServices->bindValue(':content', $content);
          $newServices->bindValue(':name', $name);
          $newServices->bindValue(':link_url', $linkUrl);
          $newServices->bindValue(':img_root_link', $destinationLinkImgRoot);
          $newServices->bindValue(':btn_url', $btnLinkUrl);
          $newServices->bindValue(':btn_title', $btnTitle);

          if ($newServices->execute()) {
            $messageCreate = 'Nouveau service créé avec succès';
          } else {
            $messageCreate = "Erreur lors de l'insertion dans la base de données";
          }
        }
      }
    }
  }
}

// Create service accueil
$viewServices = $pdo->prepare('SELECT * FROM accueil_services');
$viewServices->execute();
$accueilServices = $viewServices->fetchAll(PDO::FETCH_ASSOC);

$messageCreateAccueil = '';

if (isset($_POST['createServiceAccueil']) && isset($_FILES['accueil_img1']) && $_FILES['accueil_img1']['error'] === 0 && isset($_FILES['accueil_img2']) && $_FILES['accueil_img2']['error'] === 0) {
  $accueilServiceId = isset($_POST['chooseService']) ? $_POST['chooseService'] : '';
  $accueilContent = isset($_POST['accueil_content']) ? $_POST['accueil_content'] : '';
  $accueilBtn = isset($_POST['accueil_btn']) ? $_POST['accueil_btn'] : '';

  $accueilImg1 = isset($_FILES['accueil_img1']['tmp_name']) ? $_FILES['accueil_img1']['tmp_name'] : '';
  $accueilImg2 = isset($_FILES['accueil_img2']['tmp_name']) ? $_FILES['accueil_img2']['tmp_name'] : '';

  $destinationAccueilImg1 = "./img/accueil/" . $_FILES['accueil_img1']['name'];
  $destinationAccueilImg2 = "./img/accueil/" . $_FILES['accueil_img2']['name'];

  // Fichier de max 2MB
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $fileExtensionAccueilImg1 = strtolower(pathinfo($_FILES['accueil_img1']['name'], PATHINFO_EXTENSION));
  $fileExtensionAccueilImg2 = strtolower(pathinfo($_FILES['accueil_img2']['name'], PATHINFO_EXTENSION));

  if (empty($accueilServiceId) || empty($accueilContent) || empty($accueilBtn)) {
    $messageCreateAccueil = 'Vous n\'avez pas rempli tous les champs.';
  } elseif (empty($accueilImg1) || empty($accueilImg2)) {
    $messageCreateAccueil = 'Vous devez télécharger une image.';
  } else {
    $newAccueilServices = $pdo->prepare('INSERT INTO accueil_services(id_service, content, img1, img2, title_btn) VALUES (:id_service, :content, :img1, :img2, :title_btn)');
    $newAccueilServices->bindValue(':id_service', $accueilServiceId);
    $newAccueilServices->bindValue(':content', $accueilContent);
    $newAccueilServices->bindValue(':img1', $destinationAccueilImg1);
    $newAccueilServices->bindValue(':img2', $destinationAccueilImg2);
    $newAccueilServices->bindValue(':title_btn', $accueilBtn);

    if (move_uploaded_file($accueilImg1, $destinationAccueilImg1) && move_uploaded_file($accueilImg2, $destinationAccueilImg2)) {
      if (in_array($fileExtensionAccueilImg1, $allowedExtensions) && in_array($fileExtensionAccueilImg2, $allowedExtensions)) {
        if ($maxFileSize > $_FILES['accueil_img1']['size'] && $maxFileSize > $_FILES['accueil_img2']['size']) {
          if ($newAccueilServices->execute()) {
            $messageCreateAccueil = "Nouveau service à la page d'accueil crée avec succès";
          } else {
            $messageCreateAccueil = "Erreur lors de l'insertion dans la base de données";
          }
        } else {
          $messageCreateAccueil = "Le fichier est trop volumineux";
        }
      } else {
        $messageCreateAccueil = "Extension du fichier non autorisé";
      }
    } else {
      $messageCreateAccueil = 'Erreur lors de l\'upload des images.';
    }
  }
}
