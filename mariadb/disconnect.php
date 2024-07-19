<?php
// btn logout session
if (isset($_POST['logout'])) {
  session_destroy();
  setcookie("Prénom", "", time() - 3600, '/', 'zoo-arcadia-2024-7efa0677447b.herokuapp.com', true, true);
  header("Location: connexion.php");
  exit();
}
