<?php
namespace App\Repository;

use Kreait\Firebase\Factory;

class AppRepository {
    protected $database;
    protected $auth;

    function __construct() {
        $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');

        $firestore = $factory->createFirestore();
        $this->database = $firestore->database();

        $this->auth = $factory->createAuth();
    }
}