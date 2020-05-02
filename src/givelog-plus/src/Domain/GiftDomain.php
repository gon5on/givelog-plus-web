<?php
namespace App\Domain;

use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

class GiftDomain {
    const IMAGE_TMP_PATH = TMP . 'image' . DS ;
    const IMAGE_MAX_LONG_SIDE_SIZE = 1000;
    const IMAGE_TMP_EXPIRE_SEC = 60 * 60 * 24 * 1;      //1日

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('type', true, '選択してください')
            ->notEmpty('type', '選択してください')
            ->inList('type', array_keys(Configure::read('types')), '不正な値です');

        $validator
            ->requirePresence('date', true, '選択してください')
            ->notEmpty('date', '選択してください')
            ->date('date', ['ymd'], '正しい日付を選択してください');

        $validator
            ->requirePresence('fromPersonIds', true, '選択してください')
            ->notEmpty('fromPersonIds', '選択してください');

        $validator
            ->requirePresence('toPersonIds', true, '選択してください')
            ->notEmpty('toPersonIds', '選択してください');

        $validator
            ->requirePresence('gift', true, '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 100, '100文字以内で入力してください');

        $validator
            ->allowEmpty('eventId')
            ->add('eventId', 'valid', [
                'rule' => function ($value, $context) {
                    $array = Hash::extract($context, 'providers.passed.events');
                    return array_key_exists($value, $array);
                },
                'message' => 'そのイベントは削除されているか、存在しません'
            ]);

        $validator
            ->allowEmpty('price')
            ->maxLength('price', 100, '100文字以内で入力してください');

        $validator
            ->allowEmpty('image')
            ->add('image', [
                'uploadedFile' => [
                    'rule' => ['uploadedFile', ['types' => ['image/jpeg', 'image/gif', 'image/png'], 'maxSize' => '10MB']],
                    'last' => true,
                    'message' => 'jpg・png・gifのいずれかで、10MB以内にしてください'
                ],
            ]);

        $validator
            ->allowEmpty('url')
            ->maxLength('url', 200, '200文字以内で入力してください')
            ->urlWithProtocol('url', 'URLの形式で入力してください');

        $validator
            ->allowEmpty('memo')
            ->maxLength('memo', 1000, '1000文字以内で入力してください');

        return $validator;
    }

    public function validation(array $data, array $events, array $persons) {
        $validator = $this->buildValidator()->provider('passed', [
            'events' => $events,
            'persons' => $persons,
        ]);

        return $validator->errors($data);
    }
}