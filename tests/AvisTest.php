<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class AvisTest extends TestCase
{
  public function testInvalidCSRFToken(): void
  {

    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['name'] = 'John Doe';
    $_POST['explication'] = 'Un excellent service.';

    $_SESSION['csrf_token'] = 'valid_csrf_token';
    $_POST['csrf_token'] = 'invalid_csrf_token';

    // Capture de la sortie
    ob_start();
    include __DIR__ . '/../public/avis.php';
    ob_get_clean();

    $this->assertStringContainsString('Invalid CSRF token', $message);
  }
}
