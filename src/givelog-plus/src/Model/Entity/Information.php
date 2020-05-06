<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Information extends Entity {
    protected $_accessible = [
        'date' => true,
        'type' => true,
        'title' => true,
        'body' => true,
        'enableFlg' => true,
        '*' => false,
    ];
}