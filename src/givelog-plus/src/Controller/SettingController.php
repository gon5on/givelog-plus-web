<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IUserEditUseCase;

class SettingController extends AppController {
    use InvokeActionTrait;

    public function index() {
        $this->set('page_title', '設定');

        $this->set('email', $this->Auth->user('email'));
    }

    public function userEdit(IUserEditUseCase $userEditUseCase) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/setting');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $user = $userEditUseCase->edit($uid, $data);

        //セッションの値も書き換えておく
        $this->Auth->setUser($user->toArray());

        return $this->getAjaxResponse($user);
    }
}
