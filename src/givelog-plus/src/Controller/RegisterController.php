<?php
namespace App\Controller;

use Cake\Event\Event;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;

/**
 * アカウント新規作成コントローラ
 */
class RegisterController extends AppController
{
    /**
     * beforeFilter
     * 
     * @param Event event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['index']);

        $this->viewBuilder()->setLayout('before_login');
    }

    /**
     * 入力画面
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'アカウント新規作成');

        if ($this->request->is('post')) {
            $name = $this->request->getData('name');
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');

            try {
                $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
                $auth = $factory->createAuth();

                $userProperties = [
                    'email' => $email,
                    'emailVerified' => true,
                    'password' => $password,
                    'displayName' => $name,
                    'disabled' => false,
                ];

                $auth->createUser($userProperties);

                return $this->render('finish');
            } catch (FirebaseException $e) {
                //TODO
                debug($e->getMessage());
            }
        }
    }
}
