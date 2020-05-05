<?php
namespace App\Controller;

use Cake\Utility\Hash;
use Cake\Event\Event;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IUserRegisterUseCase;

class RegisterController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['index', 'finish']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index(IUserRegisterUseCase $userRegisterUseCase) {
        $this->set('pageTitle', 'アカウント新規作成');

        try {
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                $user = $userRegisterUseCase->register($data);
    
                if (!$user->getErrors()) {
                    $session = $this->getRequest()->getSession();
                    $session->write('email', Hash::get($data, 'email'));
                    $session->write('password', Hash::get($data, 'password'));
    
                    return $this->redirect(['action' => 'finish']);
                }
            }
        } catch (\Exception $e) {
            return $this->_catchExceptionForPost($e, '/register');
        }
    }

    public function finish() {
        $this->set('pageTitle', 'アカウント新規作成');

        $session = $this->getRequest()->getSession();
        $email = $session->consume('email');
        $password = $session->consume('password');

        if (!$email || !$password) {
            $this->redirect('/login');
        }

        $this->set(compact('email', 'password'));
    }
}
