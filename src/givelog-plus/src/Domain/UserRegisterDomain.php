<?php
namespace App\Domain;

use Cake\Validation\Validator;

class UserRegisterDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('name', '入力してください')
            ->notEmpty('name', '入力してください')
            ->maxLength('name', 15, '15文字以内で入力してください');

        $validator
            ->requirePresence('email', '入力してください')
            ->notEmpty('email', '入力してください')
            ->maxLength('email', 100, '100文字以内で入力してください')
            ->email('email', 'メールアドレスの形式が正しくありません');

            //TODO メアド重複

        $validator
            ->requirePresence('password', '入力してください')
            ->notEmpty('password', '入力してください')
            ->minLength('password', 8, '8文字以上で入力してください')
            ->maxLength('password', 100, '100文字以内で入力してください')
            ->add('password', [
                'compareWith' => [
                    'rule' => ['compareWith','password_confirm'],
                    'message' => '確認用のパスワードと一致しません'
                ]
            ]);

        $validator
            ->requirePresence('password_confirm', '入力してください')
            ->notEmpty('password_confirm', '入力してください')
            ->minLength('password', 8, '8文字以上で入力してください')
            ->maxLength('password', 100, '100文字以内で入力してください');

        return $validator;
    }

    public function validation(array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}