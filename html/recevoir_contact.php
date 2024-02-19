<?php

if (isset($_POST['submit'])) {
  if ((empty($_POST['title'])) || (empty($_POST['email'])) || (empty($_POST['description']))) {
    echo "<p>Veuillez remplir les champs</p>";
  }
};
