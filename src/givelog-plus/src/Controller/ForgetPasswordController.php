<?php
namespace App\Controller;

use Cake\Event\Event;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IUserPwReminderUseCase;

class ForgetPasswordController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['index', 'finish']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index(IUserPwReminderUseCase $userPwReminderUseCase) {
        $this->set('pageTitle', 'パスワード再発行');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $userPwReminderUseCase->reminder($data);

            $this->getRequest()->getSession()->write('forgetPasswordFlg', true);

            return $this->redirect(['action' => 'finish']);
        }
    }

    public function finish() {
        if (!$this->getRequest()->getSession()->consume('forgetPasswordFlg')) {
            $this->redirect('/forget-password');
        }

        $this->set('pageTitle', 'パスワード再発行');
    }
}
