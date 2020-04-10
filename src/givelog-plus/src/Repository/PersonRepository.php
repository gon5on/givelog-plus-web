<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use App\Repository\IPersonCategoryRepository;
use App\Model\Entity\Person;
use App\Model\Entity\PersonCategory;

class PersonRepository extends AppRepository implements IPersonRepository {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        parent::__construct();

        $this->personCategoryRepository = $personCategoryRepository;
    }

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

    public function add(string $uid, Person $entity): string {
        $data = [
            'name' => $entity->name,
            'person_category' => $this->personCategoryRepository->getRef($uid, $entity->personCategoryId),
            'memo' => $entity->memo,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, Person $entity): string {
        $data = [
            ['path' => 'name', 'value' => $entity->name],
            ['path' => 'person_category', 'value' => $this->personCategoryRepository->getRef($uid, $entity->personCategoryId)],
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

    public function get(string $uid, string $documentId): Person {
        $document = $this->getRef($uid, $documentId)->snapshot();

        return $this->documentToEntity($document);
    }

    public function exist(string $uid, string $documentId): bool {
        return $this->getRef($uid, $documentId)->snapshot()->exists();
    }

    public function idNameArrayWithCategory(string $uid): array {
        $list = [];

        $tmp = $this->list($uid);

        foreach ($tmp as $person) {
            $personCategoryName = 'グループなし';
            if ($person->personCategory) {
                $personCategoryName = $person->personCategory->name;
            }

            $list[$personCategoryName][$person->id] = $person->name;
        }

        return $list;
    }

    public function getRef(string $uid, ?string $documentId): ?DocumentReference {
        if (!$documentId) {
            return null;
        }

        return $this->__getQuery($uid)->document($documentId);
    }

    public function documentToEntity(DocumentSnapshot $doc): Person {
        $person = new Person([
            'id' => $doc->id(),
            'name' => $doc->get('name'),
            'memo' => $doc->get('memo'),
        ]);

        if ($doc->get('person_category')) {
            $pcDoc = $doc->get('person_category')->snapshot();
            $person->personCategory = $this->personCategoryRepository->documentToEntity($pcDoc);
        }

        return $person;
    }

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('persons')->document($uid)->collection('user_persons');
    }
}