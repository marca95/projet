
<?php

function getServices($pdo)
{
  $itemsServices = 'SELECT 
  main_title, 
  second_title, 
  img_root AS main_img, 
  content, 
  third_title, 
  second_content, 
  NAME AS name, 
  link_class,
  link_url, 
  img_root_link, 
  btn_class, 
  btn_url, 
  btn_title
FROM 
  services';
  $stmt = $pdo->prepare($itemsServices);
  $stmt->execute();
  $serviceData = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $serviceData;
}

$services = getServices($pdo);
