<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Gift extends Entity {
    protected $_accessible = [
        'id' => false,
        '*' => true,
    ];
}