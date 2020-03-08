<?php
namespace App\Auth;
 
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Auth\BaseAuthenticate;
use Cake\ORM\TableRegistry;

use Kreait\Firebase\Factory;

/**
 * Firebase idTokenの有効化確認を認証に使う
 * 
 * TODO もろもろ…
 */
class FirebaseAuthenticate extends BaseAuthenticate
{
    protected $_defaultConfig = [
        'fields' => [
            'idToken' => 'idToken',
        ],
        // 'userModel' => 'Users',
        // 'scope' => [],
        // 'finder' => 'all',
        // 'contain' => null,
        // 'passwordHasher' => 'Default',
    ];
 
    protected function _checkFields(ServerRequest $request, array $fields)
    {
        $value = $request->getData($fields['idToken']);
        if (empty($value) || !is_string($value)) {
            return false;
        }

        return true;
    }
 
    protected function _checkContainFields(ServerRequest $request, array $contains)
    {
        // foreach ($contains as $contain) {
        //     $fields = $contain['fields'];
        //     foreach ($fields as $column => $field) {
        //         $value = $request->getData($field);
        //         if (empty($value) || !is_string($value)) {
        //             return false;
        //         }
        //     }
        // }
 
        return true;
    }
 
    protected function _query($username, array $params = null)
    {
        // $config = $this->_config;
        // $table = TableRegistry::get($config['userModel']);
 
        // $options = [
        //     'conditions' => [$table->aliasField($config['fields']['username']) => $username]
        // ];
 
        // if (!empty($config['scope'])) {
        //     $options['conditions'] = array_merge($options['conditions'], $config['scope']);
        // }
        // if (!empty($config['contain'])) {
        //     if (is_array($config['contain'])) {
        //         foreach ($config['contain'] as $key => $val) {
 
        //             $conditions = [];
        //             foreach ($val['fields'] as $column => $name) {
        //                 $conditions += [$key.'.'.$column => $params[$key][$column]];
        //             }
        //             if (!empty($val['conditions'])) {
        //                 $conditions = array_merge($val['conditions'], $conditions);
        //             }
            
        //             $options['contain'][] = $key;
        //             $options['conditions'] = array_merge($options['conditions'], $conditions);
        //         }
        //     }
        //     else {
        //         $options['contain'] = $config['contain'];
        //     }
        // }
 
        // $finder = $config['finder'];
        // if (is_array($finder)) {
        //     $options += current($finder);
        //     $finder = key($finder);
        // }
 
        // if (!isset($options['username'])) {
        //     $options['username'] = $username;
        // }
 
        // return $table->find($finder, $options);
    }
 
    protected function _findUser($username, $password = null, array $params = null)
    {
        // $query = $this->_query($username, $params);
        // $result = $query->first();
 
        // if (empty($result)) {
        //     $hasher = $this->passwordHasher();
        //     $hasher->hash((string)$password);
 
        //     return false;
        // }
 
        // $passwordField = $this->_config['fields']['password'];
        // if ($password !== null) {
        //     $hasher = $this->passwordHasher();
        //     $hashedPassword = $result->get($passwordField);
        //     if (!$hasher->check($password, $hashedPassword)) {
        //         return false;
        //     }
 
        //     $this->_needsPasswordRehash = $hasher->needsRehash($hashedPassword);
        //     $result->unsetProperty($passwordField);
        // }
        // $hidden = $result->getHidden();
        // if ($password === null && in_array($passwordField, $hidden)) {
        //     $key = array_search($passwordField, $hidden);
        //     unset($hidden[$key]);
        //     $result->setHidden($hidden);
        // }
 
        // return $result->toArray();
    }
 
    public function authenticate(ServerRequest $request, Response $response)
    {
        $fields = $this->_config['fields'];
        if (!$this->_checkFields($request, $fields)) {
            return false;
        }

        // $contains = $this->_config['contain'];
        // if (!$this->_checkContainFields($request, $contains)) {
        //     return false;
        // }
        // $options = [];
        // foreach ($contains as $table => $val) {
        //     $option = [];
        //     foreach ($val['fields'] as $column => $name) {
        //         $option[$column] = $request->getData($name);
        //     }
        //     $options[$table] = $option;
        // }
 
        // return $this->_findUser(
        //     $request->getData($fields['username']),
        //     $request->getData($fields['password']),
        //     $options
        // );

        $idToken = $request->getData($fields['idToken']);

        $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
        $auth = $factory->createAuth();
        $verifiedIdToken = $auth->verifyIdToken($idToken, false);

        $uid = $verifiedIdToken->getClaim('sub');
        $user = $auth->getUser($uid);

        return [
            'idToken' => $idToken,
            'uid' => $uid,
            'name' => $user->displayName,
            'email' => $user->email,
        ];
    }
}