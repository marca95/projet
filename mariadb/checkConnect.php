<?php
// Check if user is already logged in 
if (isset($_SESSION['first_name_user'], $_SESSION['token'])) {
  $token = $_SESSION['token'];
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

      $token = bin2hex(random_bytes(32));

      $updateToken = $pdo->prepare("UPDATE users SET token = :token WHERE username = :username");
      $updateToken->execute(array(':token' => $token, ':username' => $username));

      setcookie("id_user", $response['id_user'], time() + 3600, '', '', true, false);
      setcookie("username", $username, time() + 3600, '', '', true, false);
      //  true for httponly and Secure (max security)
      //  Laisser Secure a false sinon je ne sais pas récuperer mes cookies pour recuperer l'id des membres lors de la 
      //  soumission du formulaire
      setcookie("token", $token, time() + 3600, '', '', true, false);

      $_SESSION['id_role'] = $response['id_role'];
      $_SESSION['id_user'] = $response['id_user'];
      $_SESSION['first_name_user'] = $response['first_name'];
      $_SESSION['token'] = $token;

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
