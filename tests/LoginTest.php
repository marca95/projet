<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testUserNotFound(): void
    {
        global $pdo; // Définir $pdo comme global

        try {
            $pdo = new PDO('mysql:host=localhost;port=5353;dbname=zoo', 'root', 'pierre2');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Erreur de connexion à la base de données MariaDB :" . $e->getMessage());
            $this->fail("Erreur de connexion à la base de données.");
        }

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'nonexistentuser@example.com';
        $_POST['password'] = 'password';

        global $errorCon;
        $errorCon = null;

        // Inclure le script de traitement de connexion
        require_once __DIR__ . '/../mariadb/checkConnect.php';

        // Vérifier que $errorCon est défini comme attendu
        $this->assertEquals('Erreur dans le mot de passe ou votre adresse mail.', $errorCon);
    }
}
