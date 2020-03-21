<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use App\Repository\GiftCategoryRepository;
use App\Model\Entity\Gift;
use App\Model\Entity\GiftCategory;

class GiftRepository extends AppRepository implements IGiftRepository {

    public function list(string $uid): array {
        $list = [];

        $documents = $this->__getQuery($uid)->orderBy('date', 'DESC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = $this->__documentToEntity($document);
        }

        return $list;
    }

    public function add(string $uid, Gift $entity): string {
        $data = [
            'type' => $entity->type,
            'date' => $entity->date,
            'from_persons' => $entity->fromPersons,
            'to_persons' => $entity->toPersons,
            'gift' => $entity->gift,
            'event' => $entity->event,
            'price' => $entity->price,
            'url' => $entity->url,
            'memo' => $entity->memo,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, Gift $entity): string {
        $data = [
            ['path' => 'type', 'value' => $entity->type],
            ['path' => 'date', 'value' => $entity->date],
            ['path' => 'from_persons', 'value' => $entity->fromPersons],
            ['path' => 'to_persons', 'value' => $entity->toPersons],
            ['path' => 'gift', 'value' => $entity->gift],
            ['path' => 'event', 'value' => $entity->event],
            ['path' => 'price', 'value' => $entity->price],
            ['path' => 'url', 'value' => $entity->url],
            ['path' => 'memo', 'value' => $entity->memo],
            ['path' => 'modified', 'value' => FieldValue::serverTimestamp()],
        ];

        $this->__getQuery($uid)->document($documentId)->update($data);

        return $documentId;
    }

    public function delete(string $uid, string $documentId): string {
        $this->__getQuery($uid)->document($documentId)->delete();

        return $documentId;
    }

    public function get(string $uid, string $documentId): Gift {
        $document = $this->__getRef($uid, $documentId)->snapshot();

        return $this->__documentToEntity($document);
    }

    public function exist(string $uid, string $documentId): bool {
        return $this->__getRef($uid, $documentId)->snapshot()->exists();
    }

    private function __getRef(string $uid, string $documentId): DocumentReference {
        return $this->__getQuery($uid)->document($documentId);
    }

    private function __getQuery(string $uid) {
        return $this->database->collection('gifts')->document($uid)->collection('data');
    }

    private function __documentToEntity(DocumentSnapshot $doc): Gift {
        $Gift = new Gift([
            'id' => $doc->id(),
            'type' => $doc->get('type'),
            'date' => $doc->get('date'),
            'gift' => $doc->get('gift'),
            'price' => $doc->get('price'),
            'url' => $doc->get('url'),
            'memo' => $doc->get('memo'),
        ]);

        if ($doc->get('event')) {
            $eventDoc = $doc->get('event')->snapshot();

            if ($eventDoc->exists()) {
                $Gift->event = new event([
                    'id' => $eventDoc->id(),
                    'name' => $eventDoc->get('name'),
                    'labelColor' => $eventDoc->get('label_color'),
                ]);
            }
        }

        return $Gift;
    }
}