<?php
namespace App\Domain;

use Cake\Validation\Validator;

class GiftDomain {

    protected function buildValidator() : Validator {
        $validator = new Validator();

        return $validator;
    }

    public function validation(array $data) {
        $validator = $this->buildValidator();

        return $validator->errors($data);
    }
}