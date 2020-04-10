<?php
namespace App\Repository;

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use App\Model\Entity\PersonCategory;

class PersonCategoryRepository extends AppRepository implements IPersonCategoryRepository {

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

    public function add(string $uid, PersonCategory $entity): string {
        $data = [
            'name' => $entity->name,
            'label_color' => $entity->labelColor,
            'created' => FieldValue::serverTimestamp(),
            'modified' => FieldValue::serverTimestamp(),
        ];

        $ret = $this->__getQuery($uid)->add($data);

        return $ret->id();
    }

    public function edit(string $uid, string $documentId, PersonCategory $entity): string {
        $data = [
            ['path' => 'name', 'value' => $entity->name],
            ['path' => 'label_color', 'value' => $entity->labelColor],
            ['path' => 'modified', 'value' => FieldValue::serverTimestamp()],
        ];

        $this->__getQuery($uid)->document($documentId)->update($data);

        return $documentId;
    }

    public function delete(string $uid, string $documentId): string {
        $this->__getQuery($uid)->document($documentId)->delete();

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

    public function documentToEntity(DocumentSnapshot $document): PersonCategory {
        return new PersonCategory([
            'id' => $document->id(),
            'name' => $document->get('name'),
            'labelColor' => $document->get('label_color'),
        ]);
    }

    private function __getQuery(string $uid): CollectionReference {
        return $this->database->collection('person_categories')->document($uid)->collection('user_person_categories');
    }
}