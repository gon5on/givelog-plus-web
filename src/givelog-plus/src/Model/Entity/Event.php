<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Event extends Entity {
    protected $_accessible = [
        'id' => true,
        'name' => true,
        'labelColor' => true,
        '*' => false,
    ];
}