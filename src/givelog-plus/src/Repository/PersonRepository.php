<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\DocumentSnapshot;
use Cake\Datasource\Exception\RecordNotFoundException;
use App\Repository\PersonCategoryRepository;
use App\Model\Entity\Person;
use App\Model\Entity\PersonCategory;

class PersonRepository extends AppRepository implements IPersonRepository {

    public function list(string $uid): array {
        $list = [];

        $documents = $this->__getQuery($uid)->orderBy('created', 'DESC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = $this->__documentToEntity($document);
        }

        return $list;
    }

    public function add(string $uid, Person $entity): string {
        $personCategoryRepository = new PersonCategoryRepository();
        $personCategoryRef = $personCategoryRepository->getRef($uid, $entity->personCategoryId);

        $data = [
            'name' => $entity->name,
            'person_category' => $personCategoryRef,
            'memo' => $entity->memo,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, Person $entity): string {
        $personCategoryRepository = new PersonCategoryRepository();
        $personCategoryRef = $personCategoryRepository->getRef($uid, $entity->personCategoryId);

        $data = [
            ['path' => 'name', 'value' => $entity->name],
            ['path' => 'person_category', 'value' => $personCategoryRef],
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
        $document = $this->__getQuery($uid)->document($documentId)->snapshot();

        if (!$document->exists()) {
            throw new RecordNotFoundException('TODO');
        }

        return $this->__documentToEntity($document);
    }

    private function __getQuery(string $uid) {
        return $this->database->collection('persons')->document($uid)->collection('data');
    }

    private function __documentToEntity(DocumentSnapshot $doc): Person {
        $person = new Person([
            'id' => $doc->id(),
            'name' => $doc->get('name'),
            'memo' => $doc->get('memo'),
        ]);

        if ($doc->get('person_category')) {
            $pcDoc = $doc->get('person_category')->snapshot();

            if ($pcDoc->exists()) {
                $person->personCategory = new PersonCategory([
                    'id' => $pcDoc->id(),
                    'name' => $pcDoc->get('name'),
                    'labelColor' => $pcDoc->get('label_color'),
                ]);
            }
        }

        return $person;
    }
}