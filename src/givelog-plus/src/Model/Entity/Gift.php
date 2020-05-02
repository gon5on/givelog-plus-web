<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Gift extends Entity {
    protected $_accessible = [
        'id' => true,
        'type' => true,
        'date' => true,
        'eventId' => true,
        'event' => true,
        'fromPersonIds' => true,
        'fromPersons' => true,
        'toPersonIds' => true,
        'toPersons' => true,
        'gift' => true,
        'price' => true,
        'url' => true,
        'imagePath' => true,
        'memo' => true,
        '*' => false,
    ];

    protected $_virtual = [
        'imageFileName',
    ];

    public function toArrayWithDefaultKey() {
        $dataArray = $this->toArray();
        $defaltArray = array_fill_keys(array_keys($this->_accessible), null);

        return ($dataArray + $defaltArray);
    }

    protected function _getImageFileName(): string {
        if (!$this->imagePath) {
            return '';
        }

        return basename($this->imagePath);
    }
}