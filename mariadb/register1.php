<?php

require '../php_mailer/register.php';

// Create registration form
if (isset($_POST['inscription'])) {
  // Check DB only one unique username
  $onlyOneUsername = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $onlyOneUsername->execute(['username' => $_POST['username']]);
  $oneUsername = $onlyOneUsername->rowCount();
  // Check DB only one unique mail
  $onlyOneEmail = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $onlyOneEmail->execute(['email' => $_POST['email']]);
  $oneEmail = $onlyOneEmail->rowCount();

  if ($oneUsername > 0) {
    $error = 'Username déjà existant dans la base de données.';
  } else if ($oneEmail > 0) {
    $error = 'Email déja existant dans la base de données.';
  } else {
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $id_role = $_POST['id_role'];
    $birthday = $_POST['birthday'];
    $hire = $_POST['hire'];

    $userOnlyAdmin = $pdo->prepare('SELECT COUNT(*) FROM users WHERE id_role = 1');
    $userOnlyAdmin->execute();
    $count = $userOnlyAdmin->fetchColumn();

    if ($id_role == 1 && $count > 0) {
      $error = 'Il ne peut y avoir qu\'un seul administrateur.';
    } else {
      $request = $pdo->prepare('INSERT INTO users(name, first_name, username, email, password, id_role, birthday, hire) VALUES (:name, :first_name, :username, :email, :password, :id_role, :birthday, :hire)');
      $request->execute(
        array(
          'name' => $name,
          'first_name' => $first_name,
          'username' => $username,
          'email' => $email,
          'password' => $password,
          'id_role' => $id_role,
          'birthday' => $birthday,
          'hire' => $hire
        )
      );
      $successSignUp = 'Inscription réussie.';

      // send mail for username and password
      $subject = 'Données du nouveau compte chez Arcadia';
      $contentEmail = "Nom: $name\n";
      $contentEmail .= "Prénom: $first_name\n";
      $contentEmail .= "Username: $username\n";
      $contentEmail .= "Role: $id_role\n";
      $contentEmail .= "Date d'anniversaire: $birthday\n";
      $contentEmail .= "Engagé(e) le: $hire\n";
      $contentEmail .= "Pour le mot de passe, veuillez vous adressez au directeur du zoo.\n";
    }
  }
}
