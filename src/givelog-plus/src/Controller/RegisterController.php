<?php
namespace App\Controller;

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
        $this->set('page_title', 'アカウント新規作成');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $userRegisterUseCase->register($data);

            if (!$user->getErrors()) {
                return $this->redirect(['action' => 'finish']);
            }
        }
    }

    public function finish() {
        $this->set('page_title', 'アカウント新規作成');
    }
}
