<?php
// btn logout session
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: connexion.php");
  exit();
}
