<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use Cake\Event\Event;
use Cake\Utility\Hash;
use App\UseCase\IUserRegisterUseCase;

class LoginController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index(IUserRegisterUseCase $userRegisterUseCase) {
        $this->set('pageTitle', 'ログイン');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            $this->Auth->setUser($user);

            if (!$user) {
                $this->Flash->error('ログインに失敗しました、再度お試しください');
                return;
            }

            if (Hash::get($this->request->getData(), 'registerFlg')) {
                //SSOで初回ログイン
                $this->__createInitalData($userRegisterUseCase, $user);
                return $this->redirect('/gift/add');
            }

            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    private function __createInitalData(IUserRegisterUseCase $userRegisterUseCase, array $user) {
        try {
            $uid = Hash::get($user, 'uid');
            $name = Hash::get($user, 'name');
            $userRegisterUseCase->createInitalData($uid, $name);

        } catch (\Exception $e) {
            //ログインはできてるので、初期データ作成で例外が発生しても無視
            $this->log(AppUtils::beautifulExceptionLog($e), 'error');
        }
    }
}
