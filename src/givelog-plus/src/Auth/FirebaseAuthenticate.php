<?php
namespace App\Auth;
 
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Auth\BaseAuthenticate;

class FirebaseAuthenticate extends BaseAuthenticate {
    protected $_defaultConfig = [
        'fields' => [
            'token' => 'token',
        ],
    ];
 
    protected function _checkFields(ServerRequest $request, array $fields) {
        $value = $request->getData($fields['token']);

        if (empty($value) || !is_string($value)) {
            return false;
        }

        return true;
    }
 
    public function authenticate(ServerRequest $request, Response $response) {
        $fields = $this->_config['fields'];

        if (!$this->_checkFields($request, $fields)) {
            return false;
        }

        $token = $request->getData($fields['token']);

        $this->userRepository = new \App\Repository\UserRepository();   //TODO
        $uid = $this->userRepository->verify($token);

        if (!$uid) {
            return false;
        }

        return $this->userRepository->get($uid)->toArray();
    }
}