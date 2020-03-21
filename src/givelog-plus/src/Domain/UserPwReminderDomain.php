<?php
namespace App\Domain;

use Cake\Validation\Validator;

class UserPwReminderDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        $validator
            ->requirePresence('email', '入力してください')
            ->notEmpty('email', '入力してください')
            ->maxLength('email', 100, '100文字以内で入力してください')
            ->email('email', 'メールアドレスの形式が正しくありません');

        return $validator;
    }

    public function validation(array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}