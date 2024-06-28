<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class EmployeAvisTest extends TestCase
{
  public function testIfAStringInsteadOfANumberWithIdUser(): void
  {
    $_POST['update_avis'] = 'submit';
    global $user;
    $user['id_user'] = "Je suis une chaine de caractère";

    require_once __DIR__ . '/../mariadb/employe_avis.php';

    var_dump($employeValidated);
    global $employeValidated;

    $this->assertIsInt($employeValidated);
  }
}
