<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class PersonCategory extends Entity {
    protected $_accessible = [
        'id' => false,
        '*' => true,
    ];
}