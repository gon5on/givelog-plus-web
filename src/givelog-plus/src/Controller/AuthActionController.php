<?php
namespace App\Controller;

use Cake\Event\Event;

class AuthActionController extends AppController {
    const RESET_PASSWORD = 'resetPassword';

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['index']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index() {
        if ($this->request->getQuery('mode') != self::RESET_PASSWORD) {
            return $this->redirect(['controller' => 'Login']);
        }

        $this->set('pageTitle', 'パスワード再発行');
    }
}
