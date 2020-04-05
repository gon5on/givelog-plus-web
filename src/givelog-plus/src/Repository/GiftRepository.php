<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Model\Entity\Gift;
use App\Model\Entity\GiftCategory;

class GiftRepository extends AppRepository implements IGiftRepository {
    private $personRepository;
    private $eventRepository;

    function __construct(IPersonRepository $personRepository, IEventRepository $eventRepository) {
        parent::__construct();

        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
    }

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

    private function __documentToEntity(DocumentSnapshot $doc): Gift {
        $gift = new Gift([
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
                $gift->event = $this->eventRepository->documentToEntity($eventDoc);
            }
        }

        $fromPersons = [];
        foreach ($doc->get('from_persons') as $person) {
            $personDoc = $person->snapshot();
            if ($personDoc->exists()) {
                $fromPersons[] = $this->personRepository->documentToEntity($personDoc);
            }
        }
        $gift->fromPersons = $fromPersons;

        $toPersons = [];
        foreach ($doc->get('to_persons') as $person) {
            $personDoc = $person->snapshot();
            if ($personDoc->exists()) {
                $toPersons[] = $this->personRepository->documentToEntity($personDoc);
            }
        }
        $gift->toPersons = $toPersons;

        return $gift;
    }

    private function __getQuery(string $uid) {
        return $this->database->collection('gifts')->document($uid)->collection('data');
    }
}