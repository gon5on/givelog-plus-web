<?php
namespace App\Domain;

use Cake\Validation\Validator;

class EventDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('name', true, '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 15, '15文字以内で入力してください');

        $validator
            ->requirePresence('labelColor', true, '選択してください')
            ->notEmpty('labelColor', '選択してください');

        return $validator;
    }

    public function validation(array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}