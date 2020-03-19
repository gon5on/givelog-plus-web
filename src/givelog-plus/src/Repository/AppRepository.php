<?php
namespace App\Repository;

use Kreait\Firebase\Factory;

class AppRepository {
    protected $database;

    function __construct() {
        $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
        $firestore = $factory->createFirestore();
        $this->database = $firestore->database();
    }
}