<?php
    require "../vendor/autoload.php";
    use MongoDB\Client;
    $client = new MongoDB\Client;
    $database = $client->rumah_sakit;
    //$collection = $database->selectCollection("obat");
    // $document = $collection->find();
?>