<?php
namespace App\Repository;

class IEventRepository implements IEventRepository {
    private $database;

    function __construct() {
        $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
        $firestore = $factory->createFirestore();
        $database = $firestore->database();
    }

    public function save(string $uid/*, Event $event*/) {
        //todo
    }

    public function delete(string $documentId) {
        //todo
    }

    public function list(string $uid) {
        $documents = $this->getQuery($uid)
                        ->orderBy('created', 'DESC')
                        ->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                debug($document->data());
            }
        }
    }

    public function get(string $documentId) {
        //todo
    }

    public function getQuery($uid) {
        return $database
                    ->collection('users')
                    ->document($uid)
                    ->collection('events');
    }
}