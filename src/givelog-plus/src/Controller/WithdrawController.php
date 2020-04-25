<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use Cake\Event\Event;
use App\UseCase\IUserWithdrawUseCase;

class WithdrawController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['finish']);
    }

    public function index(IUserWithdrawUseCase $userWithdrawUseCase) {
        $this->request->allowMethod(['post']);

        $uid = $this->Auth->user('uid');
        $userWithdrawUseCase->withdraw($uid);

        $this->Auth->logout();

        return $this->redirect('/withdraw/finish');
    }

    public function finish() {
        $this->set('page_title', '退会');

        $this->viewBuilder()->setLayout('before_login');
    }
}
