<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use Cake\Event\Event;
use App\UseCase\IUserEditUseCase;
use App\UseCase\IUserWithdrawUseCase;

class UserController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['withdrawFinish']);
    }

    public function edit(IUserEditUseCase $userEditUseCase) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/setting');
        }

        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $user = $userEditUseCase->edit($uid, $data);

            if ($user->getErrors()) {
                return $this->_getErrorAjaxResponse($user->getErrors());
            }

            //セッションの値も書き換えておく
            $authUser = $this->Auth->user();
            $authUser['email'] = $user->email;
            $this->Auth->setUser($authUser);

            return $this->_getSuccessAjaxResponse('保存しました');

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function withdraw(IUserWithdrawUseCase $userWithdrawUseCase) {
        try {
            if ($this->request->is('post')) {
                $uid = $this->Auth->user('uid');
                $userWithdrawUseCase->withdraw($uid);
                
                $this->getRequest()->getSession()->write('withdrawFlg', true);

                $this->Auth->logout();

                return $this->redirect('/user/withdraw-finish');
            }
        } catch (\Exception $e) {
            $this->log(AppUtils::beautifulExceptionLog($e), 'error');
            $this->Flash->error('退会できませんでした、お手数ですが再度お試しください');
        }

        return $this->redirect('/setting');
    }

    public function withdrawFinish() {
        if (!$this->getRequest()->getSession()->consume('withdrawFlg')) {
            $this->redirect('/login');
        }

        $this->set('pageTitle', '退会');

        $this->viewBuilder()->setLayout('before_login');
    }
}
