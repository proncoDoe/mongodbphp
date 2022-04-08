<?php 

require __DIR__.'/vendor/autoload.php';

$client = new MongoDB\Client;
$database = $client->selectDatabase('animals');

// $client = new MongoDB\Client;

// $db = $client->users;

// $result = $db->createCollection('record');

// var_dump($result);




// $collection = (new MongoDB\Client)->test->users;

// $insertOneResult = $collection->insertOne([
//     'username' => 'admin',
//     'email' => 'admin@example.com',
//     'name' => 'Admin User',
// ]);

// printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

// var_dump($insertOneResult->getInsertedId());






// $document = $collection->findOne(['username' => 'admin']);

// var_dump($document);


?>