<?php
namespace App\Repository;

use Google\Cloud\Firestore\CollectionReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use Cake\Utility\Hash;
use App\Model\Entity\Information;

class InformationRepository extends AppRepository implements IInformationRepository {

    public function list(): array {
        $list = [];

        $documents = $this->__getQuery()->where('enableFlg', '==', true)->orderBy('date', 'DESC')->documents();

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $list[] = $this->documentToEntity($document);
        }

        return $list;
    }

    public function documentToEntity(DocumentSnapshot $document): Information {
        $data = $document->data();

        return new Information([
            'id' => $document->id(),
            'date' => Hash::get($data, 'date'),
            'type' => Hash::get($data, 'type'),
            'title' => Hash::get($data, 'title'),
            'body' => Hash::get($data, 'body'),
        ]);
    }

    private function __getQuery(): CollectionReference {
        return $this->database->collection('informations');
    }
}