<?php
namespace App\Domain;

use Cake\Validation\Validator;

class PersonCategoryDomain {

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

    public function validation(array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}