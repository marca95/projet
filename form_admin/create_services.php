<?php

$messageCreate = "";

if (isset($_POST['createService']) && isset($_FILES['main_img']) && $_FILES['main_img']['error'] === 0 && isset($_FILES['link_img_root']) && $_FILES['link_img_root']['error'] === 0) {
  $mainTitle = isset($_POST['main_title']) ? $_POST['main_title'] : '';
  $secondTitle = isset($_POST['second_title']) ? $_POST['second_title'] : '';
  $mainImg = isset($_FILES['main_img']['tmp_name']) ? $_FILES['main_img']['tmp_name'] : '';
  $content = isset($_POST['content']) ? $_POST['content'] : '';
  $thirdTitle = isset($_POST['third_title']) ? $_POST['third_title'] : '';
  $secondContent = isset($_POST['second_content']) ? $_POST['second_content'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $btnLinkUrl = isset($_POST['btn_link_url']) ? $_POST['btn_link_url'] : '';
  $btnTitle = isset($_POST['title_btn']) ? $_POST['title_btn'] : '';
  $btnClass = isset($_POST['btn_classes']) ? $_POST['btn_classes'] : '';
  $linkUrl = isset($_POST['link_url']) ? $_POST['link_url'] : '';
  $linkImgRoot = isset($_FILES['link_img_root']['tmp_name']) ? $_FILES['link_img_root']['tmp_name'] : '';
  $linkClass = isset($_POST['link_classes']) ? $_POST['link_classes'] : '';

  $destinationMainImg = "../img/services/" . $_FILES['main_img']['name'];
  $destinationLinkImgRoot = "../img/services/" . $_FILES['link_img_root']['name'];

  $messageCreate = 'ok';

  if (empty($mainTitle) || empty($content) || empty($name)) {
    $messageCreate = 'Vous n\'avez pas rempli tous les champs.';
  } elseif (empty($mainImg)) {
    $messageCreate = 'Vous devez télécharger une image.';
  } else {
    $newServices = $pdo->prepare('INSERT INTO services(main_title, second_title, img_root, content, third_title, second_content, name, link_class, link_url, img_root_link, btn_class, btn_url, btn_title)
     VALUES (:main_title, :second_title, :img_root, :content, :third_title, :second_content, :name, :link_class, :link_url, :img_root_link, :btn_class, :btn_url, :btn_title)');
    $newServices->bindValue(':main_title', $mainTitle);
    $newServices->bindValue(':second_title', $secondTitle);
    $newServices->bindValue(':img_root', $destinationMainImg);
    $newServices->bindValue(':content', $content);
    $newServices->bindValue(':third_title', $thirdTitle);
    $newServices->bindValue(':second_content', $secondContent);
    $newServices->bindValue(':name', $name);
    $newServices->bindValue(':link_class', $linkClass);
    $newServices->bindValue(':link_url', $linkUrl);
    $newServices->bindValue(':img_root_link', $destinationLinkImgRoot);
    $newServices->bindValue(':btn_class', $btnClass);
    $newServices->bindValue(':btn_url', $btnLinkUrl);
    $newServices->bindValue(':btn_title', $btnTitle);
    if (move_uploaded_file($mainImg, $destinationMainImg) && move_uploaded_file($linkImgRoot, $destinationLinkImgRoot)) {
      if ($newServices->execute()) {
        $messageCreate = 'Nouveau service créé avec succès';
      } else {
        $messageCreate = "Erreur lors de l'insertion dans la base de données";
      }
    } else {
      $messageCreate = 'Erreur lors de la création du nouveau service.';
    }
  }
}
