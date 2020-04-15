<?php
namespace App\Repository;

use Google\Cloud\Firestore\CollectionReference;
use Cake\Utility\Hash;
use App\Model\Entity\Event;

class EventTemplateRepository extends AppRepository implements IEventTemplateRepository {

    public function list(): array {
        $list = [];

        $documents = $this->__getQuery()->orderBy('order', 'ASC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $data = $document->data();

            $list[] = new Event([
                'id' => $document->id(),
                'name' => Hash::get($data, 'name'),
                'labelColor' => Hash::get($data, 'label_color'),
                'order' => Hash::get($data, 'order'),
            ]);
        }

        return $list;
    }

    private function __getQuery(): CollectionReference {
        return $this->database->collection('event_templates');
    }
}