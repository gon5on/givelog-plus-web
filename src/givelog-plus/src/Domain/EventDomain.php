<?php
namespace App\Domain;

use Cake\Utility\Hash;
use Cake\Validation\Validator;
use App\Model\Entity\Event;

class EventDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('name', '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 15, '15文字以内で入力してください');

        $validator
            ->requirePresence('label_color', '選択してください')
            ->notEmpty('label_color', '選択してください');

        return $validator;
    }

    public function createEntity(array $data) {
        $entity = new Event();

        $validator = $this->buildValidator();
        $errors = $validator->errors($data);

        if ($errors) {
            $entity->setErrors($errors);
        } else {
            $entity->name = Hash::get($data, 'name');
            $entity->labelColor = Hash::get($data, 'label_color');
        }

        return $entity;
    }
}