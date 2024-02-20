<?php

if (isset($_POST['submit'])) {
  if ((empty($_POST['title'])) || (empty($_POST['email'])) || (empty($_POST['description']))) {
    echo "<p>Veuillez remplir les champs</p>";
  } else {
    echo 'reussite';
  }

  // $title = $_POST['title'];
  // $email = $_POST['email'];
  // $description = $_POST['description'];

  // $recipient = 'monzooarcadia@gmail.com';

  // $content = "<html><body><p>$title</p><p>$email</p><p>$description</p></body></html>";
  // $headers = "From: " . $recipient . "\n";
  // Concat headers + content-type: text say adress mail read like html
  // $headers .= "Content-type:text/html; charset='UTF-8'";

  // mail($recipient, $title, $content, $headers);

  // echo '<p>Votre message à bien été envoyé !</p>';
} else {
  die; // A Checker else if else..
};
