<?php

$viewServices = $pdo->prepare('SELECT * FROM services');
$viewServices->execute();
$viewService = $viewServices->fetchAll(PDO::FETCH_ASSOC);


$updateMessage = '';

if (isset($_POST['updateService'])) {
  $selectedService = isset($_POST['selectedService']) ? $_POST['selectedService'] : '';

  $mainTitle = isset($_POST['update_main_title']) ? htmlspecialchars($_POST['update_main_title']) : '';
  $secondTitle = isset($_POST['update_second_title']) ? htmlspecialchars($_POST['update_second_title']) : '';
  $mainImg = isset($_FILES['update_main_img']['tmp_name']) ? $_FILES['update_main_img']['tmp_name'] : '';
  $content = isset($_POST['update_main_content']) ? htmlspecialchars($_POST['update_main_content']) : '';
  $thirdTitle = isset($_POST['update_third_title']) ? htmlspecialchars($_POST['update_third_title']) : '';
  $secondContent = isset($_POST['update_second_content']) ? htmlspecialchars($_POST['update_second_content']) : '';
  $name = isset($_POST['update_name']) ? htmlspecialchars($_POST['update_name']) : '';
  $btnLinkUrl = isset($_POST['update_url_btn']) ? htmlspecialchars($_POST['update_url_btn']) : '';
  $btnTitle = isset($_POST['update_title_btn']) ? htmlspecialchars($_POST['update_title_btn']) : '';
  $btnClass = isset($_POST['update_class_btn']) ? htmlspecialchars($_POST['update_class_btn']) : '';
  $linkUrl = isset($_POST['update_url_link']) ? htmlspecialchars($_POST['update_url_link']) : '';
  $linkImgRoot = isset($_FILES['update_img_link']['tmp_name']) ? $_FILES['update_img_link']['tmp_name'] : '';
  $linkClass = isset($_POST['update_class_link']) ? htmlspecialchars($_POST['update_class_link']) : '';

  if (!empty($mainTitle)) {
    $stmt = $pdo->prepare('UPDATE services SET main_title = :main_title WHERE id_service = :id_service');
    $stmt->bindValue(':main_title', $mainTitle);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($secondTitle)) {
    $stmt = $pdo->prepare('UPDATE services SET second_title = :second_title WHERE id_service = :id_service');
    $stmt->bindValue(':second_title', $secondTitle);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($mainImg)) {
    $destinationMainImg = "./img/services/" . $_FILES['update_main_img']['name'];
    $stmt = $pdo->prepare('UPDATE services SET img_root = :img_root WHERE id_service = :id_service');
    $stmt->bindValue(':img_root', $destinationMainImg);
    $stmt->bindValue(':id_service', $selectedService);
    if (move_uploaded_file($mainImg, $destinationMainImg)) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if (!empty($content)) {
    $stmt = $pdo->prepare('UPDATE services SET content = :content WHERE id_service = :id_service');
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($thirdTitle)) {
    $stmt = $pdo->prepare('UPDATE services SET third_title = :third_title WHERE id_service = :id_service');
    $stmt->bindValue(':third_title', $thirdTitle);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($secondContent)) {
    $stmt = $pdo->prepare('UPDATE services SET second_content = :second_content WHERE id_service = :id_service');
    $stmt->bindValue(':second_content', $secondContent);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($name)) {
    $stmt = $pdo->prepare('UPDATE services SET name = :name WHERE id_service = :id_service');
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($btnLinkUrl)) {
    $stmt = $pdo->prepare('UPDATE services SET btn_url = :btn_url WHERE id_service = :id_service');
    $stmt->bindValue(':btn_url', $btnLinkUrl);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($btnTitle)) {
    $stmt = $pdo->prepare('UPDATE services SET btn_title = :btn_title WHERE id_service = :id_service');
    $stmt->bindValue(':btn_title', $btnTitle);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($btnClass)) {
    $stmt = $pdo->prepare('UPDATE services SET btn_class = :btn_class WHERE id_service = :id_service');
    $stmt->bindValue(':btn_class', $btnClass);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($linkUrl)) {
    $stmt = $pdo->prepare('UPDATE services SET link_url = :link_url WHERE id_service = :id_service');
    $stmt->bindValue(':link_url', $linkUrl);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  if (!empty($linkImgRoot)) {
    $destinationLinkImgRoot = "./img/services/" . $_FILES['update_img_link']['name'];
    $stmt = $pdo->prepare('UPDATE services SET img_root_link = :img_root_link WHERE id_service = :id_service');
    $stmt->bindValue(':img_root_link', $destinationLinkImgRoot);
    $stmt->bindValue(':id_service', $selectedService);
    if (move_uploaded_file($linkImgRoot, $destinationLinkImgRoot)) {
      $stmt->execute();
    } else {
      $updateMessage = 'Il y a eu un problème lors du téléchargement de l\'image.';
    }
  }
  if (!empty($linkClass)) {
    $stmt = $pdo->prepare('UPDATE services SET link_class = :link_class WHERE id_service = :id_service');
    $stmt->bindValue(':link_class', $linkClass);
    $stmt->bindValue(':id_service', $selectedService);
    $stmt->execute();
  }
  $updateMessage = "Modification éffectuée avec succès";
}
