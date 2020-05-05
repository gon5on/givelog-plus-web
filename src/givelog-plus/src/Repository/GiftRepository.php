<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Repository\IGiftImageStorageRepository;
use App\Model\Entity\Gift;

class GiftRepository extends AppRepository implements IGiftRepository {
    private $personRepository;
    private $eventRepository;
    private $giftImageStorageRepository;

    function __construct(IPersonRepository $personRepository, IEventRepository $eventRepository,
            IGiftImageStorageRepository $giftImageStorageRepository) {
        parent::__construct();

        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
        $this->giftImageStorageRepository = $giftImageStorageRepository;
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

            $list[] = $this->documentToEntity($document);
        }

        return $list;
    }

    public function add(string $uid, Gift $entity): string {
        $ref = $this->__getQuery($uid)->newDocument();

        $entity = $this->__idToRefsForSave($uid, $entity);

        $data = [
            'type' => $entity->type,
            'date' => $entity->date,
            'fromPersonIds' => $entity->fromPersonIds,
            'fromPersons' => $entity->fromPersons,
            'toPersonIds' => $entity->toPersonIds,
            'toPersons' => $entity->toPersons,
            'personIds' => $entity->personIds,
            'gift' => $entity->gift,
            'eventId' => $entity->eventId,
            'event' => $entity->event,
            'price' => $entity->price,
            'url' => $entity->url,
            'memo' => $entity->memo,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        if ($entity->imagePath) {
            $data['imagePath'] = $this->giftImageStorageRepository->upload($uid, $ref->id(), 'image1', $entity->imagePath);
        }

        $ref->set($data);

        return $ref->id();
    }

    public function edit(string $uid, string $documentId, Gift $entity): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "gifts"');
        }

        $entity = $this->__idToRefsForSave($uid, $entity);

        $data = [
            ['path' => 'type', 'value' => $entity->type],
            ['path' => 'date', 'value' => $entity->date],
            ['path' => 'fromPersonIds', 'value' => $entity->fromPersonIds],
            ['path' => 'fromPersons', 'value' => $entity->fromPersons],
            ['path' => 'toPersonIds', 'value' => $entity->toPersonIds],
            ['path' => 'toPersons', 'value' => $entity->toPersons],
            ['path' => 'personIds', 'value' => $entity->personIds],
            ['path' => 'gift', 'value' => $entity->gift],
            ['path' => 'eventId', 'value' => $entity->eventId],
            ['path' => 'event', 'value' => $entity->event],
            ['path' => 'price', 'value' => $entity->price],
            ['path' => 'url', 'value' => $entity->url],
            ['path' => 'memo', 'value' => $entity->memo],
            ['path' => 'modified', 'value' => FieldValue::serverTimestamp()],
        ];

        if ($entity->imageDeleteFlg) {
            $savedEntity = $this->documentToEntity($ref->snapshot(), false);
            $this->giftImageStorageRepository->delete($savedEntity->imagePath);

            $data[] = ['path' => 'imagePath', 'value' => null];
        }

        if ($entity->imagePath) {
            $imagePath = $this->giftImageStorageRepository->upload($uid, $documentId, 'image1', $entity->imagePath);
            $data[] = ['path' => 'imagePath', 'value' => $imagePath];
        }

        $ref->update($data);

        return $documentId;
    }

    public function delete(string $uid, string $documentId): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "gifts"');
        }

        $entity = $this->documentToEntity($ref->snapshot(), false);
        if ($entity->imagePath) {
            $this->giftImageStorageRepository->delete($entity->imagePath);
        }

        $ref->delete();

        return $documentId;
    }

    public function get(string $uid, string $documentId, bool $withAssociation = true): Gift {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "gifts"');
        }

        return $this->documentToEntity($ref->snapshot(), $withAssociation);
    }

    public function exist(string $uid, string $documentId): bool {
        return $this->getRef($uid, $documentId)->snapshot()->exists();
    }

    private function __addWhereToQuery(CollectionReference $query, ?array $search) {
        if (!$search) {
            return $query;
        }

        if (Hash::check($search, 'personIds')) {
            $query = $query->where('personIds', 'array-contains-any', Hash::get($search, 'personIds'));
        }

        if (Hash::check($search, 'eventId')) {
            $query = $query->where('eventId', 'in', Hash::get($search, 'eventId'));
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

    public function getRef(string $uid, ?string $documentId): ?DocumentReference {
        if (!$documentId) {
            return null;
        }

        return $this->__getQuery($uid)->document($documentId);
    }

    public function documentToEntity(DocumentSnapshot $document, bool $withAssociation = true): Gift {
        $data = $document->data();

        $gift = new Gift([
            'id' => $document->id(),
            'type' => Hash::get($data, 'type'),
            'date' => Hash::get($data, 'date'),
            'eventId' => Hash::get($data, 'eventId'),
            'fromPersonIds' => Hash::get($data, 'fromPersonIds'),
            'toPersonIds' => Hash::get($data, 'toPersonIds'),
            'gift' => Hash::get($data, 'gift'),
            'price' => Hash::get($data, 'price'),
            'url' => Hash::get($data, 'url'),
            'imagePath' => Hash::get($data, 'imagePath'),
            'memo' => Hash::get($data, 'memo'),
        ]);

        if (!$withAssociation) {
            return $gift;
        }

        if ($gift->eventId) {
            $eventDoc = $data['event']->snapshot();
            if ($eventDoc->exists()) {
                $gift->event = $this->eventRepository->documentToEntity($eventDoc);
            }
        }

        if ($gift->fromPersonIds) {
            $fromPersons = [];
            foreach ($data['fromPersons'] as $person) {
                $personDoc = $person->snapshot();
                if ($personDoc->exists()) {
                    $fromPersons[] = $this->personRepository->documentToEntity($personDoc);
                }
            }
            $gift->fromPersons = $fromPersons;
        }

        if ($gift->toPersonIds) {
            $toPersons = [];
            foreach ($data['toPersons'] as $person) {
                $personDoc = $person->snapshot();
                if ($personDoc->exists()) {
                    $toPersons[] = $this->personRepository->documentToEntity($personDoc);
                }
            }
            $gift->toPersons = $toPersons;
        }

        return $gift;
    }

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('gifts')->document($uid)->collection('userGifts');
    }
}