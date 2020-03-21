<?php
namespace App\Domain;

use Cake\Utility\Hash;
use Cake\Validation\Validator;
use App\Model\Entity\Person;
use App\Repository\IPersonCategoryRepository;

class PersonDomain {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('name', '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 15, '15文字以内で入力してください');

        $validator
            ->allowEmpty('person_category_id')
            ->add('person_category_id', 'valid', [
                'rule' => function ($value, $context) {
                    $uid = Hash::get($context, 'providers.passed.uid');
                    return $this->personCategoryRepository->exist($uid, $value);
                },
                'message' => 'そのカテゴリは削除されているか、存在しません'
            ]);

        $validator
            ->allowEmpty('memo')
            ->maxLength('memo', 1000, '1000文字以内で入力してください');

        return $validator;
    }

    public function createEntity(string $uid, array $data) {
        $entity = new Person();

        $validator = $this->buildValidator()->provider('passed', ['uid' => $uid]);
        $errors = $validator->errors($data);

        if ($errors) {
            $entity->setErrors($errors);
        } else {
            $entity->name = Hash::get($data, 'name');
            $entity->personCategoryId = Hash::get($data, 'person_category_id');
            $entity->memo = Hash::get($data, 'memo');
        }

        return $entity;
    }
}