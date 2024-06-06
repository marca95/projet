<?php
// Login session 

// $request = $pdo->prepare('SELECT * FROM users WHERE id_role = 1');
// $request->execute();
// $user = $request->fetch();
// if (
//   isset($_SESSION['id_role'], $_SESSION['first_name_user'], $_SESSION['id_user'], $_SESSION['token']) &&
//   $_SESSION['id_role'] == 1 &&
//   $_SESSION['first_name_user'] == $user['first_name_user'] &&
//   $_SESSION['token'] == $user['token']
// ) {
// } else {
//   header("Location: connexion.php");
//   exit();
// }

// session_start();

// if (
//   isset($_SESSION['id_role'], $_SESSION['first_name_user'], $_SESSION['id_user'], $_SESSION['token']) &&
//   $_SESSION['id_role'] == 1

// ) {
//   $request = $pdo->prepare('SELECT * FROM users WHERE id_user = :id_user AND id_role = 1');
//   $request->execute(array(':id_user' => $_SESSION['id_user']));
//   $user = $request->fetch();

//   if ($user && $_SESSION['first_name_user'] == $user['first_name_user'] && $_SESSION['token'] == $user['token']) {
//     // Admin verification successful
//   } else {
//     header("Location: connexion.php");
//     exit();
//   }
// } else {
//   header("Location: connexion.php");
//   exit();
// }
