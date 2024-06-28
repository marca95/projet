<?php

require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Collection;
use MongoDB\DeleteResult;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../mongodb/animalManager.php';

class AnimalRepositoryDeleteTest extends TestCase
{
  public function testDeleteAnimalSuccessfullyDeletes()
  {


    /*
    * Créez des mocks pour 'Collection' et 'DeleteResult' pour simuler leur 
    * comportement sans dépendre d'une véritable base de données MongoDB
    */
    // Créer un mock pour la collection MongoDB
    $collection = $this->createMock(Collection::class);
    // Créer un mock pour le résultat de la suppression
    $deleteResult = $this->createMock(DeleteResult::class);

    // Configurer le mock pour retourner un résultat de suppression réussie
    $deleteResult->method('getDeletedCount')->willReturn(1);
    $collection->method('deleteOne')->willReturn($deleteResult);

    // Instancier AnimalManager avec la collection mockée
    $repository = new AnimalManager($collection);

    $result = $repository->deleteAnimal('Lion', 'Mammal');

    $this->assertTrue($result);
  }

  public function testDeleteAnimalNoMatchFound()
  {
    // Créer un mock pour la collection MongoDB
    $collection = $this->createMock(Collection::class);
    // Créer un mock pour le résultat de la suppression
    $deleteResult = $this->createMock(DeleteResult::class);

    // Configurer le mock pour retourner aucun document supprimé
    $deleteResult->method('getDeletedCount')->willReturn(0);
    $collection->method('deleteOne')->willReturn($deleteResult);

    // Instancier AnimalManager avec la collection mockée
    $repository = new AnimalManager($collection);

    $result = $repository->deleteAnimal('Unicorn', 'Mythical');

    $this->assertFalse($result);
  }
}
