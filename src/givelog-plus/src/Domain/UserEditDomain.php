<?php
namespace App\Domain;

use Cake\Validation\Validator;

class UserEditDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('email', true, '入力してください')
            ->notEmpty('email', '入力してください')
            ->maxLength('email', 100, '100文字以内で入力してください')
            ->email('email', 'メールアドレスの形式が正しくありません');

            //TODO メアド重複

        $validator
            ->allowEmpty('password')
            ->minLength('password', 8, '8文字以上で入力してください')
            ->maxLength('password', 100, '100文字以内で入力してください')
            ->add('password', [
                'compareWith' => [
                    'rule' => ['compareWith','passwordConfirm'],
                    'message' => '確認用のパスワードと一致しません'
                ]
            ]);

        $validator
            ->allowEmpty('passwordConfirm');

        return $validator;
    }

    public function validation(string $uid, array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}