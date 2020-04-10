<?php
namespace App\Repository;

use Google\Cloud\Firestore\CollectionReference;
use App\Model\Entity\Event;

class EventTemplateRepository extends AppRepository implements IEventTemplateRepository {

    public function list(): array {
        $list = [];

        $documents = $this->__getQuery()->orderBy('order', 'ASC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = new Event([
                'id' => $document->id(),
                'name' => $document->get('name'),
                'labelColor' => $document->get('label_color'),
                'order' => $document->get('order'),
            ]);
        }

        return $list;
    }

    private function __getQuery(): CollectionReference {
        return $this->database->collection('event_templates');
    }
}