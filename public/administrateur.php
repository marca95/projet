<?php
session_start();

require_once '../mariadb/connect.php';
require_once '../mariadb/login.php';
require_once '../mariadb/set_hours.php';
require_once '../mariadb/disconnect.php';
require_once '../mariadb/register.php';

?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo d'Arcadia en Bretagne</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./style/css/administrateur.css" rel="stylesheet">
  <link href="./style/font/font.css" rel="stylesheet">
  <link href="./img/accueil/logo.png" rel="icon">
</head>

<body>
  <header>
    <nav id="nav">
      <div id="icon"></div>
      <ul class="navigation">
        <li><a href="./admin_animal.php">Animaux</a></li>
        <li><a href="./admin_home.php">Habitations</a></li>
        <li><a href="./admin_services.php">Services</a></li>
        <li><a href="./admin_reports.php">Comptes rendus</a></li>
        <li><a href="./admin_dashboard.php">Dashboard</a></li>
        <li><a href="./index.php">Site officiel</a></li>
      </ul>
      <form method="POST" action="" class="form_logout">
        <button type="submit" name="logout" class="logout" title="déconnexion"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width='25px'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
          </svg></button>
      </form>
    </nav>
  </header>
  <h1>Bonjour <?php echo $_SESSION['first_name_user'] ?> </h1>
  <!-- AJOUTER EMAIL PRIVE A LA BASE DE DONNEES  -->
  <section class="register">
    <h3>Enregistrer un nouveau membre :</h3>

    <form method="POST" action="" id="form" class="form_register">
      <label for="name">Nom :</label> <br />
      <input type="text" name="name" id="name" oninput="clearSuccess()" maxlength="50" required>
      <br />
      <label for="first_name">Prénom :</label><br />
      <input type="text" name="first_name" id="first_name" oninput="clearSuccess()" maxlength="50" required>
      <br />
      <label for="email">E-mail (Privé) :</label><br />
      <input type="email" name="email" id="email" oninput="clearSuccess()" maxlength="50" required>
      <br />
      <label for="username">Username :</label><br />
      <input type="email" name="username" id="username" oninput="clearSuccess()" maxlength="50" required>
      <br />
      <label for="password">Mot de passe :</label><br />
      <input type="password" name="password" id="password" oninput="clearSuccess()" maxlength="100" required>
      <br />
      <label for="password2">Vérification du mot de passe :</label><br />
      <input type="password" name="password2" id="password2" oninput="clearSuccess()" maxlength="100" required>
      <br />
      <label for="id_role">Role :</label><br />
      <label>
        <input type="radio" name="id_role" value="2" required> Vétérinaire
      </label>
      <label>
        <input type="radio" name="id_role" value="3" required> Employé(e)
      </label>
      <br />
      <label for="birthday">Anniversaire :</label><br />
      <input type="date" name="birthday" id="birthday" oninput="clearSuccess()" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy" required>
      <br />
      <label for="hire">Engagé(e) :</label><br />
      <input type="date" name="hire" id="hire" oninput="clearSuccess()" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy" required>
      <p id="errorInput"></p>
      <br />
      <?php if (isset($successSignUp) && !empty($successSignUp)) : ?>
        <p id="success">
          <?php
          echo $successSignUp . ' ' . $successMail;
          ?></p>
      <?php endif; ?>
      <?php if (isset($error) && !empty($error)) : ?>
        <p id="error">
          <?php
          echo $error;
          ?></p>
      <?php endif; ?>
      <button type="submit" name="inscription" class="btn_inscription">Inscription</button>
      <br />
    </form>
  </section>

  <section class="remove">
    <h3>Supprimer un membre :</h3>
    <form method="POST" action="" class="remove_user" onsubmit="return confirmDelete()">
      <label for="user"></label>
      <table>
        <thead>
          <tr>
            <th class="org">Nom</th>
            <th class="org">Prénom</th>
            <th class="org mail">Adresse mail</th>
            <th class="org">Choix</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td class="design"><?php echo htmlspecialchars($user['name']); ?></td>
              <td class="design"><?php echo htmlspecialchars($user['first_name']); ?></td>
              <td class="design mail"><?php echo htmlspecialchars($user['username']); ?></td>
              <td class="design">
                <input type="radio" name="user" value="<?php echo htmlspecialchars($user['id_user']); ?>">
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="submit" name="delete" class="btn_inscription btn_delete">Supprimer</button>
      <?php if (isset($succesDelete) && !empty($succesDelete)) : ?>
        <p id="successHour">
          <?php
          echo $succesDelete;
          ?></p>
      <?php endif; ?>
    </form>
  </section>

  <section class="setHours">
    <h3>Modification des horaires</h3>

    <div class="day_week">
      <?php
      if ($sethoraires) {
        foreach ($sethoraires as $sethoraire) {
          $setDay = $sethoraire['day_week'];
          $setIsClosed = $sethoraire['is_closed'];
          $setStartTime = $sethoraire['start_time'];
          $setEndTime = $sethoraire['end_time'];

          echo "<li>$setDay : ";
          echo $setIsClosed ? 'Fermé' : "$setStartTime à $setEndTime";
          echo '</li>';
        }
      } else {
        echo "Aucun horaire trouvé.";
      }
      ?>
    </div>

    <form action="" method="POST" class="form_hour">

      <label for="mondayClosed">Le lundi est :</label>
      <select type="text" name="mondayClosed" id="mondayClosed">
        <option value="0" <?php echo ($sethoraires[0]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[0]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="mondayStart">Ouverture à :</label>
      <input type="text" name="mondayStart" id="mondayStart" <?php echo ($sethoraires[0]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[0]['start_time'] . '"'; ?>>
      <label for=" mondayEnd">Fermeture à :</label>
      <input type="text" name="mondayEnd" id="mondayEnd" <?php echo ($sethoraires[0]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[0]['end_time'] . '"'; ?>>
      <br />
      <label for="tuesdayClosed">Le mardi est :</label>
      <select type="text" name="tuesdayClosed" id="tuesdayClosed">
        <option value="0" <?php echo ($sethoraires[1]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[1]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="tuesdayStart">Ouverture à :</label>
      <input type="text" name="tuesdayStart" id="tuesdayStart" <?php echo ($sethoraires[1]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[1]['start_time'] . '"'; ?>>
      <label for=" tuesdayEnd">Fermeture à :</label>
      <input type="text" name="tuesdayEnd" id="tuesdayEnd" <?php echo ($sethoraires[1]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[1]['end_time'] . '"'; ?>>
      <br />
      <label for="wednesdayClosed">Le mercredi est :</label>
      <select type="text" name="wednesdayClosed" id="wednesdayClosed">
        <option value="0" <?php echo ($sethoraires[2]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[2]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="wednesdayStart">Ouverture à :</label>
      <input type="text" name="wednesdayStart" id="wednesdayStart" <?php echo ($sethoraires[2]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[2]['start_time'] . '"'; ?>>
      <label for=" wednesdayEnd">Fermeture à :</label>
      <input type="text" name="wednesdayEnd" id="wednesdayEnd" <?php echo ($sethoraires[2]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[2]['end_time'] . '"'; ?>>
      <br />
      <label for="thursdayClosed">Le jeudi est :</label>
      <select type="text" name="thursdayClosed" id="thursdayClosed">
        <option value="0" <?php echo ($sethoraires[3]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[3]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="thursdayStart">Ouverture à :</label>
      <input type="text" name="thursdayStart" id="thursdayStart" <?php echo ($sethoraires[3]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[3]['start_time'] . '"'; ?>>
      <label for="thursdayEnd">Fermeture à :</label>
      <input type="text" name="thursdayEnd" id="thursdayEnd" <?php echo ($sethoraires[3]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[3]['end_time'] . '"'; ?>>
      <br />
      <label for="fridayClosed">Le vendredi est :</label>
      <select type="text" name="fridayClosed" id="fridayClosed">
        <option value="0" <?php echo ($sethoraires[4]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[4]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="fridayStart">Ouverture à :</label>
      <input type="text" name="fridayStart" id="fridayStart" <?php echo ($sethoraires[4]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[4]['start_time'] . '"'; ?>>
      <label for=" fridayEnd">Fermeture à :</label>
      <input type="text" name="fridayEnd" id="fridayEnd" <?php echo ($sethoraires[4]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[4]['end_time'] . '"'; ?>>
      <br />
      <label for="saturdayClosed">Le samedi est :</label>
      <select type="text" name="saturdayClosed" id="saturdayClosed">
        <option value="0" <?php echo ($sethoraires[5]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[5]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="saturdayStart">Ouverture à :</label>
      <input type="text" name="saturdayStart" id="saturdayStart" <?php echo ($sethoraires[5]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[5]['start_time'] . '"'; ?>>
      <label for=" saturdayEnd">Fermeture à :</label>
      <input type="text" name="saturdayEnd" id="saturdayEnd" <?php echo ($sethoraires[5]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[5]['end_time'] . '"'; ?>>
      <br />
      <label for="sundayClosed">Le dimanche est :</label>
      <select type="text" name="sundayClosed" id="sundayClosed">
        <option value="0" <?php echo ($sethoraires[6]['is_closed'] === 0) ? 'selected' : ''; ?>>Ouvert</option>
        <option value="1" <?php echo ($sethoraires[6]['is_closed'] === 1) ? 'selected' : ''; ?>>Fermé</option>
      </select>
      <br />
      <label for="sundayStart">Ouverture à :</label>
      <input type="text" name="sundayStart" id="sundayStart" <?php echo ($sethoraires[6]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[6]['start_time'] . '"'; ?>>
      <label for="sundayEnd">Fermeture à :</label>
      <input type="text" name="sundayEnd" id="sundayEnd" <?php echo ($sethoraires[6]['is_closed'] === 1) ? 'value=""' : 'value="' . $sethoraires[6]['end_time'] . '"'; ?>>
      <br />
      <?php if (isset($succesHour) && !empty($succesHour)) : ?>
        <p id="successHour">
          <?php
          echo $succesHour;
          ?></p>
      <?php endif; ?>
      <button type="submit" name="setHours" class="btn_inscription">Enregistrer les modifications</button>
    </form>
  </section>
  <script src="./js/admin.js"></script>
</body>

</html>