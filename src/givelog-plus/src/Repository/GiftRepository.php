<?php
namespace App\Repository;

use Cake\Utility\Hash;
use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Model\Entity\Gift;

class GiftRepository extends AppRepository implements IGiftRepository {
    private $personRepository;
    private $eventRepository;

    function __construct(IPersonRepository $personRepository, IEventRepository $eventRepository) {
        parent::__construct();

        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
    }

    public function list(string $uid, array $search = null): array {
        $list = [];

        $query = $this->__getQuery($uid);
        $query = $this->__addWhereToQuery($query, $search);

        $documents = $query->orderBy('date', 'DESC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = $this->__documentToEntity($document);
        }

        return $list;
    }

    public function add(string $uid, Gift $entity): string {
        $entity = $this->__idToRefsForSave($uid, $entity);

        $data = [
            'type' => $entity->type,
            'date' => $entity->date,
            'from_person_ids' => $entity->fromPersonIds,
            'from_persons' => $entity->fromPersons,
            'to_person_ids' => $entity->toPersonIds,
            'to_persons' => $entity->toPersons,
            'person_ids' => $entity->personIds,
            'gift' => $entity->gift,
            'event_id' => $entity->eventId,
            'event' => $entity->event,
            'event_id' => $entity->event_id,
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
            ['path' => 'from_person_ids', 'value' => $entity->fromPersonIds],
            ['path' => 'from_persons', 'value' => $entity->fromPersons],
            ['path' => 'to_person_ids', 'value' => $entity->toPersonIds],
            ['path' => 'to_persons', 'value' => $entity->toPersons],
            ['path' => 'person_ids', 'value' => $entity->personIds],
            ['path' => 'gift', 'value' => $entity->gift],
            ['path' => 'event_id', 'value' => $entity->eventId],
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

    private function __addWhereToQuery(CollectionReference $query, ?array $search) {
        if (!$search) {
            return $query;
        }

        if (Hash::check($search, 'person_ids')) {
            $query = $query->where('person_ids', 'array-contains-any', Hash::get($search, 'person_ids'));
        }

        if (Hash::check($search, 'event_id')) {
            $query = $query->where('event_id', 'in', Hash::get($search, 'event_id'));
        }

        return $query;
    }

    private function __idToRefsForSave(string $uid, Gift $entity): Gift {
        $entity->event = $this->eventRepository->getRef($uid, $entity->eventId);

        foreach ($entity->fromPersonIds as $personId) {
            $fromPersons[] = $this->personRepository->getRef($uid, $personId);
        }
        $entity->fromPersons = $fromPersons;

        foreach ($entity->toPersonIds as $personId) {
            $toPersons[] = $this->personRepository->getRef($uid, $personId);
        }
        $entity->toPersons = $toPersons;

        $entity->personIds = array_unique(array_merge($entity->fromPersonIds, $entity->toPersonIds));

        return $entity;
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

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('gifts')->document($uid)->collection('user_gifts');
    }
}