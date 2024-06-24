<?php

require '../vendor/autoload.php';

use MongoDB\Client;

class MongoDBConnection
{
  private $client;
  private $database;
  private $collection;

  public function __construct()
  {
    $this->connect();
    $this->selectDatabase($_ENV['APP_MONGO_ONLINE_DATABASE']);
    $this->selectCollection($_ENV['APP_MONGO_ONLINE_COLLECTION']);
  }

  private function connect()
  {
    $usernameOnline = $_ENV['APP_MONGO_ONLINE_USERNAME'];
    $passwordOnline = $_ENV['APP_MONGO_ONLINE_PASSWORD'];

    if ($this->isLocalhost()) {
      // Dotenv\Dotenv::createImmutable(__DIR__ . '../../')->load();

      $this->client = new Client("mongodb://localhost:27017");
    } else {
      $uri = "mongodb+srv://{$usernameOnline}:{$passwordOnline}@cluster0.1ybtwgx.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0";
      $this->client = new Client($uri);
    }
  }

  private function isLocalhost()
  {
    return $_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1' || $_SERVER['SERVER_ADDR'] === '::1';
  }

  public function selectDatabase($databaseName)
  {
    $this->database = $this->client->selectDatabase($databaseName);
  }

  public function selectCollection($collectionName)
  {
    $this->collection = $this->database->selectCollection($collectionName);
  }

  public function getCollection()
  {
    return $this->collection;
  }
}
