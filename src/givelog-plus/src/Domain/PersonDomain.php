<?php
namespace App\Domain;

use Cake\Utility\Hash;
use Cake\Validation\Validator;

class PersonDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('name', true, '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 15, '15文字以内で入力してください');

        $validator
            ->allowEmpty('personCategoryId')
            ->add('personCategoryId', 'valid', [
                'rule' => function ($value, $context) {
                    $array = Hash::extract($context, 'providers.passed.personCategories');
                    return array_key_exists($value, $array);
                },
                'message' => 'そのカテゴリは削除されているか、存在しません'
            ]);

        $validator
            ->allowEmpty('memo')
            ->maxLength('memo', 1000, '1000文字以内で入力してください');

        return $validator;
    }

    public function validation(array $data, array $personCategories) {
        $validator = $this->buildValidator()->provider('passed', ['personCategories' => $personCategories]);

        return $validator->errors($data);
    }
}