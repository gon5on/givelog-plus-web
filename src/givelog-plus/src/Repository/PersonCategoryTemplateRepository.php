<?php
namespace App\Repository;

use App\Model\Entity\PersonCategory;

class PersonCategoryTemplateRepository extends AppRepository implements IPersonCategoryTemplateRepository {

    public function list(): array {
        $list = [];

        $documents = $this->__getQuery()->orderBy('order', 'ASC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = new PersonCategory([
                'id' => $document->id(),
                'name' => $document->get('name'),
                'labelColor' => $document->get('label_color'),
                'order' => $document->get('order'),
            ]);
        }

        return $list;
    }

    private function __getQuery() {
        return $this->database->collection('person_category_templates');
    }
}