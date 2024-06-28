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

    public function testDuplicateUsername(): void
    {
        $statement = $this->createMock(PDOStatement::class);
        $statement->method('rowCount')->willReturn(1);
        $this->pdo->method('prepare')->willReturn($statement);

        $_POST['inscription'] = 'submit';
        $_POST['username'] = 'jose@arcadia.com';

        global $error;
        $error = '';

        require __DIR__ . '/../mariadb/register.php';
        var_dump($error);

        // Check if the error message is set correctly
        $this->assertStringContainsString('Username déjà existant dans la base de données.', $error);
    }
}
