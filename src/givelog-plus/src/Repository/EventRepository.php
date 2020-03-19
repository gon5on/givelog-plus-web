<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;

class EventRepository extends AppRepository implements IEventRepository {

    public function list(string $uid): array {
        $result = [];

        $documents = $this->__getQuery($uid)->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                $result[] = new PersonCategory([
                    'id' => $document->id(),
                    'name' => $document->name,
                    'labelColor' => $document->label_color,
                ]);
            }
        }

        return $result;
    }

    public function add(string $uid, string $name, string $labelColor): string {
        $data = [
            'name' => $name,
            'label_color' => $labelColor,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function delete(string $uid, string $documentId) {
        //todo
    }

    public function get(string $uid, string $documentId) {
        //todo
    }

    private function __getQuery(string $uid) {
        return $this->database->collection('events')->document($uid)->collection('data');
    }
}