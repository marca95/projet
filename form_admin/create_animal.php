<?php

// Fetch option form for homes
$recupHomes = $pdo->prepare('SELECT * FROM homes');
$recupHomes->execute();
$optionsHomes = $recupHomes->fetchAll(PDO::FETCH_ASSOC);

// Fetch option form for locations
$recuplocations = $pdo->prepare('SELECT * FROM locations');
$recuplocations->execute();
$optionsLocations = $recuplocations->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST['createNewAnimal']) && isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
  $messageAnimal = '';

  // Récupération et nettoyage des données utilisateur
  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $type = htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8');
  $race = htmlspecialchars($_POST['race'], ENT_QUOTES, 'UTF-8');
  $location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');
  $home = htmlspecialchars($_POST['home'], ENT_QUOTES, 'UTF-8');
  $commonName = htmlspecialchars($_POST['commonName'], ENT_QUOTES, 'UTF-8');

  $imgRoot = $_FILES['upload']['tmp_name'];
  $fileName = basename($_FILES['upload']['name']);
  $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

  $uniqueFileName = uniqid() . '.' . $fileExtension;
  $destination = "./img/habitats/" . $uniqueFileName;

  // Taille maximale du fichier (2MB)
  $maxFileSize = 2 * 1024 * 1024;
  if ($_FILES['upload']['size'] > $maxFileSize) {
    $messageAnimal = "Fichier trop volumineux.";
  } else {
    // Extensions autorisées
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileExtension, $allowedExtensions)) {
      $messageAnimal = "Extension de fichier non autorisée.";
    } else {
      // Vérification du type MIME du fichier pour plus de sécurité
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mimeType = finfo_file($finfo, $imgRoot);
      finfo_close($finfo);

      if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
        $messageAnimal = "Le type MIME du fichier n'est pas autorisé.";
      } else {
        // Validation des IDs `location` et `home` avant insertion
        $stmtLocation = $pdo->prepare("SELECT COUNT(*) FROM locations WHERE id_location = :id_location");
        $stmtLocation->execute([':id_location' => $location]);
        $stmtHome = $pdo->prepare("SELECT COUNT(*) FROM homes WHERE id_home = :id_home");
        $stmtHome->execute([':id_home' => $home]);

        if ($stmtLocation->fetchColumn() == 0) {
          $messageAnimal = "La localisation sélectionnée est invalide.";
        } elseif ($stmtHome->fetchColumn() == 0) {
          $messageAnimal = "La maison sélectionnée est invalide.";
        } else {
          // Déplacer le fichier téléchargé vers le dossier sécurisé
          if (move_uploaded_file($imgRoot, $destination)) {
            // Assurer que le fichier n'est pas exécutable
            chmod($destination, 0644);

            // Insertion dans la base de données avec requête préparée
            $newAnimal = $pdo->prepare(
              'INSERT INTO animals(name, type, race, id_location, id_home, root, commonName) 
                          VALUES (:name, :type, :race, :id_location, :id_home, :root, :commonName)'
            );
            $newAnimal->bindValue(':name', $name);
            $newAnimal->bindValue(':type', $type);
            $newAnimal->bindValue(':race', $race);
            $newAnimal->bindValue(':id_location', $location);
            $newAnimal->bindValue(':id_home', $home);
            $newAnimal->bindValue(':root', $destination);
            $newAnimal->bindValue(':commonName', $commonName);

            // Exécution de la requête
            if ($newAnimal->execute()) {
              $messageAnimal = 'Nouvel animal créé avec succès';
            } else {
              $messageAnimal = 'Erreur lors de la création du nouvel animal';
            }
          } else {
            $messageAnimal = 'Erreur lors du téléchargement de l\'image.';
          }
        }
      }
    }
  }
} else {
  $messageAnimal = 'Erreur lors du téléchargement de l\'image.';
}
