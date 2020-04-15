<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Gift extends Entity {
    protected $_accessible = [
        'id' => false,
        '*' => true,
    ];

    protected function _getImageFileName(): string {
        if (!$this->imagePath) {
            return '';
        }

        return basename($this->imagePath);
    }
}