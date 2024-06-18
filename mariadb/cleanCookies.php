<?php

$current_time = time();

// Liste des noms de cookies à nettoyer
$cookies_to_clean = ['id_user', 'username', 'token'];

foreach ($cookies_to_clean as $cookie_name) {
  if (isset($_COOKIE[$cookie_name])) {
    $cookie_expiration = $_COOKIE[$cookie_name];


    if ($cookie_expiration < $current_time) {
      setcookie($cookie_name, '', time() - 3600, '/', '', true, true);
    }
  }
}
