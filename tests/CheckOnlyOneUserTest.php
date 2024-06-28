<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class CheckOnlyOneUserTest extends TestCase
{

    private $pdo;

    protected function setUp(): void
    {
        // Create a mock PDO object
        $this->pdo = $this->createMock(PDO::class);
    }

    public function testDuplicateUsername()
    {
        // Mock the prepare method
        $statement = $this->createMock(PDOStatement::class);
        $statement->method('rowCount')->willReturn(1);
        $this->pdo->method('prepare')->willReturn($statement);

        $_POST['inscription'] = 'submit';
        $_POST['username'] = 'existinguser';
        $_POST['email'] = 'newemail@example.com';
        $_POST['name'] = 'John';
        $_POST['first_name'] = 'Doe';
        $_POST['password'] = 'password123';
        $_POST['id_role'] = 1;
        $_POST['birthday']  = '2000-01-01';
        $_POST['hire'] = '2020-01-01';

        // Capture output
        ob_start();
        require __DIR__ . '/../mariadb/register.php';
        $output = ob_get_clean();

        // Check if the error message is set correctly
        $this->assertStringContainsString('Username déjà existant dans la base de données.', $output);
    }
}
