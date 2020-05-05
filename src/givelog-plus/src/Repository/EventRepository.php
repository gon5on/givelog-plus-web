<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\Model\Entity\Event;

class EventRepository extends AppRepository implements IEventRepository {

    public function list(string $uid): array {
        $list = [];

        $documents = $this->__getQuery($uid)->orderBy('created', 'ASC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = $this->documentToEntity($document);
        }

        return $list;
    }

    public function add(string $uid, Event $entity): string {
        $data = [
            'name' => $entity->name,
            'labelColor' => $entity->labelColor,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, Event $entity): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "events"');
        }

        $data = [
            ['path' => 'name', 'value' => $entity->name],
            ['path' => 'labelColor', 'value' => $entity->labelColor],
            ['path' => 'modified', 'value' => FieldValue::serverTimestamp()],
        ];

        $ref->update($data);

        return $documentId;
    }

    public function delete(string $uid, string $documentId): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "events"');
        }

        $ref->delete();

        return $documentId;
    }

    public function exist(string $uid, string $documentId): bool {
        return $this->getRef($uid, $documentId)->snapshot()->exists();
    }

    public function idNameArray(string $uid): array {
        $list = [];

        $documents = $this->__getQuery($uid)->orderBy('created', 'ASC')->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                $list[$document->id()] = $document->get('name');
            }
        }

        return $list;
    }

    public function getRef(string $uid, ?string $documentId): ?DocumentReference {
        if (!$documentId) {
            return null;
        }

        return $this->__getQuery($uid)->document($documentId);
    }

    public function documentToEntity(DocumentSnapshot $document): Event {
        $data = $document->data();

        return new Event([
            'id' => $document->id(),
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);
    }

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('events')->document($uid)->collection('userEvents');
    }
}