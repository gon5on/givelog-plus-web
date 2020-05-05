<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Google\Cloud\Firestore\DocumentReference;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\Repository\IPersonCategoryRepository;
use App\Model\Entity\Person;
use App\Model\Entity\PersonCategory;

class PersonRepository extends AppRepository implements IPersonRepository {
    const NO_CATEGORY = 999;

    const TYPE_LIST = 'list';
    const TYPE_ID_NAME_ARRAT_WITH_CATEGORY = 'idNameArrayWithCategory';

    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        parent::__construct();

        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function list(string $uid): array {
        return $this->__listWithCategory($uid, self::TYPE_LIST);
    }

    public function add(string $uid, Person $entity): string {
        $data = [
            'name' => $entity->name,
            'personCategoryId' => $entity->personCategoryId,
            'personCategory' => $this->personCategoryRepository->getRef($uid, $entity->personCategoryId),
            'memo' => $entity->memo,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, Person $entity): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "persons"');
        }

        $data = [
            ['path' => 'name', 'value' => $entity->name],
            ['path' => 'personCategoryId', 'value' => $entity->personCategoryId],
            ['path' => 'personCategory', 'value' => $this->personCategoryRepository->getRef($uid, $entity->personCategoryId)],
            ['path' => 'memo', 'value' => $entity->memo],
            ['path' => 'modified', 'value' => FieldValue::serverTimestamp()],
        ];

        $ref->update($data);

        return $documentId;
    }

    public function delete(string $uid, string $documentId): string {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "persons"');
        }

        $ref->delete();

        return $documentId;
    }

    public function get(string $uid, string $documentId): Person {
        $ref = $this->getRef($uid, $documentId);

        if (!$ref->snapshot()->exists()) {
            throw new RecordNotFoundException('Record not found in firestore "persons"');
        }

        return $this->documentToEntity($ref->snapshot());
    }

    public function exist(string $uid, string $documentId): bool {
        return $this->getRef($uid, $documentId)->snapshot()->exists();
    }

    public function idNameArrayWithCategory(string $uid): array {
        return $this->__listWithCategory($uid, self::TYPE_ID_NAME_ARRAT_WITH_CATEGORY);
    }

    public function getRef(string $uid, ?string $documentId): ?DocumentReference {
        if (!$documentId) {
            return null;
        }

        return $this->__getQuery($uid)->document($documentId);
    }

    public function documentToEntity(DocumentSnapshot $document): Person {
        $data = $document->data();

        $person = new Person([
            'id' => $document->id(),
            'name' => Hash::get($data, 'name'),
            'personCategoryId' => Hash::get($data, 'personCategoryId'),
            'memo' => Hash::get($data, 'memo'),
        ]);

        if ($person->personCategoryId) {
            $personCategoryDoc = $data['personCategory']->snapshot();
            if ($personCategoryDoc->exists()) {
                $person->personCategory = $this->personCategoryRepository->documentToEntity($personCategoryDoc);
            }
        }

        return $person;
    }

    private function __listWithCategory(string $uid, string $type) {
        $list = [];
        $tmpList = [];

        $documents = $this->__getQuery($uid)->orderBy('created', 'ASC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $person = $this->documentToEntity($document);

            $personCategoryId = ($person->personCategory) ? $person->personCategoryId: self::NO_CATEGORY;
            $tmpList[$personCategoryId][] = ($type == self::TYPE_LIST) ? $person : $person->name;
        }

        $personCategories = $this->personCategoryRepository->idNameArray($uid);
        $personCategories[self::NO_CATEGORY] = 'グループなし';

        foreach ($personCategories as $personCategoryId => $name) {
            if (Hash::check($tmpList, $personCategoryId)) {
                $key = ($type == self::TYPE_LIST) ? $personCategoryId : $name;
                $list[$key] = $tmpList[$personCategoryId];
            }
        }

        return $list;
    }

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('persons')->document($uid)->collection('userPersons');
    }
}