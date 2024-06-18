<?php
// btn logout session
if (isset($_POST['logout'])) {
  session_destroy();
  setcookie("id_user", "", time() - 3600, '', '', true, false);
  setcookie("username", "", time() - 3600, '', '', true, false);
  setcookie("token", "", time() - 3600, '', '', true, false);
  header("Location: connexion.php");
  exit();
}
