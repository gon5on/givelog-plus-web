<?php
namespace App\Controller;

use Cake\Event\Event;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IUserPwReminderUseCase;

class ForgetPasswordController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['index']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index(IUserPwReminderUseCase $userPwReminderUseCase) {
        $this->set('pageTitle', 'パスワード再発行');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $userPwReminderUseCase->reminder($data);
        }
    }

    public function finish() {
        $this->set('pageTitle', 'パスワード再発行');
    }
}
