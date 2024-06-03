<?php

// Check if user is already logged in 
if (isset($_SESSION['id_user'])) {

  switch ($_SESSION['id_role']) {
    case 1:
      header("Location: administrateur.php");
      exit();
    case 2:
      header("Location: veterinaire.php");
      exit();
    case 3:
      header("Location: employe.php");
      exit();
    default:
      header("Location: accueil.html");
      exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  if ($username !== ""  && $password !== "") {
    $request = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $request->execute(array(':username' => $username));
    $response = $request->fetch();
    if ($response && password_verify($password, $response['password'])) {
      $_SESSION['id_role'] = $response['id_role'];
      $_SESSION['id_user'] = $response['id_user'];
      $_SESSION['first_name_user'] = $response['first_name'];
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      switch ($_SESSION['id_role']) {
        case 1:
          header("Location: administrateur.php");
          break;
        case 2:
          header("Location: veterinaire.php");
          break;
        case 3:
          header("Location: employe.php");
          break;
        default:
          header("Location: accueil.html");
          break;
      }
      exit();
    } else {
      $errorCon = 'Erreur dans le mot de passe ou votre adresse mail.';
    }
  } else {
    $errorCon = "Vous n'avez pas entrez d'adresse mail ou de mot de passe.";
  }
}
