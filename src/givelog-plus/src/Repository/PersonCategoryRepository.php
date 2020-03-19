<?php
namespace App\Repository;

use App\Model\Entity\PersonCategory;
use Google\Cloud\Firestore\FieldValue;

class PersonCategoryRepository extends AppRepository implements IPersonCategoryRepository {

    public function list(string $uid): array {
        $result = [];

        $documents = $this->__getQuery($uid)->orderBy('created', 'DESC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $result[] = new PersonCategory([
                'id' => $document->id(),
                'name' => $document->get('name'),
                'labelColor' => $document->get('label_color'),
            ]);
        }

        return $result;
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

    private function __getQuery(string $uid) {
        return $this->database->collection('person_categories')->document($uid)->collection('data');
    }
}