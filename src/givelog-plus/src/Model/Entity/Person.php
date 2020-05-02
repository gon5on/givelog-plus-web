<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Person extends Entity {
    protected $_accessible = [
        'id' => true,
        'name' => true,
        'personCategoryId' => true,
        'personCategory' => true,
        'memo' => true,
        '*' => false,
    ];

    public function toArrayWithDefaultKey() {
        $dataArray = $this->toArray();
        $defaltArray = array_fill_keys(array_keys($this->_accessible), null);

        return ($dataArray + $defaltArray);
    }
}